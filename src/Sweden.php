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
     * Gets the age of the person using the personal number.
     *
     * @param string $personalNo
     * @param string $today
     * @return int
     */
    public function getAge(string $personalNo, string $today = 'today'): int {
        $match = $this->getElements($personalNo);

        $birthday = $match['year'] . '-' . $match['month'] . '-' . $match['day'];

        $todayObj = new DateTime($today);

        if ($todayObj < new DateTime('20' . $birthday)) {
            $prefix = '19';
        } elseif ($todayObj >= new DateTime('20' . $birthday) && $match['separator'] === '-') {
            $prefix = '20';
        } elseif ($todayObj >= new DateTime('19' . $birthday) && $match['separator'] === '+') {
            $prefix = '19';
        }

        return $this->calculateAge($prefix . $birthday, $today);
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
}
