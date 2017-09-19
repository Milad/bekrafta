<?php

namespace Bekrafta\Tests;

use Bekrafta\Denmark;
use PHPUnit\Framework\TestCase;

class DenmarkTest extends TestCase {
    public function testValidate() {
        $validator = new Denmark();
        $this->assertTrue($validator->validate('130600-5738'));
        $this->assertTrue($validator->validate('070777-1119'));
        $this->assertTrue($validator->validate('260783-1234'));
        $this->assertTrue($validator->validate('120494-3806'));
        $this->assertTrue($validator->validate('220890-4895'));
        $this->assertTrue($validator->validate('310586-4948'));
        $this->assertTrue($validator->validate('171263-1615'));
        $this->assertTrue($validator->validate('150517-3712'));
        $this->assertTrue($validator->validate('120917-3804'));
    }

    public function testGetAge() {
        $today = '2017-07-19';

        $validator = new Denmark();

        $this->assertEquals(17, $validator->getAge('130600-5738', $today));
        $this->assertEquals(40, $validator->getAge('070777-1119', $today));
        $this->assertEquals(33, $validator->getAge('260783-1234', $today));
        $this->assertEquals(23, $validator->getAge('120494-3806', $today));
        $this->assertEquals(26, $validator->getAge('220890-4895', $today));
        $this->assertEquals(31, $validator->getAge('310586-4948', $today));
        $this->assertEquals(53, $validator->getAge('171263-1615', $today));
        $this->assertEquals(100, $validator->getAge('150517-3712', $today));
        $this->assertEquals(99, $validator->getAge('120917-3804', $today));
        $this->assertEquals(154, $validator->getAge('211062-5629', $today));
    }

    public function testGetCensored() {
        $validator = new Denmark();
        $this->assertEquals('130600-****', $validator->getCensored('130600-5738'));
        $this->assertEquals('070777-****', $validator->getCensored('070777-1119'));
    }

    public function testGetGender() {
        $validator = new Denmark();
        $this->assertEquals('f', $validator->getGender('130600-5738'));
        $this->assertEquals('m', $validator->getGender('070777-1119'));
        $this->assertEquals('f', $validator->getGender('260783-1234'));
        $this->assertEquals('f', $validator->getGender('120494-3806'));
        $this->assertEquals('m', $validator->getGender('220890-4895'));
        $this->assertEquals('f', $validator->getGender('310586-4948'));
        $this->assertEquals('m', $validator->getGender('171263-1615'));
        $this->assertEquals('f', $validator->getGender('150517-3712'));
        $this->assertEquals('f', $validator->getGender('120917-3804'));
    }
}
