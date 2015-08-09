<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Common\Exception;

/**
 * Class InvalidKeyTypeException
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
class InvalidKeyTypeException extends \UnexpectedValueException
{
    /**
     * @param mixed      $keyType
     * @param int        $code
     * @param \Exception $previous
     */
    public function __construct($keyType, $code = 0, \Exception $previous = null)
    {
        parent::__construct(sprintf('Variables of type "%s" cannot be used as keys.', $keyType), $code, $previous);
    }
}
