<?php
/*
88""Yb 888888 88  dP 88""Yb    db    888888 888888    db
88__dP 88__   88odP  88__dP   dPYb   88__     88     dPYb
88""Yb 88""   88"Yb  88"Yb   dP__Yb  88""     88    dP__Yb
88oodP 888888 88  Yb 88  Yb dP""""Yb 88       88   dP""""Yb
*/

namespace Bekrafta\Tests;

use Bekrafta\Poland;
use PHPUnit\Framework\TestCase;

/**
 * Class PolandTest
 * @package Bekrafta\Tests
 * @group milad
 */
class PolandTest extends TestCase {
    public function testValidate() {
        $this->assertFalse((new Poland('44051401351'))->validate());
        $this->assertFalse((new Poland('44051401352'))->validate());
        $this->assertFalse((new Poland('44051401353'))->validate());
        $this->assertFalse((new Poland('44051401354'))->validate());
        $this->assertFalse((new Poland('44051401355'))->validate());
        $this->assertFalse((new Poland('44051401356'))->validate());
        $this->assertFalse((new Poland('44051401357'))->validate());
        $this->assertFalse((new Poland('44051401358'))->validate());
        $this->assertTrue((new Poland('44051401359'))->validate());
        $this->assertFalse((new Poland('44051401350'))->validate());
        $this->assertTrue((new Poland('31020908809'))->validate());
        $this->assertTrue((new Poland('67262790801'))->validate());
        $this->assertTrue((new Poland('67090550002'))->validate());
        $this->assertTrue((new Poland('04020506179'))->validate());
        $this->assertTrue((new Poland('34230487249'))->validate());
        $this->assertTrue((new Poland('26321891950'))->validate());
        $this->assertTrue((new Poland('45260298217'))->validate());
        $this->assertFalse((new Poland('59101503402'))->validate());
        $this->assertFalse((new Poland('91051223602'))->validate());
        $this->assertFalse((new Poland('67010523892'))->validate());
        $this->assertFalse((new Poland('98101267595'))->validate());
        $this->assertFalse((new Poland('57120912947'))->validate());
        $this->assertFalse((new Poland('82123301259'))->validate());
        $this->assertFalse((new Poland('56120317609'))->validate());
        $this->assertFalse((new Poland('87111909834'))->validate());
        $this->assertFalse((new Poland('79092398739'))->validate());
        $this->assertFalse((new Poland('66120822178'))->validate());
        $this->assertFalse((new Poland('61121001236'))->validate());
        $this->assertFalse((new Poland('44052401458'))->validate());
        $this->assertTrue((new Poland('44051401458'))->validate());
        $this->assertFalse((new Poland('12345678909'))->validate());
        $this->assertTrue((new Poland('44051401458'))->validate());
        $this->assertTrue((new Poland('35020691714'))->validate());
        $this->assertTrue((new Poland('92012919764'))->validate());
        $this->assertTrue((new Poland('59061216433'))->validate());
        $this->assertTrue((new Poland('36030687715'))->validate());
        $this->assertTrue((new Poland('54111019473'))->validate());
        $this->assertTrue((new Poland('97091106384'))->validate());
        $this->assertTrue((new Poland('86091447412'))->validate());
        $this->assertTrue((new Poland('83422812334'))->validate());
        $this->assertTrue((new Poland('83622812330'))->validate());
    }

