<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Blog\Exception;

use X\Blog\Model\Blog;

/**
 * Class BlogAuthorCannotChangeException
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
class BlogAuthorCannotChangeException extends ModelException
{
    /**
     * @param Blog       $blog
     * @param int        $code
     * @param \Exception $previous
     */
    public function __construct(Blog $blog, $code = 0, \Exception $previous = null)
    {
        parent::__construct(sprintf('Blog "%s" cannot change its author.', $blog), $code, $previous);
    }
}
