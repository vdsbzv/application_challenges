<?php

/*
 * This file is part of VdS Application Challanges.
 *
 * (c) 2021 Philipp Steingrebe <psteingrebe@vds.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace VdS\ApplicationChallanges;

class FooSolution
{
    /**
     * Determines whether the specified candidate is power of two.
     *
     * @param      int   $candidate  The candidate
     *
     * @return     bool  True if the specified candidate is power of two, False otherwise.
     */

    public function isPowerOfTwo(int $candidate) : bool
    {
        //return ($candidate & ($candidate - 1)) === 0;

        // Alternative
        while (is_int($candidate /= 2)) {}
        return $candidate === .5;
    }

    /**
     * Gets the previous argument this method was called
     * with. The first call returns `null`.
     *
     * @param      mixed  $arg    The argument
     *
     * @return     mixed|null  The previous argument.
     */

    public function getPrevArgument($arg)
    {
        static $prev;

        $tmp = $prev;
        $prev = $arg;

        return $tmp;
    }

    /**
     * This method tries to access given key on stack.
     *
     * @param      object|array  $stack    The stack
     * @param      int|string    $key      The key
     * @param      mixed|null    $default  The default value if key is not accessible
     */
    public function universalGet($stack, $key, $default = null)
    {
        if (is_array($stack) && array_key_exists($key, $stack)) {
            return $stack[$key];
        }

        if (is_object($stack)) {
            if (property_exists($stack, $key)) {
                return $stack->$key;
            }

            $getter = 'get' . ucfirst($key);

            if (method_exists($stack, $getter)) {
                return $stack->$getter();
            }
        }

        return $default;
    }
}