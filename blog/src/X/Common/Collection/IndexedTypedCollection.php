<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Common\Collection;

use Doctrine\Common\Collections\Collection;
use X\Common\Exception\InvalidKeyTypeException;
use X\Common\Exception\InvalidTypeException;
use X\Common\Type\TypeHelper;

/**
 * Class IndexedTypedCollection
 *
 * @author  Michał Rybnik <rybbow@gmail.com>
 */
class IndexedTypedCollection extends TypedCollection
{
    public static $invalidKeyTypes = ['array', 'resource'];

    /** @var string */
    private $keyType;

    /** @var string|callable */
    private $keyExtractor;

    /**
     * @param string     $keyType
     * @param string     $type
     * @param Collection $collection
     */
    public function __construct($keyType, $type, Collection $collection = null, $keyExtractor = null)
    {
        if (in_array($keyType, self::$invalidKeyTypes, false)) {
            throw new InvalidKeyTypeException($keyType);
        }
        if ($keyExtractor && (!is_callable($keyExtractor) && !method_exists($type, $keyExtractor))) {
            throw new \InvalidArgumentException(sprintf('Passed keyExtractor is neither a callable nor a method of class "%s"', $type));
        }

        $this->keyType      = $keyType;
        $this->keyExtractor = $keyExtractor;

        // @todo verify key integrity in passed collection -> doInitialize
        parent::__construct($type, $collection);
    }

    /**
     * @return string
     */
    public function getKeyType()
    {
        return $this->keyType;
    }

    /**
     * @param mixed $element
     *
     * @return bool
     */
    public function add($element)
    {
        $key = $this->extractKey($element);
        $this->verifyKeyTypeIntegrity($key);

        $this->set($key, $element);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function remove($key)
    {
        $this->verifyKeyTypeIntegrity($key);

        return parent::remove($this->convertKeyToHash($key));
    }

    /**
     * {@inheritdoc}
     */
    public function containsKey($key)
    {
        if (!$this->isValidKeyType($key)) {
            return false;
        }

        return parent::containsKey($this->convertKeyToHash($key));
    }

    /**
     * {@inheritdoc}
     */
    public function get($key)
    {
        if (!$this->isValidKeyType($key)) {
            return null;
        }

        return parent::get($this->convertKeyToHash($key));
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        if (!$this->isValidKeyType($offset)) {
            return false;
        }

        return parent::offsetExists($this->convertKeyToHash($offset));
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        if (!$this->isValidKeyType($offset)) {
            return null;
        }

        return parent::offsetGet($this->convertKeyToHash($offset));
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        $this->verifyKeyTypeIntegrity($offset);

        parent::offsetUnset($this->convertKeyToHash($offset));
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value)
    {
        $this->verifyKeyTypeIntegrity($key);

        parent::set($this->convertKeyToHash($key), $value);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        $this->verifyKeyTypeIntegrity($offset);

        parent::offsetSet($this->convertKeyToHash($offset), $value);
    }

    /**
     * @param mixed $key
     *
     * @return bool
     */
    private function isValidKeyType($key)
    {
        return TypeHelper::isOfType($key, $this->keyType);
    }

    /**
     * @param mixed $key
     */
    private function verifyKeyTypeIntegrity(&$key)
    {
        if (!$this->isValidKeyType($key)) {
            throw new InvalidTypeException($key, $this->keyType);
        }
    }

    /**
     * @param mixed $key
     *
     * @return mixed
     * @throws InvalidKeyTypeException
     */
    private function convertKeyToHash(&$key)
    {
        if (is_scalar($key)) {
            return $key;
        }
        if (is_object($key) && method_exists($key, '__toString')) {
            return (string) $key;
        }

        throw new InvalidKeyTypeException(TypeHelper::getType($key));
    }

    private function extractKey($element)
    {
        if (!$this->keyExtractor) {
            throw new \BadMethodCallException('Cannot extract keys when no key extractor was specified.');
        }
//        if (is_callable($this->keyExtractor)) {
//
//        }

        return $element->{$this->keyExtractor}();
    }
}
