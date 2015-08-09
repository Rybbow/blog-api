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
use X\Blog\Model\ValueObject\DateInfo;
use X\Blog\Model\ValueObject\PostInfo;
use X\Blog\Model\ValueObject\Slug;
use X\Blog\Model\ValueObject\Title;
use X\Blog\Model\ValueObject\TitleInfo;

class PostInfoSpec extends ObjectBehavior
{
    function let(TitleInfo $titleInfo, DateInfo $dateInfo)
    {
        $this->beConstructedWith($titleInfo, $dateInfo);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(PostInfo::class);
    }

    function it_has_title_info(TitleInfo $titleInfo)
    {
        $this->getTitleInfo()->shouldBe($titleInfo);
    }

    function it_has_date_info(DateInfo $dateInfo)
    {
        $this->getDateInfo()->shouldBe($dateInfo);
    }

    function it_has_title(TitleInfo $titleInfo, Title $title)
    {
        $titleInfo->getTitle()->willReturn($title);

        $this->getTitle()->shouldBe($title);
    }

    function it_has_slug(TitleInfo $titleInfo, Slug $slug)
    {
        $titleInfo->getSlug()->willReturn($slug);

        $this->getSlug()->shouldBe($slug);
    }
}
