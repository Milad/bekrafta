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
    abstract public function validate($personal_no);

    /**
     * Calculates the Luhn checksum of a personal number.
     * A modified version of this: https://gist.github.com/troelskn/1287893#gistcomment-1482790
     * @param $personal_no
     * @return int
     */
    protected function luhnChecksum($personal_no)
    {
        $personal_no = preg_replace('/[^\d]/', '', $personal_no);
        $sum = '';

        for ($i = strlen($personal_no) - 1; $i >= 0; -- $i) {
            $sum .= $i & 1 ? $personal_no[$i] : $personal_no[$i] * 2;
        }

        return array_sum(str_split($sum)) % 10;
    }

    public function isLuhnValid($personal_no)
    {
        return self::luhnChecksum($personal_no) == 0;
    }
}

// TODO: Add Tests
// TODO: Add Codestyle
// TODO: Add PHPmess
// TODO: Travis integration
