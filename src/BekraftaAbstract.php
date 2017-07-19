<?php

namespace Bekrafta;

use DateTime;
use Exception;

abstract class BekraftaAbstract {
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

    abstract public function getCensored(string $personalNo): string;

    abstract public function getAge(string $personalNo, string $today = 'today'): int;

    protected function calculateAge(string $birthday, string $today = "today"): int {
        $from = new DateTime($birthday);
        $todayObj = new DateTime($today);

        return $from->diff($todayObj)->y;
    }

    protected function getElements(string $personalNo): array {
        if (preg_match($this->format, $personalNo, $match) !== 1) {
            throw new Exception("The provided personal number doesn't match the format.");
        }

        return $match;
    }
}
