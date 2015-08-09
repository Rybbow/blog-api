<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Blog\Model;

use X\Blog\Model\Collection\Blogs;


/**
 * Class Author
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
class Author
{
    /** @var Blogs */
    private $blogs;

    /**
     *
     */
    public function __construct()
    {
        $this->blogs = new Blogs();
    }

    /**
     * @param Blog $blog
     */
    public function addBlog(Blog $blog)
    {
        $blog->setAuthor($this);
        $this->blogs->add($blog);
    }

    /**
     * @return Blogs
     */
    public function getBlogs()
    {
        return $this->blogs;
    }
}
