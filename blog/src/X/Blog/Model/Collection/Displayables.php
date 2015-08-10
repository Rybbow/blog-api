<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Blog\Model\Collection;

use Doctrine\Common\Collections\Collection;
use X\Blog\Model\Displayable\DisplayableInterface;
use X\Common\Collection\TypedCollection;

/**
 * Class Displayables
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
class Displayables extends TypedCollection
{
    /**
     * @param Collection $collection
     * @param null       $keyExtractor
     */
    public function __construct(Collection $collection = null, $keyExtractor = null)
    {
        parent::__construct(DisplayableInterface::class, $collection, $keyExtractor);
    }
}
