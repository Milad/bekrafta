<?php
/**
 * Created by PhpStorm.
 * User: Milad
 * Date: 23-Feb-17
 * Time: 22:10
 */

namespace Bekrafta\Tests;

use PHPUnit\Framework\TestCase;
use Bekrafta\Swedish;

class SwedishTest extends TestCase
{
    public function testValidate()
    {
        $validator = new Swedish();
        /*
         * Disclaimer: The personal numbers here have been generated
         * automatically by http://www.fakenamegenerator.com/gen-random-sw-sw.php
         * */
        // Variations of 571124-1322
        $this->assertTrue($validator->validate('571124-1322'));
        $this->assertTrue($validator->validate('19571124-1322'));
        $this->assertTrue($validator->validate('195711241322'));

        $this->assertTrue($validator->validate('890729-6746'));
        $this->assertTrue($validator->validate('671017-1239'));
        $this->assertTrue($validator->validate('680731-1003'));

        // Variations of 470304-2657
        $this->assertTrue($validator->validate('470304-2657'));
        $this->assertTrue($validator->validate('19470304-2657'));
        $this->assertTrue($validator->validate('194703042657'));
        $this->assertTrue($validator->validate('4703042657'));

        $this->assertFalse($validator->validate('4703042656'));
        $this->assertFalse($validator->validate(''));
    }
}
