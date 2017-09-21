<?php
/*
88""Yb 888888 88  dP 88""Yb    db    888888 888888    db
88__dP 88__   88odP  88__dP   dPYb   88__     88     dPYb
88""Yb 88""   88"Yb  88"Yb   dP__Yb  88""     88    dP__Yb
88oodP 888888 88  Yb 88  Yb dP""""Yb 88       88   dP""""Yb
*/

namespace Bekrafta\Tests;

use Bekrafta\Norway;
use PHPUnit\Framework\TestCase;

class NorwayTest extends TestCase {
    public function testValidate() {
        // https://en.wikipedia.org/wiki/National_identification_number#Norway
        $this->assertTrue((new Norway('22071799674'))->validate());
        $this->assertTrue((new Norway('22071799402'))->validate());
        $this->assertTrue((new Norway('22071799240'))->validate());
        $this->assertTrue((new Norway('29029600013'))->validate());
        $this->assertTrue((new Norway('22071799755'))->validate());
        $this->assertTrue((new Norway('22071799593'))->validate());
        $this->assertTrue((new Norway('22071799321'))->validate());

        $this->assertFalse((new Norway('22071799325'))->validate());
        $this->assertFalse((new Norway('03119975255'))->validate());
        $this->assertFalse((new Norway('67047000658'))->validate());
        $this->assertFalse((new Norway('18099805991'))->validate());
        $this->assertFalse((new Norway('53124717928'))->validate());
    }

    public function testGetAge() {
        $today = '2017-07-19';

        $this->assertEquals(0, (new Norway('22071799674'))->getAge($today));
        $this->assertEquals(0, (new Norway('22071799402'))->getAge($today));
        $this->assertEquals(0, (new Norway('22071799240'))->getAge($today));
        $this->assertEquals(21, (new Norway('29029600013'))->getAge($today));
        $this->assertEquals(0, (new Norway('22071799755'))->getAge($today));
        $this->assertEquals(0, (new Norway('22071799593'))->getAge($today));
        $this->assertEquals(0, (new Norway('22071799321'))->getAge($today));
        $this->assertEquals(117, (new Norway('01129955131'))->getAge($today));
        $this->assertEquals(1, (new Norway('03111590925'))->getAge($today));
        $this->assertEquals(15, (new Norway('03110175225'))->getAge($today));
        $this->assertEquals(116, (new Norway('01010114388'))->getAge($today));
        $this->assertEquals(116, (new Norway('01010116550'))->getAge($today));
        $this->assertEquals(116, (new Norway('01010149939'))->getAge($today));
        $this->assertEquals(17, (new Norway('15070091884'))->getAge($today));
        $this->assertEquals(18, (new Norway('12119806192'))->getAge($today));
        $this->assertEquals(63, (new Norway('11115328435'))->getAge($today));
        $this->assertEquals(67, (new Norway('27124939173'))->getAge($today));
        $this->assertEquals(84, (new Norway('22103238602'))->getAge($today));
        $this->assertEquals(13, (new Norway('12050464596'))->getAge($today));
        $this->assertEquals(146, (new Norway('17037174246'))->getAge($today));
        $this->assertEquals(148, (new Norway('14036950049'))->getAge($today));
        $this->assertEquals(3, (new Norway('29101353689'))->getAge($today));
        $this->assertEquals(8, (new Norway('15090869180'))->getAge($today));
        $this->assertEquals(107, (new Norway('31031022188'))->getAge($today));
        $this->assertEquals(75, (new Norway('05084115322'))->getAge($today));
        $this->assertEquals(72, (new Norway('15104491526'))->getAge($today));
    }

    public function testGetCensored() {
        $this->assertEquals('220717*****', (new Norway('22071799674'))->getCensored());
        $this->assertEquals('220717*****', (new Norway('22071799402'))->getCensored());
        $this->assertEquals('220717*****', (new Norway('22071799240'))->getCensored());
        $this->assertEquals('290296*****', (new Norway('29029600013'))->getCensored());
        $this->assertEquals('220717*****', (new Norway('22071799755'))->getCensored());
        $this->assertEquals('220717*****', (new Norway('22071799593'))->getCensored());
        $this->assertEquals('220717*****', (new Norway('22071799321'))->getCensored());
    }

    public function testGetGender() {
        $this->assertEquals('f', (new Norway('22071799674'))->getGender());
        $this->assertEquals('f', (new Norway('22071799402'))->getGender());
        $this->assertEquals('f', (new Norway('22071799240'))->getGender());
        $this->assertEquals('f', (new Norway('29029600013'))->getGender());
        $this->assertEquals('m', (new Norway('22071799755'))->getGender());
        $this->assertEquals('m', (new Norway('22071799593'))->getGender());
        $this->assertEquals('m', (new Norway('22071799321'))->getGender());
        $this->assertEquals('m', (new Norway('05084115322'))->getGender());
        $this->assertEquals('m', (new Norway('21034535105'))->getGender());
        $this->assertEquals('m', (new Norway('25127115195'))->getGender());
        $this->assertEquals('m', (new Norway('14090790987'))->getGender());
        $this->assertEquals('m', (new Norway('18112481504'))->getGender());
        $this->assertEquals('f', (new Norway('26090380809'))->getGender());
        $this->assertEquals('f', (new Norway('07076627678'))->getGender());
        $this->assertEquals('f', (new Norway('17099033487'))->getGender());
        $this->assertEquals('f', (new Norway('23047652480'))->getGender());
    }
}
