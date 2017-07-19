<?php

namespace Bekrafta\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use Bekrafta\Sweden;

class AbstractTest extends TestCase {
    public function testValidateFormat() {
        $validator = new Sweden();

        $this->assertTrue($validator->validateFormat('680731-1003'));
        $this->assertTrue($validator->validateFormat('680731-1003'));
        $this->assertFalse($validator->validateFormat('680731_1003'));
        $this->assertFalse($validator->validateFormat('680731/1003'));

        $this->expectException(Exception::class);
        $validator->getAge('680731/1003');
    }
}
