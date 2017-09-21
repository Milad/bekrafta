<?php
/*
88""Yb 888888 88  dP 88""Yb    db    888888 888888    db
88__dP 88__   88odP  88__dP   dPYb   88__     88     dPYb
88""Yb 88""   88"Yb  88"Yb   dP__Yb  88""     88    dP__Yb
88oodP 888888 88  Yb 88  Yb dP""""Yb 88       88   dP""""Yb
*/

namespace Bekrafta\Tests;

use Bekrafta\Denmark;
use PHPUnit\Framework\TestCase;

class DenmarkTest extends TestCase {
    public function testValidate() {
        $this->assertTrue((new Denmark('130600-5738'))->validate());
        $this->assertTrue((new Denmark('070777-1119'))->validate());
        $this->assertTrue((new Denmark('260783-1234'))->validate());
        $this->assertTrue((new Denmark('120494-3806'))->validate());
        $this->assertTrue((new Denmark('220890-4895'))->validate());
        $this->assertTrue((new Denmark('310586-4948'))->validate());
        $this->assertTrue((new Denmark('171263-1615'))->validate());
        $this->assertTrue((new Denmark('150517-3712'))->validate());
        $this->assertTrue((new Denmark('120917-3804'))->validate());
    }

    public function testGetAge() {
        $today = '2017-07-19';

        $this->assertEquals(17, (new Denmark('130600-5738'))->getAge($today));
        $this->assertEquals(40, (new Denmark('070777-1119'))->getAge($today));
        $this->assertEquals(33, (new Denmark('260783-1234'))->getAge($today));
        $this->assertEquals(23, (new Denmark('120494-3806'))->getAge($today));
        $this->assertEquals(26, (new Denmark('220890-4895'))->getAge($today));
        $this->assertEquals(31, (new Denmark('310586-4948'))->getAge($today));
        $this->assertEquals(53, (new Denmark('171263-1615'))->getAge($today));
        $this->assertEquals(100, (new Denmark('150517-3712'))->getAge($today));
        $this->assertEquals(99, (new Denmark('120917-3804'))->getAge($today));
        $this->assertEquals(154, (new Denmark('211062-5629'))->getAge($today));
    }

    public function testGetCensored() {
        $this->assertEquals('130600-****', (new Denmark('130600-5738'))->getCensored());
        $this->assertEquals('070777-****', (new Denmark('070777-1119'))->getCensored());
    }

    public function testGetGender() {
        $this->assertEquals('f', (new Denmark('130600-5738'))->getGender());
        $this->assertEquals('m', (new Denmark('070777-1119'))->getGender());
        $this->assertEquals('f', (new Denmark('260783-1234'))->getGender());
        $this->assertEquals('f', (new Denmark('120494-3806'))->getGender());
        $this->assertEquals('m', (new Denmark('220890-4895'))->getGender());
        $this->assertEquals('f', (new Denmark('310586-4948'))->getGender());
        $this->assertEquals('m', (new Denmark('171263-1615'))->getGender());
        $this->assertEquals('f', (new Denmark('150517-3712'))->getGender());
        $this->assertEquals('f', (new Denmark('120917-3804'))->getGender());
    }
}
