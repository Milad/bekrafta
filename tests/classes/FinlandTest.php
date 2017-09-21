<?php
/*
88""Yb 888888 88  dP 88""Yb    db    888888 888888    db
88__dP 88__   88odP  88__dP   dPYb   88__     88     dPYb
88""Yb 88""   88"Yb  88"Yb   dP__Yb  88""     88    dP__Yb
88oodP 888888 88  Yb 88  Yb dP""""Yb 88       88   dP""""Yb
*/

namespace Bekrafta\Tests;

use PHPUnit\Framework\TestCase;
use Bekrafta\Finland;

class FinlandTest extends TestCase {
    public function testValidate() {
        // https://en.wikipedia.org/wiki/National_identification_number#Finland
        $this->assertTrue((new Finland('311280-888Y'))->validate());
        $this->assertFalse((new Finland('311280-888U'))->validate());

        $this->assertTrue((new Finland('270846-627Y'))->validate());
        $this->assertTrue((new Finland('281194-0582'))->validate());
        $this->assertTrue((new Finland('130781-4116'))->validate());
        $this->assertTrue((new Finland('280731-743N'))->validate());
        $this->assertTrue((new Finland('240696-797T'))->validate());
        $this->assertTrue((new Finland('280162-343X'))->validate());
        $this->assertTrue((new Finland('200278-704B'))->validate());

        $this->assertTrue((new Finland('200278+704B'))->validate());
        $this->assertTrue((new Finland('010808A704V'))->validate());
    }

    public function testGetCensored() {
        // https://en.wikipedia.org/wiki/National_identification_number#Finland
        $this->assertEquals('311280-****', (new Finland('311280-888Y'))->getCensored());

        $this->assertEquals('270846-****', (new Finland('270846-627Y'))->getCensored());
        $this->assertEquals('281194-****', (new Finland('281194-0582'))->getCensored());
        $this->assertEquals('130781-****', (new Finland('130781-4116'))->getCensored());
        $this->assertEquals('280731-****', (new Finland('280731-743N'))->getCensored());
        $this->assertEquals('240696-****', (new Finland('240696-797T'))->getCensored());
        $this->assertEquals('280162-****', (new Finland('280162-343X'))->getCensored());
        $this->assertEquals('200278-****', (new Finland('200278-704B'))->getCensored());

        $this->assertEquals('200278+****', (new Finland('200278+704B'))->getCensored());
        $this->assertEquals('010808A****', (new Finland('010808A704V'))->getCensored());
    }

    public function testGetAge() {
        $today = '2017-07-19';

        $this->assertEquals(85, (new Finland('280731-743N'))->getAge($today));
        $this->assertEquals(22, (new Finland('281194-0582'))->getAge($today));
        $this->assertEquals(36, (new Finland('130781-4116'))->getAge($today));
        $this->assertEquals(139, (new Finland('200278+704B'))->getAge($today));
        $this->assertEquals(121, (new Finland('240696+797T'))->getAge($today));
        $this->assertEquals(8, (new Finland('010808A704V'))->getAge($today));
    }

    public function testGetGender() {
        // https://en.wikipedia.org/wiki/National_identification_number#Finland
        $this->assertEquals('f', (new Finland('311280-888Y'))->getGender());

        $this->assertEquals('m', (new Finland('270846-627Y'))->getGender());
        $this->assertEquals('f', (new Finland('281194-0582'))->getGender());
        $this->assertEquals('m', (new Finland('130781-4116'))->getGender());
        $this->assertEquals('m', (new Finland('280731-743N'))->getGender());
        $this->assertEquals('m', (new Finland('240696-797T'))->getGender());
        $this->assertEquals('m', (new Finland('280162-343X'))->getGender());
        $this->assertEquals('f', (new Finland('200278-704B'))->getGender());

        $this->assertEquals('f', (new Finland('200278+704B'))->getGender());
        $this->assertEquals('f', (new Finland('010808A704V'))->getGender());
    }
}
