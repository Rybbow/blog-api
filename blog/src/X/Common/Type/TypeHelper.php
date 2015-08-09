<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Common\Type;


/**
 * Class TypeHelper
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
class TypeHelper
{
    /**
     * @param mixed $var
     *
     * @return string
     */
    public static function getType(&$var)
    {
        return is_object($var) ?
            get_class($var) :
            gettype($var);
    }

    /**
     * @param mixed  $var
     * @param string $type
     * @param bool   $inherited
     *
     * @return bool
     */
    public static function isOfType(&$var, $type, $inherited = true)
    {
        if (!is_object($var)) {
            return gettype($var) == $type;
        }

        return get_class($var) == $type || ($inherited && is_subclass_of($var, $type));
    }
}