<?php

namespace Bekrafta;

use DateTime;

class Sweden extends BekraftaAbstract {
    public function __construct() {
        $this->format = '#^';
        $this->format .= '(?P<year>[0-9]{2})';
        $this->format .= '(?P<month>[0-9]{2})';
        $this->format .= '(?P<day>[0-9]{2})';
        $this->format .= '(?P<separator>[\-+])';
        $this->format .= '(?P<identifier>[0-9]{3})';
        $this->format .= '(?P<checksum>[0-9])';
        $this->format .= '$#';
    }

    /**
     * Uses all the required test to validate a personal no.
     * @param $personalNo string
     * @return bool
     */
    public function validate(string $personalNo): bool {
        $personalNo = trim($personalNo);

        $luhnAlgorithm = new LuhnAlgorithm();

        if (empty($personalNo) || !$this->validateFormat($personalNo)
            || !$luhnAlgorithm->isLuhnValid($personalNo)) {
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
    public function getCensored(string $personalNo): string {
        $match = $this->getElements($personalNo);

        return $match['year'] . $match['month'] . $match['day'] . $match['separator'] . '****';
    }

    /**
     * Returns the gender from the personal number.
     *
     * @param string $personalNo
     * @return string
     */
    public function getGender(string $personalNo): string {
        $match = $this->getElements($personalNo);
        $identifier = intval($match['identifier']);

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

        $birthday = $match['year'] . '-' . $match['month'] . '-' . $match['day'];

        $todayObj = new DateTime('today');

        $century = '19';

        if ($todayObj < new DateTime('20' . $birthday)) {
            $century = '19';
        } elseif ($todayObj >= new DateTime('20' . $birthday) && $match['separator'] === '-') {
            $century = '20';
        } elseif ($todayObj >= new DateTime('19' . $birthday) && $match['separator'] === '+') {
            $century = '19';
        }

        return $century . $match['year'];
    }
}
