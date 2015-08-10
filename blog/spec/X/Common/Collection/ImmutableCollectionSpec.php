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
use X\Blog\Model\Collection\Displayables;
use X\Common\Collection\ImmutableCollection;
use X\Common\Exception\ImmutableCollectionException;

class ImmutableCollectionSpec extends ObjectBehavior
{
    private $internal;

    function let(Collection $internal)
    {
        $this->beConstructedWith($internal);
        $this->internal = $internal;
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ImmutableCollection::class);
    }

    function it_is_collection()
    {
        $this->shouldHaveType(Collection::class);
    }

    function it_delegates_undefined_calls_to_internal_collection(Displayables $displayables)
    {
        $this->beConstructedWith($displayables);

        $displayables->getType()->willReturn('integer');

        $this->getType()->shouldBe('integer');
    }

    function it_does_not_allow_adding()
    {
        $this->shouldThrowImmutableExceptionDuring('add', ['value']);
    }

    function it_does_not_allow_clearing()
    {
        $this->shouldThrowImmutableExceptionDuring('clear');
    }

    function it_does_not_allow_removing()
    {
        $this->shouldThrowImmutableExceptionDuring('remove', ['key']);
    }

    function it_does_not_allow_removing_elements()
    {
        $this->shouldThrowImmutableExceptionDuring('removeElement', ['value']);
    }

    function it_does_not_allow_setting()
    {
        $this->shouldThrowImmutableExceptionDuring('set', ['key', 'value']);
    }

    function it_does_not_allow_setting_offset()
    {
        $this->shouldThrowImmutableExceptionDuring('offsetSet', ['key', 'value']);
    }

    function it_does_not_allow_unsetting_offset()
    {
        $this->shouldThrowImmutableExceptionDuring('offsetUnset', ['key']);
    }

    function it_delegates_contains_to_internal_collection()
    {
        $this->shouldDelegateCallToInternalCollection('contains', ['value']);
    }

    function it_delegates_is_empty_to_internal_collection()
    {
        $this->shouldDelegateCallToInternalCollection('isEmpty');
    }

    function it_delegates_contains_key_to_internal_collection()
    {
        $this->shouldDelegateCallToInternalCollection('containsKey', ['key']);
    }

    function it_delegates_get_to_internal_collection()
    {
        $this->shouldDelegateCallToInternalCollection('get', ['key']);
    }

    function it_delegates_get_keys_to_internal_collection()
    {
        $this->shouldDelegateCallToInternalCollection('getKeys');
    }

    function it_delegates_get_values_to_internal_collection()
    {
        $this->shouldDelegateCallToInternalCollection('getValues');
    }

    function it_delegates_to_array_to_internal_collection()
    {
        $this->shouldDelegateCallToInternalCollection('toArray');
    }

    function it_delegates_first_to_internal_collection()
    {
        $this->shouldDelegateCallToInternalCollection('first');
    }

    function it_delegates_last_to_internal_collection()
    {
        $this->shouldDelegateCallToInternalCollection('last');
    }

    function it_delegates_key_to_internal_collection()
    {
        $this->shouldDelegateCallToInternalCollection('key');
    }

    function it_delegates_current_to_internal_collection()
    {
        $this->shouldDelegateCallToInternalCollection('current');
    }

    function it_delegates_next_to_internal_collection()
    {
        $this->shouldDelegateCallToInternalCollection('next');
    }

    function it_delegates_exists_to_internal_collection()
    {
        $this->shouldDelegateCallToInternalCollection('exists', [function() {}]);
    }

    function it_delegates_filter_to_internal_collection()
    {
        $this->shouldDelegateCallToInternalCollection('filter', [function() {}]);
    }

    function it_delegates_for_all_to_internal_collection()
    {
        $this->shouldDelegateCallToInternalCollection('forAll', [function() {}]);
    }

    function it_delegates_map_to_internal_collection()
    {
        $this->shouldDelegateCallToInternalCollection('map', [function() {}]);
    }

    function it_delegates_index_of_to_internal_collection()
    {
        $this->shouldDelegateCallToInternalCollection('indexOf', ['key']);
    }

    function it_delegates_slice_to_internal_collection()
    {
        $this->shouldDelegateCallToInternalCollection('slice', ['offset', 'length']);
    }

    function it_delegates_get_iterator_to_internal_collection()
    {
        $this->shouldDelegateCallToInternalCollection('getIterator');
    }

    function it_delegates_offset_exists_to_internal_collection()
    {
        $this->shouldDelegateCallToInternalCollection('offsetExists', ['offset']);
    }

    function it_delegates_offset_get_to_internal_collection()
    {
        $this->shouldDelegateCallToInternalCollection('offsetGet', ['offset']);
    }

    function it_delegates_count_to_internal_collection()
    {
        $this->shouldDelegateCallToInternalCollection('count');
    }

    /**
     * @param string $method
     * @param array  $args
     */
    private function shouldThrowImmutableExceptionDuring($method, array $args = [])
    {
        $this->internal->{$method}(Argument::cetera())->shouldNotBeCalled();

        $this->shouldThrow(
            new ImmutableCollectionException(sprintf('%s::%s', ImmutableCollection::class, $method))
        )->during($method, $args);
    }

    /**
     * @param string $method
     * @param array  $args
     */
    private function shouldDelegateCallToInternalCollection($method, array $args = [])
    {
        $this->internal->{$method}(...$args)->shouldBeCalled()->willReturn('result');

        $this->callOnWrappedObject($method, $args)->shouldBe('result');
    }
}
