<?php

namespace Bekrafta;

class Finland extends BekraftaAbstract {
    public function __construct() {
        $this->format = '#';
        $this->format .= '(?P<day>[0-9]{2})';
        $this->format .= '(?P<month>[0-9]{2})';
        $this->format .= '(?P<year>[0-9]{2})';
        $this->format .= '(?P<centurySign>[\-+A])';
        $this->format .= '(?P<individualNumber>[0-9]{3})';
        $this->format .= '(?P<checksum>[0-9A-Y])';
        $this->format .= '#i';
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
     * Validates the checksum of the personal number.
     *
     * @param string $personalNo
     * @return bool
     */
    protected function isValidChecksum(string $personalNo): bool {
        $controlCharacter = "0123456789ABCDEFHJKLMNPRSTUVWXY";

        $match = $this->getElements($personalNo);

        $num = $match['day'] . $match['month'] . $match['year'] . $match['individualNumber'];
        $num = intval($num);

        $remainder = $num % 31;

        if ($controlCharacter[$remainder] == strtoupper($match['checksum'])) {
            return true;
        }

        return false;
    }

    /**
     * Returns a censored version of the personal number.
     *
     * @param string $personalNo
     * @return string
     */
    public function getCensored(string $personalNo): string {
        $match = $this->getElements($personalNo);

        return $match['day'] . $match['month'] . $match['year'] . $match['centurySign'] . '****';
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

        switch ($match['centurySign']) {
            case '-':
                $birthday = '19' . $birthday;
                break;
            case '+':
                $birthday = '18' . $birthday;
                break;
            case 'A':
                $birthday = '20' . $birthday;
                break;
        }

        return $this->calculateAge($birthday, $today);
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
