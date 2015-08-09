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
 * Class AuthorId
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
class AuthorId extends AbstractId
{
    /**
     * @return Uuid|string
     */
    protected function getScopeUuid()
    {
        return '738bef93-4109-4589-a4cf-0f8fcabfcfdb';
    }

    /**
     * @return string
     */
    protected function getScope()
    {
        return 'author';
    }

}