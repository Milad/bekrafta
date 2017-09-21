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

        $this->assertTrue((new PersonalNumber('130600-5738'))->detect());
        $this->assertTrue((new PersonalNumber('070777-1119'))->detect());
        $this->assertTrue((new PersonalNumber('260783-1234'))->detect());
        $this->assertTrue((new PersonalNumber('120494-3806'))->detect());
        $this->assertTrue((new PersonalNumber('220890-4895'))->detect());
        $this->assertTrue((new PersonalNumber('310586-4948'))->detect());
        $this->assertTrue((new PersonalNumber('171263-1615'))->detect());
        $this->assertTrue((new PersonalNumber('150517-3712'))->detect());
        $this->assertTrue((new PersonalNumber('120917-3804'))->detect());
        $this->assertTrue((new PersonalNumber('211062-5629'))->detect());
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

    public function testGetYear() {
        $obj = new PersonalNumber('240696-797T');
        $this->assertEquals('1996', $obj->getYear());

        $obj = new PersonalNumber('200278-704B');
        $this->assertEquals('1978', $obj->getYear());

        $obj = new PersonalNumber('21034535105');
        $this->assertEquals('1945', $obj->getYear());

        $obj = new PersonalNumber('07076627678');
        $this->assertEquals('1966', $obj->getYear());

        $obj = new PersonalNumber('671017-1239');
        $this->assertEquals('1967', $obj->getYear());

        $obj = new PersonalNumber('111228+7568');
        $this->assertEquals('1911', $obj->getYear());

        $obj = new PersonalNumber('19671017-1239');
        $this->assertEquals('1967', $obj->getYear());

        $obj = new PersonalNumber('19111228+7568');
        $this->assertEquals('1911', $obj->getYear());

        $obj = new PersonalNumber('310586-4948');
        $this->assertEquals('1986', $obj->getYear());

        $obj = new PersonalNumber('120494-3806');
        $this->assertEquals('1994', $obj->getYear());

        $obj = new PersonalNumber('211062-5629');
        $this->assertEquals('1862', $obj->getYear());

        $obj = new PersonalNumber('877898-8797');
        $this->expectException(Exception::class);
        $obj->getYear();
    }

    public function testGetGender() {
        $obj = new PersonalNumber('240696-797T');
        $this->assertEquals('m', $obj->getGender());

        $obj = new PersonalNumber('200278-704B');
        $this->assertEquals('f', $obj->getGender());

        $obj = new PersonalNumber('21034535105');
        $this->assertEquals('m', $obj->getGender());

        $obj = new PersonalNumber('07076627678');
        $this->assertEquals('f', $obj->getGender());

        $obj = new PersonalNumber('671017-1239');
        $this->assertEquals('m', $obj->getGender());

        $obj = new PersonalNumber('111228+7568');
        $this->assertEquals('f', $obj->getGender());

        $obj = new PersonalNumber('19671017-1239');
        $this->assertEquals('m', $obj->getGender());

        $obj = new PersonalNumber('19111228+7568');
        $this->assertEquals('f', $obj->getGender());

        $obj = new PersonalNumber('877898-8797');
        $this->expectException(Exception::class);
        $obj->getGender();
    }
}
