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

    /**
     * Takes personal number and calculate the year of birth
     *
     * @param string $personalNo
     * @return string
     */
    public function getYear(string $personalNo): string {
        $match = $this->getElements($personalNo);

        $century = '19';

        switch ($match['centurySign']) {
            case '-':
                $century = '19';
                break;
            case '+':
                $century = '18';
                break;
            case 'A':
                $century = '20';
                break;
        }

        return $century . $match['year'];
    }
}
