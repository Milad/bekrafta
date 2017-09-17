<?php
/*
 * Disclaimer: The personal numbers here have been generated
 * automatically by http://www.fakenamegenerator.com/gen-random-sw-sw.php
 * As far as we know they don't belong to real persons.
 */

namespace Bekrafta\Tests;

use PHPUnit\Framework\TestCase;
use Bekrafta\Sweden;

class SwedenTest extends TestCase {
    public function testValidate() {
        $validator = new Sweden();

        $this->assertTrue($validator->validate('571124-1322'));
        $this->assertTrue($validator->validate('470304-2657'));

        // Various personal numbers
        $this->assertTrue($validator->validate('650428-0196'));
        $this->assertTrue($validator->validate('890729-6746'));
        $this->assertTrue($validator->validate('671017-1239'));
        $this->assertTrue($validator->validate('680731-1003'));

        https://en.wikipedia.org/wiki/Personal_identity_number_(Sweden)#Examples
        $this->assertTrue($validator->validate('670919-9530'));
        $this->assertTrue($validator->validate('811228-9874'));

        $this->assertTrue($validator->validate('111228+7568'));
        $this->assertTrue($validator->validate('160718-7562'));

        $this->assertFalse($validator->validate(''));
    }

    public function testGetCensored() {
        $validator = new Sweden();

        $this->assertEquals('571124-****', $validator->getCensored('571124-1322'));
        $this->assertEquals('470304-****', $validator->getCensored('470304-2657'));

        // Various personal numbers
        $this->assertEquals('650428-****', $validator->getCensored('650428-0196'));
        $this->assertEquals('890729-****', $validator->getCensored('890729-6746'));
        $this->assertEquals('671017-****', $validator->getCensored('671017-1239'));
        $this->assertEquals('680731-****', $validator->getCensored('680731-1003'));

        https://en.wikipedia.org/wiki/Personal_identity_number_(Sweden)#Examples
        $this->assertEquals('670919-****', $validator->getCensored('670919-9530'));
        $this->assertEquals('811228-****', $validator->getCensored('811228-9874'));

        $this->assertEquals('111228+****', $validator->getCensored('111228+7568'));
        $this->assertEquals('160718-****', $validator->getCensored('160718-7562'));
    }

    public function testGetAge() {
        $today = '2017-07-19';

        $validator = new Sweden();

        $this->assertEquals(52, $validator->getAge('650428-0196', $today));
        $this->assertEquals(70, $validator->getAge('470304-2657', $today));
        $this->assertEquals(35, $validator->getAge('811228-9874', $today));
        $this->assertEquals(105, $validator->getAge('111228+7568', $today));
        $this->assertEquals(5, $validator->getAge('111228-7568', $today));
        $this->assertEquals(1, $validator->getAge('160718-7562', $today));
        $this->assertEquals(101, $validator->getAge('160718+7562', $today));
    }

    public function testGetGender() {
        $validator = new Sweden();

        $this->assertEquals('f', $validator->getGender('571124-1322'));
        $this->assertEquals('m', $validator->getGender('470304-2657'));

        // Various personal numbers
        $this->assertEquals('m', $validator->getGender('650428-0196'));
        $this->assertEquals('f', $validator->getGender('890729-6746'));
        $this->assertEquals('m', $validator->getGender('671017-1239'));
        $this->assertEquals('f', $validator->getGender('680731-1003'));

        https://en.wikipedia.org/wiki/Personal_identity_number_(Sweden)#Examples
        $this->assertEquals('m', $validator->getGender('670919-9530'));
        $this->assertEquals('m', $validator->getGender('811228-9874'));

        $this->assertEquals('f', $validator->getGender('111228+7568'));
        $this->assertEquals('f', $validator->getGender('160718-7562'));
    }
}
