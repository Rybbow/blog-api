<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Common\Spec\Matcher;

use X\Common\Type\TypeHelper;


/**
 * Class IterableMatcherUtil
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
final class IterableMatcherUtil
{
    public static function register(array $matchers = [])
    {
        $class = new \ReflectionClass(self::class);
        foreach ($class->getMethods(\ReflectionMethod::IS_STATIC | \ReflectionMethod::IS_PUBLIC) as $method) {
            /** @var \ReflectionMethod $method */
            $name = $method->getName();
            if ($name === __METHOD__) {
                continue;
            }
            if (array_key_exists($name, $matchers)) {
                throw new \OutOfBoundsException(sprintf('Matcher with name "%s" is already registered.', $name));
            }
            $matchers[$name] = [self::class, $name];
        }

        return $matchers;
    }

    /**
     * @param array|\Traversable $subject
     * @param mixed $value
     *
     * @return bool
     */
    public static function contain($subject, $value)
    {
        if (is_array($subject)) {
            return in_array($value, $subject, true);
        }
        if ($subject instanceof \Traversable) {
            foreach ($subject as $entry) {
                if ($entry === $value) {
                    return true;
                }
            }

            return false;
        }

        throw new \InvalidArgumentException(sprintf('Subject of type "%s" is not iterable.', TypeHelper::getType($subject)));
    }


    private function __construct()
    { }
}