<?php
/**
 * Created by PhpStorm.
 * User: Milad
 * Date: 26-Feb-17
 * Time: 13:32
 */

require('vendor/autoload.php');

use Bekrafta\Sweden;

$test = new Sweden();

$test->validateFormat('198302282556');
//$test->isLuhnValid('79927398713');
//$test->luhnChecksum('111111111');