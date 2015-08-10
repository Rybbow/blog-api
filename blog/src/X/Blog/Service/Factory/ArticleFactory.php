<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Blog\Service\Factory;

use X\Blog\Model\Content;
use X\Blog\Model\Displayable\DisplayableInterface;
use X\Blog\Model\Displayable\Page;
use X\Blog\Model\Post\Article;
use X\Blog\Model\ValueObject\PostInfo;
use X\Common\Model\String\Text;

/**
 * Class ArticleFactory
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
class ArticleFactory extends AbstractPostFactory
{
    /**
     * @param PostInfo $postInfo
     * @param Content  $content
     *
     * @return Article
     */
    protected function doCreate(PostInfo $postInfo, Content $content)
    {
        return new Article($postInfo, $content);
    }

    /**
     * @param mixed $raw
     *
     * @return DisplayableInterface
     */
    protected function doConvertToDisplayable($raw)
    {
        return new Page(new Text($raw));
    }


}
