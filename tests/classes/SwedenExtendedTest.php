<?php

namespace Bekrafta\Tests;

use PHPUnit\Framework\TestCase;
use Bekrafta\SwedenExtended;

class SwedenExtendedTest extends TestCase {
    public function testValidate() {
        /*
         * Disclaimer: The personal numbers here have been generated
         * automatically by http://www.fakenamegenerator.com/gen-random-sw-sw.php
         * As far as we know they don't belong to real persons.
         * */
        $validator = new SwedenExtended();

        // Variations of 571124-1322
        $this->assertTrue($validator->validate('19571124-1322'));
        $this->assertTrue($validator->validate('195711241322'));

        // Variations of 470304-2657
        $this->assertTrue($validator->validate('19470304-2657'));
        $this->assertTrue($validator->validate('194703042657'));

        // Various personal numbers
        $this->assertTrue($validator->validate('19650428-0196'));
        $this->assertTrue($validator->validate('19890729-6746'));
        $this->assertTrue($validator->validate('19671017-1239'));
        $this->assertTrue($validator->validate('19680731-1003'));

        https://en.wikipedia.org/wiki/Personal_identity_number_(Sweden)#Examples
        $this->assertTrue($validator->validate('19670919-9530'));
        $this->assertTrue($validator->validate('19811228-9874'));

        $this->assertFalse($validator->validate('194703042656'));
        $this->assertFalse($validator->validate(''));
    }

    public function testGetAge() {
        $today = '2017-07-19';

        $validator = new SwedenExtended();

        $this->assertEquals(52, $validator->getAge('19650428-0196', $today));
        $this->assertEquals(70, $validator->getAge('19470304-2657', $today));
        $this->assertEquals(35, $validator->getAge('19811228-9874', $today));
        $this->assertEquals(105, $validator->getAge('19111228+7568', $today));
        $this->assertEquals(5, $validator->getAge('20111228-7568', $today));
        $this->assertEquals(1, $validator->getAge('20160718-7562', $today));
        $this->assertEquals(101, $validator->getAge('19160718+7562', $today));
    }

    public function testRemoveLeadingCenturies() {
        $validator = new SwedenExtended();

        $this->assertEquals('571124-1322', $validator->removeLeadingCenturies('571124-1322'));
        $this->assertEquals('571124-1322', $validator->removeLeadingCenturies('19571124-1322'));
        $this->assertEquals('571124-1322', $validator->removeLeadingCenturies('18571124-1322'));
        $this->assertEquals('5711241322', $validator->removeLeadingCenturies('5711241322'));
        $this->assertEquals('5711241322', $validator->removeLeadingCenturies('195711241322'));
        $this->assertEquals('5711241322', $validator->removeLeadingCenturies('185711241322'));
    }

    public function testGetGender() {
        $validator = new SwedenExtended();

        $this->assertEquals('f', $validator->getGender('19571124-1322'));
        $this->assertEquals('m', $validator->getGender('19470304-2657'));

        // Various personal numbers
        $this->assertEquals('m', $validator->getGender('19650428-0196'));
        $this->assertEquals('f', $validator->getGender('19890729-6746'));
        $this->assertEquals('m', $validator->getGender('19671017-1239'));
        $this->assertEquals('f', $validator->getGender('19680731-1003'));

        https://en.wikipedia.org/wiki/Personal_identity_number_(Sweden)#Examples
        $this->assertEquals('m', $validator->getGender('19670919-9530'));
        $this->assertEquals('m', $validator->getGender('19811228-9874'));

        $this->assertEquals('f', $validator->getGender('19111228+7568'));
        $this->assertEquals('f', $validator->getGender('20160718-7562'));
    }

    public function testGetCensored() {
        $validator = new SwedenExtended();

        $this->assertEquals('19571124-****', $validator->getCensored('19571124-1322'));
        $this->assertEquals('19470304-****', $validator->getCensored('19470304-2657'));

        // Various personal numbers
        $this->assertEquals('19650428-****', $validator->getCensored('19650428-0196'));
        $this->assertEquals('19890729-****', $validator->getCensored('19890729-6746'));
        $this->assertEquals('19671017-****', $validator->getCensored('19671017-1239'));
        $this->assertEquals('19680731-****', $validator->getCensored('19680731-1003'));

        https://en.wikipedia.org/wiki/Personal_identity_number_(Sweden)#Examples
        $this->assertEquals('19670919-****', $validator->getCensored('19670919-9530'));
        $this->assertEquals('19811228-****', $validator->getCensored('19811228-9874'));

        $this->assertEquals('19111228+****', $validator->getCensored('19111228+7568'));
        $this->assertEquals('20160718-****', $validator->getCensored('20160718-7562'));
    }
}
