<?php

namespace Bekrafta;

use DateTime;
use Exception;

abstract class BekraftaAbstract {
    /**
     * @var string Regex pattern to verify the format of the personal no.
     */
    protected $format;

    /**
     * Uses all the required test to validate a personal no.
     * @param $personalNo string
     * @return bool
     */
    abstract public function validate(string $personalNo): bool;

    /**
     * Validates the format of a personal no.
     * Does not checksum the no.
     * @param $personalNo string
     * @return bool
     */
    public function validateFormat(string $personalNo): bool {
        preg_match($this->format, $personalNo, $match);

        if (!$match) {
            return false;
        }

        return true;
    }

    /**
     * Returns a censored version of the personal number.
     *
     * @param string $personalNo
     * @return string
     */
    abstract public function getCensored(string $personalNo): string;

    /**
     * Gets the age of the person using the personal number.
     *
     * @param string $personalNo
     * @param string $today
     * @return int
     */
    abstract public function getAge(string $personalNo, string $today = 'today'): int;

    /**
     * Returns the gender from the personal number.
     *
     * @param string $personalNo
     * @return string
     */
    abstract public function getGender(string $personalNo): string;

    /**
     * Calculates the age from the birthday.
     *
     * @param string $birthday
     * @param string $today
     * @return int
     */
    protected function calculateAge(string $birthday, string $today = "today"): int {
        $from = new DateTime($birthday);
        $todayObj = new DateTime($today);

        return $from->diff($todayObj)->y;
    }

    /**
     * Breaks the personal number into its elements.
     *
     * @param string $personalNo
     * @return array
     * @throws Exception
     */
    protected function getElements(string $personalNo): array {
        if (preg_match($this->format, $personalNo, $match) !== 1) {
            throw new Exception("The provided personal number doesn't match the format.");
        }

        return $match;
    }
}
