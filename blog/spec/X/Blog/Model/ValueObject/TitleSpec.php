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
use X\Blog\Exception\TitleTooLongException;
use X\Blog\Model\ValueObject\Title;
use X\Common\Model\String\Text;

class TitleSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('title');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Title::class);
    }

    function it_is_text_subtype()
    {
        $this->shouldHaveType(Text::class);
    }

    function it_does_not_allow_texts_longer_than_the_limit()
    {
        $this->shouldThrow(TitleTooLongException::class)->during('__construct', [str_repeat('*', Title::MAX_LENGTH + 1)]);
    }
}
