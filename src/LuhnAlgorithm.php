<?php
/*
88""Yb 888888 88  dP 88""Yb    db    888888 888888    db
88__dP 88__   88odP  88__dP   dPYb   88__     88     dPYb
88""Yb 88""   88"Yb  88"Yb   dP__Yb  88""     88    dP__Yb
88oodP 888888 88  Yb 88  Yb dP""""Yb 88       88   dP""""Yb
*/

namespace Bekrafta;

/**
 * Class LuhnAlgorithm
 * Implementation of Luhn Algorithm https://en.wikipedia.org/wiki/Luhn_algorithm
 * @package Bekrafta
 */
class LuhnAlgorithm {
    /**
     * Cleans the number and removes any spaces surrounding it.
     *
     * @param string $number
     * @return string
     */
    protected function clean(string $number): string {
        $number = preg_replace('#[^\d]#', '', $number);
        return trim($number);
    }

    /**
     * Calculates the Luhn checksum of a personal no.
     *
     * @param string $number
     * @return int The modulo 10 of the number
     */
    public function luhnChecksum(string $number): int {
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
     *
     * @param string $number
     * @return bool
     */
    public function isLuhnValid(string $number): bool {
        $number = $this->clean($number);

        // If the total modulo 10 is equal to 0
        // then the number is valid according to the Luhn formula
        return $this->luhnChecksum($number) == 0;
    }

    /**
     * Calculates the appropriate checksum number.
     *
     * @param string $partialNumber
     * @return int
     */
    public function calculateLuhn(string $partialNumber): int {
        $checkDigit = $this->luhnChecksum(intval($partialNumber) * 10);
        return $checkDigit == 0 ? $checkDigit : 10 - $checkDigit;
    }
}
