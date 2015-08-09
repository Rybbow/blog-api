<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\BlogBundle\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use X\Blog\Model\Blog;
use X\Blog\Model\Identifier\BlogId;
use X\Blog\Service\Repository\BlogRepositoryInterface;

/**
 * Class InMemoryBlogRepository
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
class InMemoryBlogRepository implements BlogRepositoryInterface
{
    /** @var ArrayCollection */
    private $storage;

    /**
     *
     */
    public function __construct()
    {
        $this->storage = new ArrayCollection();
    }

    /**
     * @param Blog $blog
     */
    public function save(Blog $blog)
    {
        $this->storage[(string) $blog->getId()] = $blog;
    }

    /**
     * @param BlogId $id
     *
     * @return Blog|null
     */
    public function find(BlogId $id)
    {
        $key = (string) $id;
        if (!$this->storage->containsKey($key)) {
            return null;
        }

        return $this->storage[$key];
    }
}
