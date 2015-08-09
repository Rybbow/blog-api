<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Common\Model\String;

use X\Common\Exception\InvalidTypeException;
use X\Common\Model\Comparison\EquatableInterface;

/**
 * Class Text
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
class Text implements EquatableInterface
{
    /** @var string */
    private $text;

    /**
     * @param string $text
     */
    public function __construct($text = null)
    {
        if (is_null($text)) {
            $text = '';
        }
        if (!is_string($text)) {
            throw new InvalidTypeException($text, 'string');
        }
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->text;
    }

    /**
     * @param Text $other
     *
     * @return bool
     */
    public function equals(EquatableInterface $other)
    {
        return $other instanceof Text && $this->text === $other->getText();
    }
}
