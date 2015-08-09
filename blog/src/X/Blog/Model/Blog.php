<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Blog\Model;

use X\Blog\Exception\BlogAuthorCannotChangeException;
use X\Blog\Model\Collection\Posts;
use X\Blog\Model\Identifier\BlogId;
use X\Blog\Model\ValueObject\Slug;

/**
 * Class Blog
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
class Blog
{
    /** @var BlogId */
    private $id;

    /** @var Author */
    private $author;

    /** @var Posts */
    private $posts;

    /**
     * @param Author $author
     */
    public function __construct(BlogId $id, Author $author)
    {
        $this->id     = $id;
        $this->author = $author;
        $this->author->addBlog($this);
        $this->posts  = new Posts();
    }

    /**
     * @return BlogId
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param Author $author
     *
     * @throws BlogAuthorCannotChangeException
     */
    public function setAuthor(Author $author)
    {
        if ($this->author && $author !== $this->author) {
            throw new BlogAuthorCannotChangeException($this);
        }
        $this->author = $author;
    }

    /**
     * @return Posts
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param Post $post
     */
    public function addPost(Post $post)
    {
        $this->posts->add($post);
    }

    /**
     * @param Slug $slug
     *
     * @return bool
     */
    public function hasPost(Slug $slug)
    {
        return $this->posts->containsKey($slug);
    }

    /**
     * @return string
     *
     * @todo
     */
    public function __toString()
    {
        return '';
    }
}
