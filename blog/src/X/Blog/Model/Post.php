<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Blog\Model;

use X\Blog\Model\ValueObject\PostInfo;


/**
 * Class Post
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
abstract class Post
{
    /** @var PostInfo */
    private $info;

    /**
     * @param PostInfo $info
     */
    public function __construct(PostInfo $info)
    {
        $this->info = $info;
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
}