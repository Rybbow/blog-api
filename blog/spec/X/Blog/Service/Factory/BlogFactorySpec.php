<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\X\Blog\Service\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use X\Blog\Model\Blog;
use X\Blog\Model\Author;
use X\Blog\Model\Identifier\BlogId;
use X\Blog\Service\Factory\BlogFactory;

class BlogFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BlogFactory::class);
    }

    function it_creates_a_blog(Author $author)
    {
        $this->create($author)->shouldBeAnInstanceOf(Blog::class);
    }

    function it_creates_a_blog_with_given_blog_id(Author $author, BlogId $blogId)
    {
        $this->create($author, $blogId)->shouldBeAnInstanceOf(Blog::class);
        $this->create($author, $blogId)->getid()->shouldBe($blogId);
    }
}
