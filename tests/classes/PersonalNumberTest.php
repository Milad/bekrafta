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
        $this->assertTrue((new PersonalNumber('19470304-2657'))->detect());

        $this->assertTrue((new PersonalNumber('270846-627Y'))->detect());
        $this->assertTrue((new PersonalNumber('130781-4116'))->detect());
        $this->assertTrue((new PersonalNumber('280162-343X'))->detect());

        $this->assertFalse((new PersonalNumber('877898-8797'))->detect());
        $this->assertFalse((new PersonalNumber('545685-8723'))->detect());

        $this->assertTrue((new PersonalNumber('22071799674'))->detect());
        $this->assertTrue((new PersonalNumber('22071799402'))->detect());
        $this->assertFalse((new PersonalNumber('22071799404'))->detect());
    }

    public function testGetCensored() {
        $obj = new PersonalNumber('571124-1322');
        $this->assertEquals('571124-****', $obj->getCensored());

        $obj = new PersonalNumber('270846-627Y');
        $this->assertEquals('270846-****', $obj->getCensored());

        $obj = new PersonalNumber('22071799674');
        $this->assertEquals('220717*****', $obj->getCensored());

        $obj = new PersonalNumber('877898-8797');
        $this->expectException(Exception::class);
        $obj->getCensored();
    }

    public function testGetAge() {
        $today = '2017-07-19';

        $obj = new PersonalNumber('571124-1322');
        $this->assertEquals(59, $obj->getAge($today));
        $obj = new PersonalNumber('010808A704V');
        $this->assertEquals(8, $obj->getAge($today));
        $obj = new PersonalNumber('280731-743N');
        $this->assertEquals(85, $obj->getAge($today));

        $obj = new PersonalNumber('877898-8797');
        $this->expectException(Exception::class);
        $obj->getAge($today);
    }
}
