<?php

namespace Bekrafta;

class Denmark extends BekraftaAbstract {
    public function __construct() {
        $this->format = '#';
        $this->format .= '(?P<day>[0-9]{2})';
        $this->format .= '(?P<month>[0-9]{2})';
        $this->format .= '(?P<year>[0-9]{2})';
        $this->format .= '(?P<separator>[\-])';
        $this->format .= '(?P<centuryIndicator>[0-9])';
        $this->format .= '(?P<individualNumber>[0-9]{2})';
        $this->format .= '(?P<checksum>[0-9])';
        $this->format .= '#';
    }

    /**
     * Uses all the required test to validate a personal no.
     * @param $personalNo string
     * @return bool
     */
    public function validate(string $personalNo): bool {
        $personalNo = trim($personalNo);

        if (empty($personalNo) or !$this->validateFormat($personalNo)) {
            return false;
        }

        $birthday = $this->getBirthday($personalNo);
        $birthdayBits = explode('-', $birthday);
        if (!checkdate($birthdayBits[1], $birthdayBits[2], $birthdayBits[0])) {
            return false;
        }

        return true;
    }

    /**
     * Returns the gender from the personal number.
     *
     * @param string $personalNo
     * @return string
     */
    public function getGender(string $personalNo): string {
        $match = $this->getElements($personalNo);
        $identifier = intval($match['checksum']);

        if (($identifier % 2) == 0) {
            return 'f';
        }

        return 'm';
    }

    /**
     * Returns a censored version of the personal number.
     *
     * @param string $personalNo
     * @return string
     */
    public function getCensored(string $personalNo): string {
        $match = $this->getElements($personalNo);

        return $match['day'] . $match['month'] . $match['year'] . '-****';
    }

    /**
     * Takes personal number and calculate the year of birth
     *
     * @param string $personalNo
     * @return string
     */
    public function getYear(string $personalNo): string {
        $match = $this->getElements($personalNo);

        $centuryIndicator = intval($match['centuryIndicator']);
        $year = intval($match['year']);

        // https://da.wikipedia.org/wiki/CPR-nummer#Under_eller_over_100_.C3.A5r
        $century = '19';
        if ((in_array($centuryIndicator, [4, 9]) and $year <= 36) or
            (in_array($centuryIndicator, [5, 6, 7, 8]) and $year <= 57)
        ) {
            $century = '20';
        } elseif (in_array($centuryIndicator, [5, 6, 7, 8]) and $year >= 58) {
            $century = '18';
        }

        return $century . $match['year'];
    }
}
