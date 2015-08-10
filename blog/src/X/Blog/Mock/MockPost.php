<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Blog\Mock;

use X\Blog\Model\Displayable\DisplayableInterface;
use X\Blog\Model\Post;

/**
 * Class MockPost
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
class MockPost extends Post
{
    /**
     * @param DisplayableInterface $displayable
     */
    protected function verifyDisplayable(DisplayableInterface $displayable)
    {

    }
}
