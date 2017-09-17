<?php

namespace Bekrafta\Tests;

use PHPUnit\Framework\TestCase;
use Bekrafta\Finland;

class FinlandTest extends TestCase {
    public function testValidate() {
        $validator = new Finland();

        // https://en.wikipedia.org/wiki/National_identification_number#Finland
        $this->assertTrue($validator->validate('311280-888Y'));
        $this->assertFalse($validator->validate('311280-888U'));

        $this->assertTrue($validator->validate('270846-627Y'));
        $this->assertTrue($validator->validate('281194-0582'));
        $this->assertTrue($validator->validate('130781-4116'));
        $this->assertTrue($validator->validate('280731-743N'));
        $this->assertTrue($validator->validate('240696-797T'));
        $this->assertTrue($validator->validate('280162-343X'));
        $this->assertTrue($validator->validate('200278-704B'));

        $this->assertTrue($validator->validate('200278+704B'));
        $this->assertTrue($validator->validate('010808A704V'));
    }

    public function testGetCensored() {
        $validator = new Finland();

        // https://en.wikipedia.org/wiki/National_identification_number#Finland
        $this->assertEquals('311280-****', $validator->getCensored('311280-888Y'));

        $this->assertEquals('270846-****', $validator->getCensored('270846-627Y'));
        $this->assertEquals('281194-****', $validator->getCensored('281194-0582'));
        $this->assertEquals('130781-****', $validator->getCensored('130781-4116'));
        $this->assertEquals('280731-****', $validator->getCensored('280731-743N'));
        $this->assertEquals('240696-****', $validator->getCensored('240696-797T'));
        $this->assertEquals('280162-****', $validator->getCensored('280162-343X'));
        $this->assertEquals('200278-****', $validator->getCensored('200278-704B'));

        $this->assertEquals('200278+****', $validator->getCensored('200278+704B'));
        $this->assertEquals('010808A****', $validator->getCensored('010808A704V'));
    }

    public function testGetAge() {
        $today = '2017-07-19';

        $validator = new Finland();

        $this->assertEquals(85, $validator->getAge('280731-743N', $today));
        $this->assertEquals(22, $validator->getAge('281194-0582', $today));
        $this->assertEquals(36, $validator->getAge('130781-4116', $today));
        $this->assertEquals(139, $validator->getAge('200278+704B', $today));
        $this->assertEquals(121, $validator->getAge('240696+797T', $today));
        $this->assertEquals(8, $validator->getAge('010808A704V', $today));
    }

    public function testGetGender() {
        $validator = new Finland();

        // https://en.wikipedia.org/wiki/National_identification_number#Finland
        $this->assertEquals('f', $validator->getGender('311280-888Y'));

        $this->assertEquals('m', $validator->getGender('270846-627Y'));
        $this->assertEquals('f', $validator->getGender('281194-0582'));
        $this->assertEquals('m', $validator->getGender('130781-4116'));
        $this->assertEquals('m', $validator->getGender('280731-743N'));
        $this->assertEquals('m', $validator->getGender('240696-797T'));
        $this->assertEquals('m', $validator->getGender('280162-343X'));
        $this->assertEquals('f', $validator->getGender('200278-704B'));

        $this->assertEquals('f', $validator->getGender('200278+704B'));
        $this->assertEquals('f', $validator->getGender('010808A704V'));
    }
}
