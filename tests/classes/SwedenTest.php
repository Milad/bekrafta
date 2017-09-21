<?php
/*
88""Yb 888888 88  dP 88""Yb    db    888888 888888    db
88__dP 88__   88odP  88__dP   dPYb   88__     88     dPYb
88""Yb 88""   88"Yb  88"Yb   dP__Yb  88""     88    dP__Yb
88oodP 888888 88  Yb 88  Yb dP""""Yb 88       88   dP""""Yb
*/

namespace Bekrafta\Tests;

use PHPUnit\Framework\TestCase;
use Bekrafta\Sweden;

class SwedenTest extends TestCase {
    public function testValidate() {
        /*
         * Disclaimer: The personal numbers here have been generated
         * automatically by http://www.fakenamegenerator.com/gen-random-sw-sw.php
         * As far as we know they don't belong to real persons.
         * */
        $this->assertTrue((new Sweden('571124-1322'))->validate());
        $this->assertTrue((new Sweden('470304-2657'))->validate());

        // Various personal numbers
        $this->assertTrue((new Sweden('650428-0196'))->validate());
        $this->assertTrue((new Sweden('890729-6746'))->validate());
        $this->assertTrue((new Sweden('671017-1239'))->validate());
        $this->assertTrue((new Sweden('680731-1003'))->validate());

        https://en.wikipedia.org/wiki/Personal_identity_number_(Sweden)#Examples
        $this->assertTrue((new Sweden('670919-9530'))->validate());
        $this->assertTrue((new Sweden('811228-9874'))->validate());

        $this->assertTrue((new Sweden('111228+7568'))->validate());
        $this->assertTrue((new Sweden('160718-7562'))->validate());

        $this->assertFalse((new Sweden(''))->validate());
    }

    public function testGetCensored() {
        $this->assertEquals('571124-****', (new Sweden('571124-1322'))->getCensored());
        $this->assertEquals('470304-****', (new Sweden('470304-2657'))->getCensored());

        // Various personal numbers
        $this->assertEquals('650428-****', (new Sweden('650428-0196'))->getCensored());
        $this->assertEquals('890729-****', (new Sweden('890729-6746'))->getCensored());
        $this->assertEquals('671017-****', (new Sweden('671017-1239'))->getCensored());
        $this->assertEquals('680731-****', (new Sweden('680731-1003'))->getCensored());

        https://en.wikipedia.org/wiki/Personal_identity_number_(Sweden)#Examples
        $this->assertEquals('670919-****', (new Sweden('670919-9530'))->getCensored());
        $this->assertEquals('811228-****', (new Sweden('811228-9874'))->getCensored());

        $this->assertEquals('111228+****', (new Sweden('111228+7568'))->getCensored());
        $this->assertEquals('160718-****', (new Sweden('160718-7562'))->getCensored());
    }

    public function testGetAge() {
        $today = '2017-07-19';

        $this->assertEquals(52, (new Sweden('650428-0196'))->getAge($today));
        $this->assertEquals(70, (new Sweden('470304-2657'))->getAge($today));
        $this->assertEquals(35, (new Sweden('811228-9874'))->getAge($today));
        $this->assertEquals(105, (new Sweden('111228+7568'))->getAge($today));
        $this->assertEquals(5, (new Sweden('111228-7568'))->getAge($today));
        $this->assertEquals(1, (new Sweden('160718-7562'))->getAge($today));
        $this->assertEquals(101, (new Sweden('160718+7562'))->getAge($today));
    }

    public function testGetGender() {
        $this->assertEquals('f', (new Sweden('571124-1322'))->getGender());
        $this->assertEquals('m', (new Sweden('470304-2657'))->getGender());

        // Various personal numbers
        $this->assertEquals('m', (new Sweden('650428-0196'))->getGender());
        $this->assertEquals('f', (new Sweden('890729-6746'))->getGender());
        $this->assertEquals('m', (new Sweden('671017-1239'))->getGender());
        $this->assertEquals('f', (new Sweden('680731-1003'))->getGender());

        https://en.wikipedia.org/wiki/Personal_identity_number_(Sweden)#Examples
        $this->assertEquals('m', (new Sweden('670919-9530'))->getGender());
        $this->assertEquals('m', (new Sweden('811228-9874'))->getGender());

        $this->assertEquals('f', (new Sweden('111228+7568'))->getGender());
        $this->assertEquals('f', (new Sweden('160718-7562'))->getGender());
    }
}
