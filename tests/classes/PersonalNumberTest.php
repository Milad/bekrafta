<?php

namespace Bekrafta\Tests;

use Bekrafta\PersonalNumber;
use Exception;
use PHPUnit\Framework\TestCase;

class PersonalNumberTest extends TestCase {
    public function testDetect() {
        $this->assertTrue((new PersonalNumber('571124-1322'))->detect());
        $this->assertTrue((new PersonalNumber('470304-2657'))->detect());
        $this->assertTrue((new PersonalNumber('194703042657'))->detect());

        $this->assertTrue((new PersonalNumber('270846-627Y'))->detect());
        $this->assertTrue((new PersonalNumber('130781-4116'))->detect());
        $this->assertTrue((new PersonalNumber('280162-343X'))->detect());

        $this->assertFalse((new PersonalNumber('877898-8797'))->detect());
        $this->assertFalse((new PersonalNumber('545685-8723'))->detect());
    }

    public function testGetCensored() {
        $obj = new PersonalNumber('571124-1322');
        $this->expectException(Exception::class);
        $obj->getCensored();

        $obj = new PersonalNumber('877898-8797');
        $obj->detect();
        $this->expectException(Exception::class);
        $obj->getCensored();

        $obj = new PersonalNumber('571124-1322');
        $obj->detect();
        $this->assertEquals('571124-1322', $obj->getCensored('571124-1322'));

        $obj = new PersonalNumber('571124-1322');
        $obj->detect();
        $this->assertEquals('270846-627Y', $obj->getCensored('270846-627Y'));
    }
}
