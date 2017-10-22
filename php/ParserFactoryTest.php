<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 23.10.2017
 * Time: 1:31
 */

namespace RedBeanPHP;


class ParserFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testPushAndPop(): void
    {
        $stack = [];
        $this->assertEquals(0, count($stack));

        array_push($stack, 'foo');
        $this->assertEquals('foo', $stack[count($stack)-1]);
        $this->assertEquals(1, count($stack));

        $this->assertEquals('foo', array_pop($stack));
        $this->assertEquals(0, count($stack));
    }

    
}
