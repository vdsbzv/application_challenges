<?php

/*
 * This file is part of VdS Application Challanges.
 *
 * (c) 2021 Philipp Steingrebe <psteingrebe@vds.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace VdS\Test;

use stdClass;

class FooTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \VdS\ApplicationChallanges\Foo
     */

    protected $foo;

    public function setUp() : void
    {
        $this->foo = new \VdS\ApplicationChallanges\Foo;
    }

    public function testIsPowerOfTwo()
    {
        $power = random_int(1, 20);
        $this->assertTrue($this->foo->isPowerOfTwo(pow(2, $power)));
        $this->assertFalse($this->foo->isPowerOfTwo(pow(2, $power) - 1));
    }

    public function testGetPrevArgument()
    {
        $this->assertNull($this->foo->getPrevArgument(10));
        $this->assertSame(10, $this->foo->getPrevArgument(20));
    }

    public function testUniversalGet()
    {
        $simpleObject = new stdClass;
        $simpleObject->key = 'value';

        $complexObject = new class {
            public function getKey()
            {
                return 'value';
            }
        };

        $array = [
            'key' => 'value'
        ];

        // Assert default value is `null`
        $this->assertNull($this->foo->universalGet(null, 'key'));
        // Assert default value can be changed
        $this->assertSame('default', $this->foo->universalGet(null, 'key', 'default'));

        // Assert object access
        $this->assertSame('value', $this->foo->universalGet($simpleObject, 'key'));
        // Assert object access fallback
        $this->assertSame('default', $this->foo->universalGet($simpleObject, 'unknownKey', 'default'));

        // Assert getter access
        $this->assertSame('value', $this->foo->universalGet($complexObject, 'key'));
        // Assert getter access fallback
        $this->assertSame('default', $this->foo->universalGet($complexObject, 'unknownKey', 'default'));

        // Assert array access
        $this->assertSame('value', $this->foo->universalGet($array, 'key'));
        // Assert array access fallback
        $this->assertSame('default', $this->foo->universalGet($array, 'unknownKey', 'default'));
    }
}
