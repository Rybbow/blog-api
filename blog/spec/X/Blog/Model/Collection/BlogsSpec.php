<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Blog\Model\Collection;

use X\Blog\Model\Collection\Blogs;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use X\Blog\Model\Blog;
use X\Common\Collection\TypedCollection;

class BlogsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Blogs::class);
    }

    function it_is_typed_collection_of_blogs()
    {
        $this->shouldHaveType(TypedCollection::class);
        $this->getType()->shouldBe(Blog::class);
    }

//    function it_checks_for_exi

}