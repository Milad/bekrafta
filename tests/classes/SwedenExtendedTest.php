<?php
/*
88""Yb 888888 88  dP 88""Yb    db    888888 888888    db
88__dP 88__   88odP  88__dP   dPYb   88__     88     dPYb
88""Yb 88""   88"Yb  88"Yb   dP__Yb  88""     88    dP__Yb
88oodP 888888 88  Yb 88  Yb dP""""Yb 88       88   dP""""Yb
*/

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

        // Variations of 571124-1322
        $this->assertTrue((new SwedenExtended('19571124-1322'))->validate());
        $this->assertTrue((new SwedenExtended('195711241322'))->validate());

        // Variations of 470304-2657
        $this->assertTrue((new SwedenExtended('19470304-2657'))->validate());
        $this->assertTrue((new SwedenExtended('194703042657'))->validate());

        // Various personal numbers
        $this->assertTrue((new SwedenExtended('19650428-0196'))->validate());
        $this->assertTrue((new SwedenExtended('19890729-6746'))->validate());
        $this->assertTrue((new SwedenExtended('19671017-1239'))->validate());
        $this->assertTrue((new SwedenExtended('19680731-1003'))->validate());

        https://en.wikipedia.org/wiki/Personal_identity_number_(Sweden)#Examples
        $this->assertTrue((new SwedenExtended('19670919-9530'))->validate());
        $this->assertTrue((new SwedenExtended('19811228-9874'))->validate());

        $this->assertFalse((new SwedenExtended('194703042656'))->validate());
        $this->assertFalse((new SwedenExtended(''))->validate());
    }

    public function testGetAge() {
        $today = '2017-07-19';

        $this->assertEquals(52, (new SwedenExtended('19650428-0196'))->getAge($today));
        $this->assertEquals(70, (new SwedenExtended('19470304-2657'))->getAge($today));
        $this->assertEquals(35, (new SwedenExtended('19811228-9874'))->getAge($today));
        $this->assertEquals(105, (new SwedenExtended('19111228+7568'))->getAge($today));
        $this->assertEquals(5, (new SwedenExtended('20111228-7568'))->getAge($today));
        $this->assertEquals(1, (new SwedenExtended('20160718-7562'))->getAge($today));
        $this->assertEquals(101, (new SwedenExtended('19160718+7562'))->getAge($today));
    }

    public function testRemoveLeadingCenturies() {
        $this->assertEquals('571124-1322', (new SwedenExtended('571124-1322'))->removeLeadingCenturies());
        $this->assertEquals('571124-1322', (new SwedenExtended('19571124-1322'))->removeLeadingCenturies());
        $this->assertEquals('571124-1322', (new SwedenExtended('18571124-1322'))->removeLeadingCenturies());
        $this->assertEquals('5711241322', (new SwedenExtended('5711241322'))->removeLeadingCenturies());
        $this->assertEquals('5711241322', (new SwedenExtended('195711241322'))->removeLeadingCenturies());
        $this->assertEquals('5711241322', (new SwedenExtended('185711241322'))->removeLeadingCenturies());
    }

    public function testGetGender() {
        $this->assertEquals('f', (new SwedenExtended('19571124-1322'))->getGender());
        $this->assertEquals('m', (new SwedenExtended('19470304-2657'))->getGender());

        // Various personal numbers
        $this->assertEquals('m', (new SwedenExtended('19650428-0196'))->getGender());
        $this->assertEquals('f', (new SwedenExtended('19890729-6746'))->getGender());
        $this->assertEquals('m', (new SwedenExtended('19671017-1239'))->getGender());
        $this->assertEquals('f', (new SwedenExtended('19680731-1003'))->getGender());

        https://en.wikipedia.org/wiki/Personal_identity_number_(Sweden)#Examples
        $this->assertEquals('m', (new SwedenExtended('19670919-9530'))->getGender());
        $this->assertEquals('m', (new SwedenExtended('19811228-9874'))->getGender());

        $this->assertEquals('f', (new SwedenExtended('19111228+7568'))->getGender());
        $this->assertEquals('f', (new SwedenExtended('20160718-7562'))->getGender());
    }

    public function testGetCensored() {
        $this->assertEquals('19571124-****', (new SwedenExtended('19571124-1322'))->getCensored());
        $this->assertEquals('19470304-****', (new SwedenExtended('19470304-2657'))->getCensored());

        // Various personal numbers
        $this->assertEquals('19650428-****', (new SwedenExtended('19650428-0196'))->getCensored());
        $this->assertEquals('19890729-****', (new SwedenExtended('19890729-6746'))->getCensored());
        $this->assertEquals('19671017-****', (new SwedenExtended('19671017-1239'))->getCensored());
        $this->assertEquals('19680731-****', (new SwedenExtended('19680731-1003'))->getCensored());

        https://en.wikipedia.org/wiki/Personal_identity_number_(Sweden)#Examples
        $this->assertEquals('19670919-****', (new SwedenExtended('19670919-9530'))->getCensored());
        $this->assertEquals('19811228-****', (new SwedenExtended('19811228-9874'))->getCensored());

        $this->assertEquals('19111228+****', (new SwedenExtended('19111228+7568'))->getCensored());
        $this->assertEquals('20160718-****', (new SwedenExtended('20160718-7562'))->getCensored());
    }
}
