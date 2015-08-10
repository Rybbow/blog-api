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
use X\Blog\Model\Collection\Displayables;
use X\Blog\Model\Displayable\DisplayableInterface;
use X\Common\Collection\TypedCollection;

class DisplayablesSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Displayables::class);
    }

    function it_is_indexed_typed_collection()
    {
        $this->shouldHaveType(TypedCollection::class);
    }


    function it_collects_displayables()
    {
        $this->getType()->shouldBe(DisplayableInterface::class);
    }
}
