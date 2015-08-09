<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Common\Model\Identifier;

use Rhumsaa\Uuid\Uuid;
use X\Common\Model\Comparison\EquatableInterface;


/**
 * Class AbstractId
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
abstract class AbstractId implements EquatableInterface
{
    /** @var Uuid */
    private $value;

    /**
     *
     */
    public function __construct()
    {
        $this->value = Uuid::uuid5($this->getScopeUuid(), $this->getScope());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->value;
    }

    /**
     * @return Uuid
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return Uuid
     */
    public function getUuid()
    {
        return $this->value;
    }

    /**
     * @param EquatableInterface $other
     *
     * @return bool
     */
    public function equals(EquatableInterface $other)
    {
        return $other instanceof AbstractId && $this->value->equals($other->getUuid());
    }

    /**
     * @return Uuid|string
     */
    abstract protected function getScopeUuid();

    /**
     * @return string
     */
    abstract protected function getScope();

}