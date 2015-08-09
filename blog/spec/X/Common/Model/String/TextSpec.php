<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\X\Common\Model\String;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use X\Common\Exception\InvalidTypeException;
use X\Common\Model\Comparison\EquatableInterface;
use X\Common\Model\Identifier\AbstractId;
use X\Common\Model\String\Text;

class TextSpec extends ObjectBehavior
{
    const STRING = 'string';

    function let()
    {
        $this->beConstructedWith(self::STRING);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Text::class);
    }

    function it_represents_text()
    {
        $this->getText()->shouldBe(self::STRING);
        $this->__toString()->shouldBe(self::STRING);
    }

    function it_does_not_accept_texts_that_are_not_strings()
    {
        $this->shouldThrow(InvalidTypeException::class)->during('__construct', [new \stdClass()]);
    }

    function it_is_empty_when_no_text_given()
    {
        $this->beConstructedWith();

        $this->getText()->shouldBe('');
    }

    function it_is_equatable()
    {
        $this->shouldHaveType(EquatableInterface::class);
    }
    
    function it_is_equal_to_same_text(Text $text)
    {
        $text->getText()->willReturn(self::STRING);
        
        $this->equals($text)->shouldBe(true);
    }

    function it_is_not_equal_to_different_text(Text $text)
    {
        $text->getText()->willReturn('Some other string');

        $this->equals($text)->shouldBe(false);
    }

    function it_is_not_equal_to_object_of_different_type_with_same_value(AbstractId $id)
    {
        $this->equals($id)->shouldBe(false);
    }
}