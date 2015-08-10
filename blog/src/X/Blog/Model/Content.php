<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Blog\Model;

use X\Blog\Model\Collection\Displayables;
use X\Common\Model\String\Text;


/**
 * Class Content
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
class Content
{
    /** @var Text  */
    private $teaser;

    /** @var Displayables */
    private $displayables;

    /**
     * @param Text         $teaser
     * @param Displayables $displayables
     */
    public function __construct(Text $teaser, Displayables $displayables)
    {
        $this->teaser       = $teaser;
        $this->displayables = $displayables;
    }

    /**
     * @return Text
     */
    public function getTeaser()
    {
        return $this->teaser;
    }

    /**
     * @return Displayables
     */
    public function getDisplayables()
    {
        return $this->displayables;
    }
}