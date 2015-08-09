<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\BlogBundle\Service\Slug;

use Doctrine\Common\Util\Inflector;
use X\Blog\Model\ValueObject\Slug;
use X\Blog\Service\Slug\SlugifierInterface;
use X\Common\Model\String\Text;

/**
 * Class DoctrineInflectorSlugifier
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
class DoctrineInflectorSlugifier implements SlugifierInterface
{
    /**
     * @param Text $text
     *
     * @return Slug
     */
    public function slugify(Text $text)
    {
        return new Slug(Inflector::tableize((string) $text));
    }

}
