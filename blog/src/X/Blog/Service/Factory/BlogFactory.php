<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Blog\Service\Factory;

use X\Blog\Model\Blog;
use X\Blog\Model\Author;
use X\Blog\Model\Identifier\BlogId;

/**
 * Class BlogFactory
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
class BlogFactory
{
    /**
     * @param Author $author
     * @param BlogId $blogId
     *
     * @return Blog
     */
    public function create(Author $author, BlogId $blogId = null)
    {
        $blogId = $blogId ? : new BlogId();

        return new Blog($blogId, $author);
    }
}
