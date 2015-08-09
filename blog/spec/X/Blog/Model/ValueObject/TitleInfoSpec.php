<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\X\Blog\Model\ValueObject;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use X\Blog\Model\ValueObject\Slug;
use X\Blog\Model\ValueObject\Title;
use X\Blog\Model\ValueObject\TitleInfo;

class TitleInfoSpec extends ObjectBehavior
{
    function let(Title $title, Slug $slug)
    {
        $this->beConstructedWith($title, $slug);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(TitleInfo::class);
    }

    function it_has_title(Title $title)
    {
        $this->getTitle()->shouldBe($title);
    }

    function it_has_slug(Slug $slug)
    {
        $this->getSlug()->shouldBe($slug);
    }
}
