<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Blog\Model\Identifier;

use Rhumsaa\Uuid\Uuid;
use X\Common\Model\Identifier\AbstractId;


/**
 * Class BlogId
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
class BlogId extends AbstractId
{
    /**
     * @return Uuid|string
     */
    protected function getScopeUuid()
    {
        return 'd1dfcd89-380b-4b74-b363-786e4e45f236';
    }

    /**
     * @return string
     */
    protected function getScope()
    {
        return 'blog';
    }

}