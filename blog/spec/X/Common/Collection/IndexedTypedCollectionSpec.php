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
use X\Blog\Model\Blog;
use X\Blog\Model\Identifier\BlogId;
use X\Common\Collection\IndexedTypedCollection;
use X\Common\Collection\TypedCollection;
use X\Common\Exception\InvalidKeyTypeException;
use X\Common\Exception\InvalidTypeException;

class IndexedTypedCollectionSpec extends ObjectBehavior
{
    function let(Collection $internal)
    {
        $this->beConstructedWith('int', 'string', $internal);
    }
    
    function it_is_initializable()
    {
        $this->shouldHaveType(IndexedTypedCollection::class);
    }
    
    function it_is_typed_collection()
    {
        $this->shouldHaveType(TypedCollection::class);
    }

    function it_is_introspective()
    {
        $this->getKeyType()->shouldBe('int');
    }

    function it_converts_object_values_to_keys(Blog $blog, BlogId $id, Collection $internal)
    {
        $key = 'key';
        
        $this->beConstructedWith(BlogId::class, Blog::class, $internal, 'getId');
        
        $blog->getId()->willReturn($id);
        $id->__toString()->willReturn($key);

        $internal->add(Argument::any())->shouldNotBeCalled();
        $internal->set($key, $blog)->will(function() use($blog, $key) {
            $this->get($key)->willReturn($blog);
        });
        $internal->contains($blog)->willReturn(false);
        $internal->offsetGet($key)->willReturn(null);

        $this->add($blog);

        $this->get($id)->shouldBe($blog);
    }

    function it_converts_object_keys_to_string(Collection $internal, BlogId $key)
    {
        $this->beConstructedWith(BlogId::class, 'string', $internal);
        $key->__toString()->willReturn('key_value');

        $internal->set('key_value', 'test')->shouldBeCalled();
        $internal->offsetGet('key_value')->willReturn(null);
        $internal->contains('test')->willReturn(false);

        $this->set($key, 'test');
    }

    function it_does_not_handle_array_keys(Collection $internal)
    {
        $this->shouldThrow(new InvalidKeyTypeException('array'))->during('__construct', ['array', 'string', $internal]);
    }

    function it_does_not_handle_resource_keys(Collection $internal)
    {
        $this->shouldThrow(new InvalidKeyTypeException('resource'))->during('__construct', ['resource', 'string', $internal]);
    }

    function it_accepts_only_keys_of_specified_type_for_remove_method(Collection $internal)
    {
        $this->shouldAcceptOnlyKeysOfSpecifiedTypeForMethod('remove', '4', 'int', $internal);
    }

    function it_accepts_only_keys_of_specified_type_for_set_method(Collection $internal)
    {
        $this->shouldAcceptOnlyKeysOfSpecifiedTypeForMethod('set', '4', 'int', $internal, 'test');
    }

    function it_doest_not_contain_keys_with_type_other_than_specified(Collection $internal)
    {
        $internal->containsKey(Argument::any())->shouldNotBeCalled();
        $internal->offsetExists(Argument::any())->shouldNotBeCalled();

        $this->containsKey('4')->shouldBe(false);
        $this->offsetExists('4')->shouldBe(false);
    }

    function it_returns_null_when_getting_for_a_key_with_type_other_than_specified(Collection $internal)
    {
        $internal->get(Argument::any())->shouldNotBeCalled();
        $internal->offsetGet(Argument::any())->shouldNotBeCalled();

        $this->get('4')->shouldBe(null);
        $this->offsetGet('4')->shouldBe(null);
    }

    function it_accepts_only_keys_of_specified_type_for_offset_unset_method(Collection $internal)
    {
        $this->shouldAcceptOnlyKeysOfSpecifiedTypeForMethod('offsetUnset', '4', 'int', $internal);
    }

    function it_accepts_only_keys_of_specified_type_for_offset_set_method(Collection $internal)
    {
        $this->shouldAcceptOnlyKeysOfSpecifiedTypeForMethod('offsetSet', '4', 'int', $internal, 'test');
    }

    /**
     * @param string     $method
     * @param string     $key
     * @param string     $keyType
     * @param Collection $internal
     * @param ...$args
     */
    protected function shouldAcceptOnlyKeysOfSpecifiedTypeForMethod($method, $key, $keyType, $internal, ...$args)
    {
        $this->shouldThrow(new InvalidTypeException($key, $keyType))->during($method, array_merge([$key], $args));

        $internal->{$method}(Argument::any())->shouldNotHaveBeenCalled();
    }
}
