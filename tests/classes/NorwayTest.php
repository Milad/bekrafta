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
        $this->assertFalse($validator->validate('18099805991'));
        $this->assertFalse($validator->validate('53124717928'));
    }

    public function testGetAge() {
        $today = '2017-07-19';

        $validator = new Norway();

        $this->assertEquals(0, $validator->getAge('22071799674', $today));
        $this->assertEquals(0, $validator->getAge('22071799402', $today));
        $this->assertEquals(0, $validator->getAge('22071799240', $today));
        $this->assertEquals(21, $validator->getAge('29029600013', $today));
        $this->assertEquals(0, $validator->getAge('22071799755', $today));
        $this->assertEquals(0, $validator->getAge('22071799593', $today));
        $this->assertEquals(0, $validator->getAge('22071799321', $today));
        $this->assertEquals(117, $validator->getAge('01129955131', $today));
        $this->assertEquals(1, $validator->getAge('03111590925', $today));
        $this->assertEquals(15, $validator->getAge('03110175225', $today));
        $this->assertEquals(116, $validator->getAge('01010114388', $today));
        $this->assertEquals(116, $validator->getAge('01010116550', $today));
        $this->assertEquals(116, $validator->getAge('01010149939', $today));
        $this->assertEquals(17, $validator->getAge('15070091884', $today));
        $this->assertEquals(18, $validator->getAge('12119806192', $today));
        $this->assertEquals(63, $validator->getAge('11115328435', $today));
        $this->assertEquals(67, $validator->getAge('27124939173', $today));
        $this->assertEquals(84, $validator->getAge('22103238602', $today));
        $this->assertEquals(13, $validator->getAge('12050464596', $today));
        $this->assertEquals(146, $validator->getAge('17037174246', $today));
        $this->assertEquals(148, $validator->getAge('14036950049', $today));
        $this->assertEquals(3, $validator->getAge('29101353689', $today));
        $this->assertEquals(8, $validator->getAge('15090869180', $today));
        $this->assertEquals(107, $validator->getAge('31031022188', $today));
        $this->assertEquals(75, $validator->getAge('05084115322', $today));
        $this->assertEquals(72, $validator->getAge('15104491526', $today));
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

    public function testGetGender() {
        $validator = new Norway();

        $this->assertEquals('f', $validator->getGender('22071799674'));
        $this->assertEquals('f', $validator->getGender('22071799402'));
        $this->assertEquals('f', $validator->getGender('22071799240'));
        $this->assertEquals('f', $validator->getGender('29029600013'));
        $this->assertEquals('m', $validator->getGender('22071799755'));
        $this->assertEquals('m', $validator->getGender('22071799593'));
        $this->assertEquals('m', $validator->getGender('22071799321'));
        $this->assertEquals('m', $validator->getGender('05084115322'));
        $this->assertEquals('m', $validator->getGender('21034535105'));
        $this->assertEquals('m', $validator->getGender('25127115195'));
        $this->assertEquals('m', $validator->getGender('14090790987'));
        $this->assertEquals('m', $validator->getGender('18112481504'));
        $this->assertEquals('f', $validator->getGender('26090380809'));
        $this->assertEquals('f', $validator->getGender('07076627678'));
        $this->assertEquals('f', $validator->getGender('17099033487'));
        $this->assertEquals('f', $validator->getGender('23047652480'));
    }
}
