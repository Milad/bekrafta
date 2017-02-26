<?php
/**
 * Created by PhpStorm.
 * User: Milad
 * Date: 23-Feb-17
 * Time: 22:27
 */

namespace Bekrafta\Tests;

use PHPUnit\Framework\TestCase;
use Bekrafta\Sweden;

class AbstractTest extends TestCase
{
    public function testValidateFormat()
    {
        $validator = new Sweden();

        $this->assertTrue($validator->validateFormat('680731-1003'));
        $this->assertTrue($validator->validateFormat('19680731-1003'));
        $this->assertTrue($validator->validateFormat('196807311003'));
        $this->assertTrue($validator->validateFormat('6807311003'));
        $this->assertFalse($validator->validateFormat('680731_1003'));
        $this->assertFalse($validator->validateFormat('680731/1003'));
        $this->assertTrue($validator->validateFormat('18680731+1003'));
    }
}
