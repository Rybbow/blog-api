<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\X\Blog\Model\Displayable;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use X\Blog\Model\Displayable\DisplayableInterface;
use X\Blog\Model\Displayable\Page;
use X\Common\Model\String\Text;

class PageSpec extends ObjectBehavior
{
    function let(Text $text)
    {
        $this->beConstructedWith($text);
    }
    
    function it_is_initializable()
    {
        $this->shouldHaveType(Page::class);
    }

    function it_is_displayable()
    {
        $this->shouldHaveType(DisplayableInterface::class);
    }
    
    function it_has_text(Text $text)
    {
        $this->getText()->shouldBe($text);
    }
}
