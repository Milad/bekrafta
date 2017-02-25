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
    /**
     * Uses all the required test to validate a personal no.
     * @param $personalNo string
     * @return bool
     */
    abstract public function validate(string $personalNo);

    /**
     * Validates the format of a personal no.
     * Does not checksum the no.
     * @param $personalNo string
     * @return bool
     */
    public function validateFormat(string $personalNo)
    {
        preg_match($this->pattern, $personalNo, $matches);

        if (!$matches) {
            return false;
        }

        return true;
    }

    /**
     * Calculates the Luhn checksum of a personal no.
     * Implementation of Luhn algorithm https://en.wikipedia.org/wiki/Luhn_algorithm
     * Source (modified): https://gist.github.com/troelskn/1287893#gistcomment-1482790
     * @param $personalNo string
     * @return int
     * @throws Exception
     */
    public function luhnChecksum(string $personalNo)
    {
        $personalNo = trim($personalNo);

        $personalNo = preg_replace('/[^\d]/', '', $personalNo);

        if (!is_numeric($personalNo) || $personalNo == '') {
            throw new Exception("A string that doesn't have any number is invalid.");
        }

        $sum = '';

        for ($i = strlen($personalNo) - 1; $i >= 0; --$i) {
            $sum .= $i & 1 ? $personalNo[$i] : $personalNo[$i] * 2;
        }

        return array_sum(str_split($sum)) % 10;
    }

    /**
     * Checks if a personal no. is valid according to the Luhn algorithm
     * @param $personalNo string
     * @return bool
     */
    public function isLuhnValid(string $personalNo)
    {
        $personalNo = trim($personalNo);

        if (empty($personalNo)) {
            return false;
        }

        return self::luhnChecksum($personalNo) == 0;
    }
}
