<?php
/**
 * Created by PhpStorm.
 * User: Milad
 * Date: 26-Feb-17
 * Time: 13:29
 */

namespace Bekrafta;

/**
 * Class LuhnAlgorithm
 * Implementation of Luhn Algorithm https://en.wikipedia.org/wiki/Luhn_algorithm
 * @package Bekrafta
 */
class LuhnAlgorithm
{
    /**
     * Cleans the number and removes any spaces surrounding it.
     * @param $number string
     * @return string
     */
    private function clean($number)
    {
        $number = preg_replace('#[^\d]#', '', $number);
        return trim($number);
    }

    /**
     * Calculates the Luhn checksum of a personal no.
     * @param string $number
     * @return int The modulo 10 of the number
     */
    public function luhnChecksum($number)
    {
        $number = $this->clean($number);

        // Reverse the string
        $number = strrev($number);

        $total = 0;

        // From the rightmost digit, which is the check digit,
        // and moving left, double the value of every second digit.
        for ($i = 0; $i <= strlen($number) - 1; $i++) {
            $val = (int) $number[$i];

            $val = ($i & 1) ? $val * 2 : $val;

            // If the result of this doubling operation is
            // greater than 9 then subtract 9 from the product
            if ($val > 9) {
                $val -= 9;
            }

            // Take the sum of all the digits
            $total += $val;
        }

        return $total % 10;
    }

    /**
     * Checks if the number is valid according to Luhn Algorithm
     * @param $number string
     * @return bool
     */
    public function isLuhnValid($number)
    {
        $number = $this->clean($number);

        // If the total modulo 10 is equal to 0
        // then the number is valid according to the Luhn formula
        return $this->luhnChecksum($number) == 0;
    }

    /**
     * Calculates the appropriate checksum number.
     * @param $partialNumber string
     * @return int
     */
    public function calculateLuhn($partialNumber)
    {
        $checkDigit = $this->luhnChecksum(intval($partialNumber) * 10);
        return $checkDigit == 0 ? $checkDigit : 10 - $checkDigit;
    }
}
