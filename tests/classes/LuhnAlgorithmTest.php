<?php
/**
 * Created by PhpStorm.
 * User: Milad
 * Date: 26-Feb-17
 * Time: 19:27
 */

namespace Bekrafta\Tests;

use PHPUnit\Framework\TestCase;
use Bekrafta\LuhnAlgorithm;

class LuhnAlgorithmTest extends TestCase
{
    public function testluhnChecksum()
    {
        $luhnAlgorithm = new LuhnAlgorithm();

        // https://en.wikipedia.org/wiki/Luhn_algorithm#Description
        $this->assertEquals(0, $luhnAlgorithm->luhnChecksum("79927398713"));

        // https://www.paypalobjects.com/en_US/vhelp/paypalmanager_help/credit_card_numbers.htm
        $this->assertEquals(0, $luhnAlgorithm->luhnChecksum("378282246310005"));
        $this->assertEquals(0, $luhnAlgorithm->luhnChecksum("371449635398431"));
        $this->assertEquals(0, $luhnAlgorithm->luhnChecksum("378734493671000"));
        $this->assertEquals(0, $luhnAlgorithm->luhnChecksum("5610591081018250"));
        $this->assertEquals(0, $luhnAlgorithm->luhnChecksum("30569309025904"));
        $this->assertEquals(0, $luhnAlgorithm->luhnChecksum("38520000023237"));
        $this->assertEquals(0, $luhnAlgorithm->luhnChecksum("6011111111111117"));
        $this->assertEquals(0, $luhnAlgorithm->luhnChecksum("6011000990139424"));
        $this->assertEquals(0, $luhnAlgorithm->luhnChecksum("3530111333300000"));
        $this->assertEquals(0, $luhnAlgorithm->luhnChecksum("3566002020360505"));
        $this->assertEquals(0, $luhnAlgorithm->luhnChecksum("5555555555554444"));
        $this->assertEquals(0, $luhnAlgorithm->luhnChecksum("5105105105105100"));
        $this->assertEquals(0, $luhnAlgorithm->luhnChecksum("4111111111111111"));
        $this->assertEquals(0, $luhnAlgorithm->luhnChecksum("4012888888881881"));
        $this->assertEquals(0, $luhnAlgorithm->luhnChecksum("4222222222222"));
        $this->assertEquals(0, $luhnAlgorithm->luhnChecksum("5019717010103742"));
        $this->assertEquals(0, $luhnAlgorithm->luhnChecksum("6331101999990016"));

        $this->assertEquals(0, $luhnAlgorithm->luhnChecksum("49927398716"));
        $this->assertEquals(3, $luhnAlgorithm->luhnChecksum("470304265"));
        $this->assertEquals(1, $luhnAlgorithm->luhnChecksum("1234567"));
    }

    public function testIsLuhnValid()
    {
        $luhnAlgorithm = new LuhnAlgorithm();

        // https://en.wikipedia.org/wiki/Luhn_algorithm#Description
        $this->assertFalse($luhnAlgorithm->isLuhnValid('79927398710'));
        $this->assertFalse($luhnAlgorithm->isLuhnValid('79927398711'));
        $this->assertFalse($luhnAlgorithm->isLuhnValid('79927398712'));
        $this->assertTrue($luhnAlgorithm->isLuhnValid('79927398713'));
        $this->assertFalse($luhnAlgorithm->isLuhnValid('79927398714'));
        $this->assertFalse($luhnAlgorithm->isLuhnValid('79927398715'));
        $this->assertFalse($luhnAlgorithm->isLuhnValid('79927398716'));
        $this->assertFalse($luhnAlgorithm->isLuhnValid('79927398717'));
        $this->assertFalse($luhnAlgorithm->isLuhnValid('79927398718'));
        $this->assertFalse($luhnAlgorithm->isLuhnValid('79927398719'));

        // https://www.paypalobjects.com/en_US/vhelp/paypalmanager_help/credit_card_numbers.htm
        $this->assertTrue($luhnAlgorithm->isLuhnValid("378282246310005"));
        $this->assertTrue($luhnAlgorithm->isLuhnValid("371449635398431"));
        $this->assertTrue($luhnAlgorithm->isLuhnValid("378734493671000"));
        $this->assertTrue($luhnAlgorithm->isLuhnValid("5610591081018250"));
        $this->assertTrue($luhnAlgorithm->isLuhnValid("30569309025904"));
        $this->assertTrue($luhnAlgorithm->isLuhnValid("38520000023237"));
        $this->assertTrue($luhnAlgorithm->isLuhnValid("6011111111111117"));
        $this->assertTrue($luhnAlgorithm->isLuhnValid("6011000990139424"));
        $this->assertTrue($luhnAlgorithm->isLuhnValid("3530111333300000"));
        $this->assertTrue($luhnAlgorithm->isLuhnValid("3566002020360505"));
        $this->assertTrue($luhnAlgorithm->isLuhnValid("5555555555554444"));
        $this->assertTrue($luhnAlgorithm->isLuhnValid("5105105105105100"));
        $this->assertTrue($luhnAlgorithm->isLuhnValid("4111111111111111"));
        $this->assertTrue($luhnAlgorithm->isLuhnValid("4012888888881881"));
        $this->assertTrue($luhnAlgorithm->isLuhnValid("4222222222222"));
        $this->assertTrue($luhnAlgorithm->isLuhnValid("5019717010103742"));
        $this->assertTrue($luhnAlgorithm->isLuhnValid("6331101999990016"));
    }

