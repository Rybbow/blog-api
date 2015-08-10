<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Common\Collection;

use Doctrine\Common\Collections\AbstractLazyCollection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use X\Common\Exception\InvalidTypeException;
use X\Common\Exception\NonUniqueElementException;
use X\Common\Type\TypeHelper;


/**
 * Class TypedCollection
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
class TypedCollection extends AbstractLazyCollection
{
    /** @var string */
    private $type;

    /**
     * @param string     $type
     * @param Collection $collection
     */
    public function __construct($type, Collection $collection = null)
    {
        // @todo verify value integrity in passed collection -> doInitialize

        $this->type       = $type;
        $this->collection = $collection ? : new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function add($element)
    {
        $this->verifyTypeIntegrity($element);
        if ($this->contains($element)) {
            return false;
        }

        return parent::add($element);
    }

    /**
     * {@inheritdoc}
     */
    public function contains($element)
    {
        if (!$this->isValidType($element)) {
            return false;
        }

        return parent::contains($element);
    }

    /**
     * {@inheritdoc}
     */
    public function removeElement($element)
    {
        if (!$this->isValidType($element)) {
            return false;
        }

        return parent::removeElement($element);
    }

    /**
     * {@inheritdoc}
     */
    public function indexOf($element)
    {
        if (!$this->isValidType($element)) {
            return false;
        }

        return parent::indexOf($element);
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value)
    {
        $this->verifyTypeIntegrity($value);
        $this->verifyUnique($key, $value);

        parent::set($key, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        $this->verifyTypeIntegrity($value);
        $this->verifyUnique($offset, $value);

        parent::offsetSet($offset, $value);
    }

    /**
     * Do the initialization logic
     *
     * @return void
     */
    protected function doInitialize()
    {
    }

    /**
     * @param mixed $element
     *
     * @return bool
     */
    private function isValidType($element)
    {
        return TypeHelper::isOfType($element, $this->type);
    }

    /**
     * @param mixed $element
     */
    private function verifyTypeIntegrity($element)
    {
        if (!$this->isValidType($element)) {
            throw new InvalidTypeException($element, $this->type);
        }
    }

    /**
     * @param mixed $key
     * @param mixed $element
     */
    private function verifyUnique($key, &$element)
    {
        if ($this->offsetGet($key) !== $element && $this->contains($element)) {
            throw new NonUniqueElementException($element);
        }
    }
}
