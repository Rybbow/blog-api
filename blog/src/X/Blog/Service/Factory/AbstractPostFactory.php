<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Blog\Service\Factory;

use X\Blog\Model\Blog;
use X\Blog\Model\ContentInterface;
use X\Blog\Model\Post;
use X\Blog\Model\ValueObject\DateInfo;
use X\Blog\Model\ValueObject\PostInfo;
use X\Blog\Model\ValueObject\Title;
use X\Blog\Model\ValueObject\TitleInfo;
use X\Blog\Service\Slug\SlugifierInterface;

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
     * @param Blog             $blog
     * @param Title            $title
     * @param ContentInterface $content
     *
     * @return Post
     */
    final public function create(Blog $blog, Title $title, ContentInterface $content)
    {
        $slug     = $this->slugifier->slugify($title);
        $postInfo = new PostInfo(
            new TitleInfo($title, $slug),
            new DateInfo()
        );

        $post = $this->doCreate($postInfo, $content);
        $blog->addPost($post);

        return $post;
    }

    /**
     * @param PostInfo         $postInfo
     * @param ContentInterface $content
     *
     * @return Post
     */
    abstract protected function doCreate(PostInfo $postInfo, ContentInterface $content);
}