    public function testCalculateLuhn()
    {
        $luhnAlgorithm = new LuhnAlgorithm();

        $this->assertEquals(0, $luhnAlgorithm->calculateLuhn("0"));
        $this->assertEquals(8, $luhnAlgorithm->calculateLuhn("1"));
        $this->assertEquals(6, $luhnAlgorithm->calculateLuhn("2"));
        $this->assertEquals(4, $luhnAlgorithm->calculateLuhn("3"));
        $this->assertEquals(2, $luhnAlgorithm->calculateLuhn("4"));
        $this->assertEquals(9, $luhnAlgorithm->calculateLuhn("5"));
        $this->assertEquals(7, $luhnAlgorithm->calculateLuhn("6"));
        $this->assertEquals(5, $luhnAlgorithm->calculateLuhn("7"));
        $this->assertEquals(3, $luhnAlgorithm->calculateLuhn("8"));
        $this->assertEquals(1, $luhnAlgorithm->calculateLuhn("9"));

        // https://en.wikipedia.org/wiki/Luhn_algorithm#Description
        $this->assertEquals(3, $luhnAlgorithm->calculateLuhn('7992739871'));

        // https://www.paypalobjects.com/en_US/vhelp/paypalmanager_help/credit_card_numbers.htm
        $this->assertEquals(5, $luhnAlgorithm->calculateLuhn("37828224631000"));
        $this->assertEquals(1, $luhnAlgorithm->calculateLuhn("37144963539843"));
        $this->assertEquals(0, $luhnAlgorithm->calculateLuhn("37873449367100"));
        $this->assertEquals(0, $luhnAlgorithm->calculateLuhn("561059108101825"));
        $this->assertEquals(4, $luhnAlgorithm->calculateLuhn("3056930902590"));
        $this->assertEquals(7, $luhnAlgorithm->calculateLuhn("3852000002323"));
        $this->assertEquals(7, $luhnAlgorithm->calculateLuhn("601111111111111"));
        $this->assertEquals(4, $luhnAlgorithm->calculateLuhn("601100099013942"));
        $this->assertEquals(0, $luhnAlgorithm->calculateLuhn("353011133330000"));
        $this->assertEquals(5, $luhnAlgorithm->calculateLuhn("356600202036050"));
        $this->assertEquals(4, $luhnAlgorithm->calculateLuhn("555555555555444"));
        $this->assertEquals(0, $luhnAlgorithm->calculateLuhn("510510510510510"));
        $this->assertEquals(1, $luhnAlgorithm->calculateLuhn("411111111111111"));
        $this->assertEquals(1, $luhnAlgorithm->calculateLuhn("401288888888188"));
        $this->assertEquals(2, $luhnAlgorithm->calculateLuhn("422222222222"));
        $this->assertEquals(2, $luhnAlgorithm->calculateLuhn("501971701010374"));
        $this->assertEquals(6, $luhnAlgorithm->calculateLuhn("633110199999001"));
    }
}
