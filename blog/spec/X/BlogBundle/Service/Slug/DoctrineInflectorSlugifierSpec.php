<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\X\BlogBundle\Service\Slug;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use X\Blog\Model\ValueObject\Slug;
use X\Blog\Service\Slug\SlugifierInterface;
use X\BlogBundle\Service\Slug\DoctrineInflectorSlugifier;
use X\Common\Model\String\Text;

class DoctrineInflectorSlugifierSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DoctrineInflectorSlugifier::class);
    }

    function it_is_a_slugifier()
    {
        $this->shouldHaveType(SlugifierInterface::class);
    }

    function it_slugifies_a_text(Text $text)
    {
        $text->__toString()->willReturn('someCrazyTTText');

        $this->slugify($text)->shouldBeAnInstanceOf(Slug::class);
    }


}
