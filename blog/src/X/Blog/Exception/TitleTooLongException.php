<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Blog\Exception;


/**
 * Class TitleTooLongException
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
class TitleTooLongException extends ModelException
{
    /**
     * @param string     $string
     * @param int        $limit
     * @param int        $code
     * @param \Exception $previous
     */
    public function __construct($string, $limit, $code = 0, \Exception $previous = null)
    {
        parent::__construct(sprintf('Text "%s" is over the length limit (%d) for a title.', $string, $limit), $code, $previous);
    }
}