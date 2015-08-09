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
use X\Blog\Model\ValueObject\DateInfo;

class DateInfoSpec extends ObjectBehavior
{
//    function let(\DateTimeInterface $createdAt, \DateTimeInterface $updatedAt)
//    {
//        $this->beConstructedWith($createdAt, $updatedAt);
//    }

    function it_is_initializable()
    {
        $this->shouldHaveType(DateInfo::class);
    }

//    function it_has_created_date_time()
//    {
//        $this->getCreatedAt()->shouldBe()
//    }
}
