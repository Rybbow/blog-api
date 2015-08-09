<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace %namespace%;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use %subject%;

class %name% extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(%subject%::class);
    }
}
