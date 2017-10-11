<?php
/*
88""Yb 888888 88  dP 88""Yb    db    888888 888888    db
88__dP 88__   88odP  88__dP   dPYb   88__     88     dPYb
88""Yb 88""   88"Yb  88"Yb   dP__Yb  88""     88    dP__Yb
88oodP 888888 88  Yb 88  Yb dP""""Yb 88       88   dP""""Yb
*/

namespace Bekrafta\Tests;

use Bekrafta\Netherlands;
use PHPUnit\Framework\TestCase;

class NetherlandsTest extends TestCase {
    public function testValidate() {
        $this->assertTrue((new Netherlands('111222333'))->validate());
        $this->assertTrue((new Netherlands('123456782'))->validate());
        $this->assertFalse((new Netherlands('123456781'))->validate());
    }

    public function testGetCensored() {
        $this->assertEquals('111222333', (new Netherlands('111222333'))->getCensored());
        $this->assertEquals('123456782', (new Netherlands('123456782'))->getCensored());
    }

    public function testGetAge() {
        $this->assertEquals(0, (new Netherlands('111222333'))->getAge());
        $this->assertEquals(0, (new Netherlands('123456782'))->getAge());
    }

    public function testGetGender() {
        $this->assertEquals('', (new Netherlands('111222333'))->getGender());
        $this->assertEquals('', (new Netherlands('123456782'))->getGender());
    }

    public function testGetYear() {
        $this->assertEquals('', (new Netherlands('111222333'))->getYear());
        $this->assertEquals('', (new Netherlands('123456782'))->getYear());
    }

    public function testGetBirthday() {
        $this->assertEquals('', (new Netherlands('111222333'))->getBirthday());
        $this->assertEquals('', (new Netherlands('123456782'))->getBirthday());
    }
}
