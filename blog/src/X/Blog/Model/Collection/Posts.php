<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Blog\Model\Collection;

use Doctrine\Common\Collections\Collection;
use X\Blog\Model\Post;
use X\Blog\Model\ValueObject\Slug;
use X\Common\Collection\IndexedTypedCollection;

/**
 * Class Posts
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
class Posts extends IndexedTypedCollection
{
    /**
     * @param Collection $collection
     */
    public function __construct(Collection $collection = null)
    {
        parent::__construct(Slug::class, Post::class, $collection, 'getSlug');
    }

}
