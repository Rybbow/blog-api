<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\X\Common\Collection;

use Doctrine\Common\Collections\Collection;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\VarDumper\VarDumper;
use X\Common\Exception\InvalidTypeException;

class TypedCollectionSpec extends ObjectBehavior
{
    function let(Collection $internal)
    {
        $this->beConstructedWith('string', $internal);
    }

    function it_is_initializable()
    {
        $this->beConstructedWith('string');
    }

    function it_is_introspective()
    {
        $this->getType()->shouldBe('string');
    }

    function it_stores_only_unique_values(Collection $internal)
    {
        $container = [];
        $internal->add(Argument::type('string'))->will(function($argument) use(&$container) {
            $container[] = $argument;
        });
        $internal->count()->will(function() use(&$container) {
            return count($container);
        });
        $internal->contains(Argument::type('string'))->will(function($argument) use(&$container) {
            return in_array($argument, $container, true);
        });

        $this->add('t');
        $this->add('t');
        $this->add('d');

        $this->count()->shouldBe(2);
    }

    function it_accepts_only_elements_of_specified_type_for_add_method(Collection $internal)
    {
        $this->shouldThrow(new InvalidTypeException(4, 'string'))->during('add', [4]);

        $internal->add(Argument::any())->shouldNotHaveBeenCalled();
    }

    function it_accepts_only_elements_of_specified_type_for_set_method(Collection $internal)
    {
        $this->shouldThrow(new InvalidTypeException(4, 'string'))->during('set', [1, 4]);

        $internal->set(Argument::cetera())->shouldNotHaveBeenCalled();
    }

    function it_accepts_only_elements_of_specified_type_for_offset_set_method(Collection $internal)
    {
        $this->shouldThrow(new InvalidTypeException(4, 'string'))->during('offsetSet', [1, 4]);

        $internal->offsetSet(Argument::cetera())->shouldNotHaveBeenCalled();
    }

    function it_does_not_contain_elements_of_type_other_than_specified(Collection $internal)
    {
        $this->contains(4)->shouldBe(false);

        $internal->contains(Argument::any())->shouldNotHaveBeenCalled();
    }

    function it_does_not_remove_elements_of_type_other_than_specified(Collection $internal)
    {
        $this->removeElement(4)->shouldBe(false);

        $internal->contains(Argument::any())->shouldNotHaveBeenCalled();
    }

    function it_does_not_contain_index_of_elements_of_type_other_than_specified(Collection $internal)
    {
        $this->indexOf(4)->shouldBe(false);

        $internal->indexOf(Argument::any())->shouldNotHaveBeenCalled();
    }

}