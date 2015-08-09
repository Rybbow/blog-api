<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\X\Blog\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use X\Blog\Model\Author;
use X\Blog\Model\Blog;
use X\Blog\Model\Collection\Blogs;
use X\Common\Spec\Matcher\IterableMatcherUtil;

class AuthorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Author::class);
    }

    function it_has_blogs()
    {
        $this->getBlogs()->shouldBeAnInstanceOf(Blogs::class);
    }

    function it_owns_a_blog(Blog $blog)
    {
        $blog->setAuthor($this)->shouldBeCalled();

        $this->addBlog($blog);

        $this->getBlogs()->shouldContain($blog);
    }

    public function getMatchers()
    {
        return IterableMatcherUtil::register();
    }
}