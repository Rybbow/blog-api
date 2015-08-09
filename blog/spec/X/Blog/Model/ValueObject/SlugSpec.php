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
use X\Common\Model\String\Text;

class SlugSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Slug::class);
    }

    function it_is_text_subtype()
    {
        $this->shouldHaveType(Text::class);
    }
}
