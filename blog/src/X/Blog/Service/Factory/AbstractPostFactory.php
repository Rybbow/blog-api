<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Blog\Service\Factory;

use Doctrine\Common\Collections\Collection;
use X\Blog\Model\Blog;
use X\Blog\Model\Collection\Displayables;
use X\Blog\Model\Content;
use X\Blog\Model\Displayable\DisplayableInterface;
use X\Blog\Model\Post;
use X\Blog\Model\ValueObject\DateInfo;
use X\Blog\Model\ValueObject\PostInfo;
use X\Blog\Model\ValueObject\Title;
use X\Blog\Model\ValueObject\TitleInfo;
use X\Blog\Service\Slug\SlugifierInterface;
use X\Common\Model\String\Text;

/**
 * Class PostFactory
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
abstract class AbstractPostFactory
{
    /** @var SlugifierInterface */
    private $slugifier;

    /**
     * @param SlugifierInterface $slugifier
     */
    public function __construct(SlugifierInterface $slugifier)
    {
        $this->slugifier = $slugifier;
    }

    /**
     * @param Blog       $blog
     * @param Title      $title
     * @param Text       $teaser
     * @param Collection $rawDisplayables A collection of raw values that will be converted into displayables that
     *                                    this Post subtype handles.
     *
     * @return Post
     */
    final public function create(Blog $blog, Title $title, Text $teaser, Collection $rawDisplayables)
    {
        $slug     = $this->slugifier->slugify($title);
        $postInfo = new PostInfo(
            new TitleInfo($title, $slug),
            new DateInfo()
        );
        $displayables = new Displayables();
        foreach ($rawDisplayables as $rawDisplayable) {
            $displayable = $this->doConvertToDisplayable($rawDisplayable);
            $displayables->add($displayable);
        }
        $content  = new Content($teaser, $displayables);

        $post = $this->doCreate($postInfo, $content);
        $blog->addPost($post);

        return $post;
    }

    /**
     * @param PostInfo $postInfo
     * @param Content  $content
     *
     * @return Post
     */
    abstract protected function doCreate(PostInfo $postInfo, Content $content);

    /**
     * @param mixed $raw
     *
     * @return DisplayableInterface
     */
    abstract protected function doConvertToDisplayable($raw);
}
