<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Blog\Service\Factory;

use X\Blog\Model\Post\Article;
use X\Blog\Model\ValueObject\PostInfo;
use X\Blog\Model\ContentInterface;

/**
 * Class ArticleFactory
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
class ArticleFactory extends AbstractPostFactory
{
    protected function doCreate(PostInfo $postInfo, ContentInterface $content)
    {
        return new Article($postInfo);
    }

}
