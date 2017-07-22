<?php

namespace Bekrafta\Tests;

use Bekrafta\Norway;
use PHPUnit\Framework\TestCase;

class NorwayTest extends TestCase {
    public function testValidate() {
        $validator = new Norway();

        // https://en.wikipedia.org/wiki/National_identification_number#Norway
        $this->assertTrue($validator->validate('22071799674'));
        $this->assertTrue($validator->validate('22071799402'));
        $this->assertTrue($validator->validate('22071799240'));
        $this->assertTrue($validator->validate('29029600013'));
        $this->assertTrue($validator->validate('22071799755'));
        $this->assertTrue($validator->validate('22071799593'));
        $this->assertTrue($validator->validate('22071799321'));

        $this->assertFalse($validator->validate('22071799325'));
        $this->assertFalse($validator->validate('03119975255'));
        $this->assertFalse($validator->validate('67047000658'));
    }

    public function testGetCensored() {
        $validator = new Norway();

        $this->assertEquals('220717*****', $validator->getCensored('22071799674'));
        $this->assertEquals('220717*****', $validator->getCensored('22071799402'));
        $this->assertEquals('220717*****', $validator->getCensored('22071799240'));
        $this->assertEquals('290296*****', $validator->getCensored('29029600013'));
        $this->assertEquals('220717*****', $validator->getCensored('22071799755'));
        $this->assertEquals('220717*****', $validator->getCensored('22071799593'));
        $this->assertEquals('220717*****', $validator->getCensored('22071799321'));
    }
}
