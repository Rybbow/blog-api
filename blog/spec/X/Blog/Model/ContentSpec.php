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
use X\Blog\Model\Collection\Displayables;
use X\Blog\Model\Content;
use X\Common\Model\String\Text;

class ContentSpec extends ObjectBehavior
{
    function let(Text $teaser, Displayables $displayables)
    {
        $this->beConstructedWith($teaser, $displayables);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Content::class);
    }

    function it_has_teaser(Text $teaser)
    {
        $this->getTeaser()->shouldBe($teaser);
    }
    
    function it_has_displayables(Displayables $displayables)
    {
        $this->getDisplayables()->shouldBe($displayables);
    }
}
