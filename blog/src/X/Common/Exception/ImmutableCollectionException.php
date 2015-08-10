<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Common\Exception;

use Exception;


/**
 * Class ImmutableCollectionException
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
class ImmutableCollectionException extends \BadMethodCallException
{
    /**
     * @param string    $method
     * @param int       $code
     * @param Exception $previous
     */
    public function __construct($method, $code = 0, Exception $previous = null)
    {
        parent::__construct(sprintf('Method "%s" cannot be called as this collection is immutable.', $method), $code, $previous);
    }

}