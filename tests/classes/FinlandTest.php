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
}
