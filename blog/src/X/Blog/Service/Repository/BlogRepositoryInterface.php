<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Blog\Service\Repository;

use X\Blog\Model\Blog;

/**
 * Interface BlogRepositoryInterface
 *
 * @author  Michał Rybnik <michal.rybnik@fuero.pl> 
 */
interface BlogRepositoryInterface
{
    /**
     * @param Blog $blog
     */
    public function save(Blog $blog);
}