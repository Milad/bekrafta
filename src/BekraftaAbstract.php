<?php
/**
 * Created by PhpStorm.
 * User: Milad
 * Date: 23-Feb-17
 * Time: 21:13
 */

namespace Bekrafta;

use \Exception;

abstract class BekraftaAbstract
{
    public function validateFormat($personalNo)
    {
        preg_match($this->pattern, $personalNo, $matches);

        if (!$matches) {
            return false;
        }

        return true;
    }

    abstract public function validate($personalNo);

    /**
     * Calculates the Luhn checksum of a personal number.
     * Implementation of Luhn algorithm https://en.wikipedia.org/wiki/Luhn_algorithm
     * Source (modified): https://gist.github.com/troelskn/1287893#gistcomment-1482790
     * @param $personalNo
     * @return int
     * @throws Exception
     */
    public function luhnChecksum($personalNo)
    {
        $personalNo = trim($personalNo);

        $personalNo = preg_replace('/[^\d]/', '', $personalNo);

        if (empty($personalNo)) {
//            throw new Exception("A string that doesn't have any number is invalid.");
        }

        $sum = '';

        for ($i = strlen($personalNo) - 1; $i >= 0; --$i) {
            $sum .= $i & 1 ? $personalNo[$i] : $personalNo[$i] * 2;
        }

        return array_sum(str_split($sum)) % 10;
    }

    /**
     * Checks if a personal no. is valid according to the Luhn algorithm
     * @param $personalNo
     * @return bool
     */
    public function isLuhnValid($personalNo)
    {
        $personalNo = trim($personalNo);

        if (empty($personalNo)) {
            return false;
        }

        return self::luhnChecksum($personalNo) == 0;
    }

    public function removeLeadingCentries($personalNo)
    {
        return preg_replace('#^(18|19|20)#', '', $personalNo);
    }
}
