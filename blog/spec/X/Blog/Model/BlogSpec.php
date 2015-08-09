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
use X\Blog\Exception\BlogAuthorCannotChangeException;
use X\Blog\Model\Author;
use X\Blog\Model\Blog;
use X\Blog\Model\Collection\Posts;
use X\Blog\Model\Identifier\BlogId;
use X\Blog\Model\Post;
use X\Blog\Model\ValueObject\Slug;
use X\Common\Spec\Matcher\IterableMatcherUtil;

class BlogSpec extends ObjectBehavior
{
    public function let(BlogId $id, Author $author)
    {
        $this->beConstructedWith($id, $author);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Blog::class);
    }

    function it_has_author(Author $author)
    {
        $this->getAuthor()->shouldBe($author);
    }

    function it_does_not_allow_to_change_author(Author $another)
    {
        $this->shouldThrow(
            BlogAuthorCannotChangeException::class
        )->during('setAuthor', [$another]);
    }

    function it_changes_to_string()
    {
        $this->__toString()->shouldBe('');
    }

    function it_has_id(BlogId $id)
    {
        $this->getId()->shouldBe($id);
    }

    function it_has_posts()
    {
        $this->getPosts()->shouldBeAnInstanceOf(Posts::class);
    }

    function it_owns_an_added_post(Post $post, Slug $slug)
    {
        $post->getSlug()->willReturn($slug);
        $slug->__toString()->willReturn('slug');

        $this->addPost($post);

        $this->getPosts()->shouldContain($post);
        $this->hasPost($slug)->shouldBe(true);
    }

    public function getMatchers()
    {
        return IterableMatcherUtil::register();
    }


}