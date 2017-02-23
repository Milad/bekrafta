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
        $this->assertTrue($validator->validate('19830228-2556'));
    }
}