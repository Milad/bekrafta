<?php
/**
 * Created by PhpStorm.
 * User: Milad
 * Date: 23-Feb-17
 * Time: 21:13
 */

namespace Bekrafta;

abstract class BekraftaAbstract
{
    abstract public function validate($personalNo);

    /**
     * Calculates the Luhn checksum of a personal number.
     * A modified version of this: https://gist.github.com/troelskn/1287893#gistcomment-1482790
     * @param $personalNo
     * @return int
     */
    protected function luhnChecksum($personalNo)
    {
        $personalNo = preg_replace('/[^\d]/', '', $personalNo);
        $sum = '';

        for ($i = strlen($personalNo) - 1; $i >= 0; -- $i) {
            $sum .= $i & 1 ? $personalNo[$i] : $personalNo[$i] * 2;
        }

        return array_sum(str_split($sum)) % 10;
    }

    public function isLuhnValid($personalNo)
    {
        return self::luhnChecksum($personalNo) == 0;
    }
}

// TODO: Add Tests
// TODO: Add Codestyle
// TODO: Add PHPmess
// TODO: Travis integration
