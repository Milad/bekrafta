<?php
/**
 * Created by PhpStorm.
 * User: Milad
 * Date: 23-Feb-17
 * Time: 22:27
 */

namespace Bekrafta\Tests;

use PHPUnit\Framework\TestCase;
use Bekrafta\Swedish;

class AbstractTest extends TestCase
{
    public function testLuhnChecksum()
    {
        $validator = new Swedish();
        $this->assertTrue($validator->isLuhnValid("4111111111111111"));
        $this->assertFalse($validator->isLuhnValid("4111111111111110"));
        $this->assertTrue($validator->isLuhnValid("1234567812345670"));
        $this->assertFalse($validator->isLuhnValid("1234567812345678"));
        $this->assertFalse($validator->isLuhnValid("49927398716"));
        $this->assertFalse($validator->isLuhnValid("49927398717"));
    }
}
