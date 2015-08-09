<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Blog\Model\ValueObject;

use X\Blog\Exception\TitleTooLongException;
use X\Common\Model\String\Text;

/**
 * Class Title
 *
 * @author  Michał Rybnik <rybbow@gmail.com>
 */
class Title extends Text
{
    const MAX_LENGTH = 255;

    /**
     * @param string $text
     */
    public function __construct($text = null)
    {
        if (strlen($text) > self::MAX_LENGTH) {
            throw new TitleTooLongException($text, self::MAX_LENGTH);
        }
        parent::__construct($text);
    }
}
