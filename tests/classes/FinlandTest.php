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
    }
}
