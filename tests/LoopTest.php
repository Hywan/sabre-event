<?php

namespace Sabre\Event;

class LoopTest extends \PHPUnit_Framework_TestCase {

    function testLoop() {

        $loop = Loop::get();
        $hi = 1;
        $loop->nextTick(function() use (&$hi) {

            $hi+=2;

        });

        $this->assertEquals(1, $hi);

        $this->assertTrue($loop->start());

        $this->assertEquals(3, $hi);

    }

    function testLoopStartTwice() {

        $loop = Loop::get();
        $hi = 1;
        $loop->nextTick(function() use (&$hi, $loop) {

            $this->assertFalse($loop->start());
            $hi+=2;

        });

        $this->assertTrue($loop->start());
        $this->assertEquals(3, $hi);

    }
}
