<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Common\Model\Comparison;

/**
 * Interface EquatableInterface
 *
 * @author  Michał Rybnik <michal.rybnik@fuero.pl> 
 */
interface EquatableInterface
{
    /**
     * @param EquatableInterface $other
     *
     * @return bool
     */
    public function equals(EquatableInterface $other);
}