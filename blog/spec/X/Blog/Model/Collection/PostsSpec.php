<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\X\Blog\Model\Collection;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use X\Blog\Model\Collection\Posts;
use X\Blog\Model\Post;
use X\Blog\Model\ValueObject\Slug;
use X\Common\Collection\IndexedTypedCollection;
use X\Common\Collection\TypedCollection;

class PostsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Posts::class);
    }

    function it_is_typed_collection_of_posts()
    {
        $this->shouldHaveType(IndexedTypedCollection::class);
        $this->getType()->shouldBe(Post::class);
        $this->getKeyType()->shouldBe(Slug::class);
    }
}