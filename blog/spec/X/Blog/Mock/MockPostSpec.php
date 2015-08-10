<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\X\Blog\Mock;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use X\Blog\Model\Collection\Displayables;
use X\Blog\Model\Content;
use X\Blog\Model\Post;
use X\Blog\Model\ValueObject\PostInfo;
use X\Blog\Model\ValueObject\Slug;
use X\Blog\Model\ValueObject\Title;
use X\Common\Collection\ImmutableCollection;
use X\Common\Model\String\Text;

class MockPostSpec extends ObjectBehavior
{
    function let(PostInfo $postInfo, Content $content)
    {
        $this->beConstructedWith($postInfo, $content);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Post::class);
    }

    function it_has_a_title_provided_in_title_info(PostInfo $postInfo, Title $title)
    {
        $postInfo->getTitle()->willReturn($title);

        $this->getTitle()->shouldBe($title);
    }

    function it_has_a_slug_provided_in_title_info(PostInfo $postInfo, Slug $slug)
    {
        $postInfo->getSlug()->willReturn($slug);

        $this->getSlug()->shouldBe($slug);
    }

    function it_has_teaser_provided_in_content(Content $content, Text $teaser)
    {
        $content->getTeaser()->willReturn($teaser);

        $this->getTeaser()->shouldBe($teaser);
    }

    function it_has_immutable_displayables_provided_in_content(Content $content, Displayables $displayables)
    {
        $content->getDisplayables()->willReturn($displayables);

        $this->getDisplayables()->shouldBeAnInstanceOf(ImmutableCollection::class);
    }
}
