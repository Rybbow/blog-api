<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\X\BlogBundle\Repository;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use X\Blog\Model\Blog;
use X\Blog\Model\Identifier\BlogId;
use X\BlogBundle\Repository\InMemoryBlogRepository;

class InMemoryBlogRepositorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(InMemoryBlogRepository::class);
    }

    function it_saves_a_blog(Blog $blog, BlogId $blogId)
    {
        $blogId->__toString()->willReturn('***');
        $blog->getId()->willReturn($blogId);

        $this->save($blog)->shouldBe(null);
    }

    function it_does_not_find_an_unsaved_blog(BlogId $blogId)
    {
        $blogId->__toString()->willReturn('***');

        $this->find($blogId)->shouldBe(null);
    }

    function it_finds_a_saved_blog(Blog $blog, BlogId $blogId)
    {
        $blogId->__toString()->willReturn('***');
        $blog->getId()->willReturn($blogId);

        $this->save($blog);

        $this->find($blogId)->shouldBe($blog);
    }
}