<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Blog\Service\Slug;

use X\Blog\Model\ValueObject\Slug;
use X\Common\Model\String\Text;

/**
 * Interface SlugifierInterface
 *
 * @author  Michał Rybnik <michal.rybnik@fuero.pl> 
 */
interface SlugifierInterface
{
    /**
     * @param Text $text
     *
     * @return Slug
     */
    public function slugify(Text $text);
}