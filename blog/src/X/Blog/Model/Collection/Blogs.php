<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Blog\Model\Collection;

use Doctrine\Common\Collections\Collection;
use X\Blog\Model\Blog;
use X\Common\Collection\TypedCollection;


/**
 * Class Blogs
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
class Blogs extends TypedCollection
{
    /**
     * @param Collection $collection
     */
    public function __construct(Collection $collection = null)
    {
        parent::__construct(Blog::class, $collection);
    }

}