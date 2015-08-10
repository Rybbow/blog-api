<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Blog\Model\Displayable;

use X\Common\Model\String\Text;

/**
 * Class Page
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
class Page implements DisplayableInterface
{
    /** @var Text */
    private $text;

    /**
     * @param Text $text
     */
    public function __construct(Text $text)
    {
        $this->text = $text;
    }

    /**
     * @return Text
     */
    public function getText()
    {
        return $this->text;
    }
}
