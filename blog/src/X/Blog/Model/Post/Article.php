<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Blog\Model\Post;

use X\Blog\Model\Displayable\DisplayableInterface;
use X\Blog\Model\Displayable\Page;
use X\Blog\Model\Post;
use X\Common\Exception\InvalidTypeException;

/**
 * Class Article
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
class Article extends Post
{
    /**
     * @param DisplayableInterface $displayable
     */
    protected function verifyDisplayable(DisplayableInterface $displayable)
    {
        if (!$displayable instanceof Page) {
            throw new InvalidTypeException($displayable, Page::class);
        }
    }

}
