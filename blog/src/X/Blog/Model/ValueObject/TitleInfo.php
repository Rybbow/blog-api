<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Blog\Model\ValueObject;

/**
 * Class TitleInfo
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
class TitleInfo
{
    /** @var Title */
    private $title;

    /** @var Slug */
    private $slug;

    /**
     * @param Title $title
     * @param Slug  $slug
     */
    public function __construct(Title $title, Slug $slug)
    {
        $this->title = $title;
        $this->slug = $slug;
    }

    /**
     * @return Slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return Title
     */
    public function getTitle()
    {
        return $this->title;
    }
}
