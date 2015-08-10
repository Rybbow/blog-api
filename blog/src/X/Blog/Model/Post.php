<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Blog\Model;

use X\Blog\Model\Displayable\DisplayableInterface;
use X\Blog\Model\ValueObject\PostInfo;
use X\Common\Collection\ImmutableCollection;
use X\Common\Model\String\Text;

/**
 * Class Post
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
abstract class Post
{
    /** @var PostInfo */
    private $info;

    /** @var Content */
    private $content;

    /**
     * @param PostInfo $info
     * @param Content  $content
     */
    public function __construct(PostInfo $info, Content $content)
    {
        $this->info    = $info;
        $this->content = $content;
    }

    /**
     * @return ValueObject\Title
     */
    public function getTitle()
    {
        return $this->info->getTitle();
    }

    /**
     * @return ValueObject\Slug
     */
    public function getSlug()
    {
        return $this->info->getSlug();
    }

    /**
     * @return Text
     */
    public function getTeaser()
    {
        return $this->content->getTeaser();
    }

    /**
     * @return ImmutableCollection
     */
    public function getDisplayables()
    {
        return new ImmutableCollection($this->content->getDisplayables());
    }

    /**
     * @param DisplayableInterface $displayable
     *
     * @return bool
     */
    public function addDisplayable(DisplayableInterface $displayable)
    {
        $this->verifyDisplayable($displayable);

        return $this->content->getDisplayables()->add($displayable);
    }

    /**
     * @param DisplayableInterface $displayable
     */
    abstract protected function verifyDisplayable(DisplayableInterface $displayable);
}