    public function testGetCensored() {
        $this->assertEquals('440514*****', (new Poland('44051401359'))->getCensored());
        $this->assertEquals('310209*****', (new Poland('31020908809'))->getCensored());
        $this->assertEquals('672627*****', (new Poland('67262790801'))->getCensored());
        $this->assertEquals('670905*****', (new Poland('67090550002'))->getCensored());
        $this->assertEquals('040205*****', (new Poland('04020506179'))->getCensored());
        $this->assertEquals('342304*****', (new Poland('34230487249'))->getCensored());
        $this->assertEquals('263218*****', (new Poland('26321891950'))->getCensored());
        $this->assertEquals('452602*****', (new Poland('45260298217'))->getCensored());
        $this->assertEquals('440514*****', (new Poland('44051401458'))->getCensored());
        $this->assertEquals('440514*****', (new Poland('44051401458'))->getCensored());
        $this->assertEquals('350206*****', (new Poland('35020691714'))->getCensored());
        $this->assertEquals('920129*****', (new Poland('92012919764'))->getCensored());
        $this->assertEquals('590612*****', (new Poland('59061216433'))->getCensored());
        $this->assertEquals('360306*****', (new Poland('36030687715'))->getCensored());
        $this->assertEquals('541110*****', (new Poland('54111019473'))->getCensored());
        $this->assertEquals('860914*****', (new Poland('86091447412'))->getCensored());
        $this->assertEquals('834228*****', (new Poland('83422812334'))->getCensored());
        $this->assertEquals('836228*****', (new Poland('83622812330'))->getCensored());
    }

    public function testGetAge() {
        $today = '2017-07-19';

        $this->assertEquals(73, (new Poland('44051401359'))->getAge($today));
        $this->assertEquals(86, (new Poland('31020908809'))->getAge($today));
        $this->assertEquals(49, (new Poland('67090550002'))->getAge($today));
        $this->assertEquals(113, (new Poland('04020506179'))->getAge($today));
        $this->assertEquals(73, (new Poland('44051401458'))->getAge($today));
        $this->assertEquals(82, (new Poland('35020691714'))->getAge($today));
        $this->assertEquals(25, (new Poland('92012919764'))->getAge($today));
        $this->assertEquals(58, (new Poland('59061216433'))->getAge($today));
        $this->assertEquals(81, (new Poland('36030687715'))->getAge($today));
        $this->assertEquals(62, (new Poland('54111019473'))->getAge($today));
        $this->assertEquals(30, (new Poland('86091447412'))->getAge($today));
    }

    public function testGetGender() {
        $this->assertEquals('m', (new Poland('44051401359'))->getGender());
        $this->assertEquals('f', (new Poland('31020908809'))->getGender());
        $this->assertEquals('f', (new Poland('67262790801'))->getGender());
        $this->assertEquals('f', (new Poland('67090550002'))->getGender());
        $this->assertEquals('m', (new Poland('04020506179'))->getGender());
        $this->assertEquals('f', (new Poland('34230487249'))->getGender());
        $this->assertEquals('m', (new Poland('26321891950'))->getGender());
        $this->assertEquals('m', (new Poland('45260298217'))->getGender());
        $this->assertEquals('m', (new Poland('44051401458'))->getGender());
        $this->assertEquals('m', (new Poland('44051401458'))->getGender());
        $this->assertEquals('m', (new Poland('35020691714'))->getGender());
        $this->assertEquals('f', (new Poland('92012919764'))->getGender());
        $this->assertEquals('m', (new Poland('59061216433'))->getGender());
        $this->assertEquals('m', (new Poland('36030687715'))->getGender());
        $this->assertEquals('m', (new Poland('54111019473'))->getGender());
        $this->assertEquals('m', (new Poland('86091447412'))->getGender());
        $this->assertEquals('m', (new Poland('83422812334'))->getGender());
        $this->assertEquals('m', (new Poland('83622812330'))->getGender());
    }

    public function testGetBirthday() {
        $this->assertEquals('2067-06-27', (new Poland('67262790801'))->getBirthday());
        $this->assertEquals('2034-03-04', (new Poland('34230487249'))->getBirthday());
        $this->assertEquals('2026-12-18', (new Poland('26321891950'))->getBirthday());
        $this->assertEquals('2045-06-02', (new Poland('45260298217'))->getBirthday());
        $this->assertEquals('2183-02-28', (new Poland('83422812334'))->getBirthday());
        $this->assertEquals('2283-02-28', (new Poland('83622812330'))->getBirthday());
    }
}
