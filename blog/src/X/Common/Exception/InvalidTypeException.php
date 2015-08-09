<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Common\Exception;

use Exception;
use X\Common\Type\TypeHelper;


/**
 * Class InvalidTypeException
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
class InvalidTypeException extends \UnexpectedValueException
{
    /**
     * @param string    $var
     * @param string    $expectedType
     * @param int       $code
     * @param Exception $previous
     */
    public function __construct($var, $expectedType, $code = 0, Exception $previous = null)
    {
        parent::__construct(sprintf('Expected type "%s", but "%s" given.', $expectedType, TypeHelper::getType($var)), $code, $previous);
    }


}