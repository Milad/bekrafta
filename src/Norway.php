<?php

namespace Bekrafta;

class Norway extends BekraftaAbstract {
    public function __construct() {
        $this->format = '#';
        $this->format .= '(?P<day>[0-9]{2})';
        $this->format .= '(?P<month>[0-9]{2})';
        $this->format .= '(?P<year>[0-9]{2})';
        $this->format .= '(?P<individualNumber>[0-9]{3})';
        $this->format .= '(?P<checksum1>[0-9])';
        $this->format .= '(?P<checksum2>[0-9])';
        $this->format .= '#';
    }

    /**
     * Uses all the required test to validate a personal no.
     * @param $personalNo string
     * @return bool
     */
    public function validate(string $personalNo): bool {
        $personalNo = trim($personalNo);

        if (empty($personalNo) || !$this->validateFormat($personalNo)
            || !$this->isValidChecksum($personalNo)) {
            return false;
        }

        return true;
    }

    /**
     * Are both checksums valid?
     * @param string $personalNo
     * @return bool
     */
    protected function isValidChecksum(string $personalNo): bool {
        $group1 = [3, 7, 6, 1, 8, 9, 4, 5, 2, 1];
        $group2 = [5, 4, 3, 2, 7, 6, 5, 4, 3, 2, 1];

        if (!$this->validateCheckSum($personalNo, $group1) or
            !$this->validateCheckSum($personalNo, $group2)) {
            return false;
        }

        return true;
    }

    /**
     * Validets a checksum in the personal number.
     *
     * @param string $personalNo
     * @param array $numbers
     * @return bool
     */
    protected function validateCheckSum(string $personalNo, array $numbers) {
        $sum = 0;

        foreach ($numbers as $index => $number) {
            $sum += ($number * intval($personalNo[$index]));
        }

        return $sum % 11 === 0;
    }

    /**
     * Gets the age of the person using the personal number.
     *
     * @param string $personalNo
     * @param string $today
     * @return int
     */
    public function getAge(string $personalNo, string $today = 'today'): int {
        $match = $this->getElements($personalNo);

        $birthday = $match['year'] . '-' . $match['month'] . '-' . $match['day'];

        $individualNumber = intval($match['individualNumber']);
        $year = intval($match['year']);

        $century = 19;

        if ($individualNumber > 499) {
            if ($individualNumber < 750 && $year >= 54) {
                $century = 18;
            } elseif ($year < 40) {
                $century = 20;
            } elseif ($individualNumber >= 900 && $year >= 40) { // special cases
                $century = 19;
            }
        }

        $birthday = $century . $birthday;

        return $this->calculateAge($birthday, $today);
    }

    /**
     * Returns a censored version of the personal number.
     *
     * @param string $personalNo
     * @return string
     */
    public function getCensored(string $personalNo): string {
        $match = $this->getElements($personalNo);

        return $match['day'] . $match['month'] . $match['year'] . '*****';
    }

    /**
     * Returns the gender from the personal number.
     *
     * @param string $personalNo
     * @return string
     */
    public function getGender(string $personalNo): string {
        $match = $this->getElements($personalNo);
        $identifier = intval($match['individualNumber']);

        if (($identifier % 2) == 0) {
            return 'f';
        }

        return 'm';
    }
}
