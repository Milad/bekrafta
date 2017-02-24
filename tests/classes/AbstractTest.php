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
    public function testValidateFormat()
    {
        $validator = new Swedish();

        $this->assertTrue($validator->validate('680731-1003'));
        $this->assertTrue($validator->validate('19680731-1003'));
        $this->assertTrue($validator->validate('196807311003'));
        $this->assertTrue($validator->validate('6807311003'));
        $this->assertFalse($validator->validate('680731_1003'));
        $this->assertTrue($validator->validate('18680731+1003'));
    }

    public function testLuhnChecksum()
    {
        $validator = new Swedish();

        $this->assertEquals(0, $validator->luhnChecksum("0"));
        $this->assertEquals(2, $validator->luhnChecksum("1"));
        $this->assertEquals(4, $validator->luhnChecksum("2"));
        $this->assertEquals(6, $validator->luhnChecksum("3"));
        $this->assertEquals(8, $validator->luhnChecksum("4"));
        $this->assertEquals(1, $validator->luhnChecksum("5"));
        $this->assertEquals(3, $validator->luhnChecksum("6"));
        $this->assertEquals(5, $validator->luhnChecksum("7"));
        $this->assertEquals(7, $validator->luhnChecksum("8"));
        $this->assertEquals(9, $validator->luhnChecksum("9"));

        $this->assertEquals(2, $validator->luhnChecksum("49927398716"));
        $this->assertEquals(3, $validator->luhnChecksum("470304265"));
        $this->assertEquals(6, $validator->luhnChecksum("1234567"));
    }

    public function testIsLuhnValid()
    {
        $validator = new Swedish();
        $this->assertFalse($validator->isLuhnValid("79927398711"));
        $this->assertTrue($validator->isLuhnValid("79927398712"));
    }
}
