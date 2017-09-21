<?php
/**
 * Created by PhpStorm.
 * User: milad
 * Date: 7/18/17
 * Time: 11:36 PM
 */

namespace Bekrafta;

class SwedenExtended extends Sweden {
    public function __construct() {
        parent::__construct();

        $this->format = '#';
        $this->format .= '(?P<century>18|19|20)?';
        $this->format .= '(?P<year>[0-9]{2})';
        $this->format .= '(?P<month>[0-9]{2})';
        $this->format .= '(?P<day>[0-9]{2})';
        $this->format .= '(?P<separator>[\-+])?';
        $this->format .= '(?P<identifier>[0-9]{3})';
        $this->format .= '(?P<checksum>[0-9]{1})';
        $this->format .= '#';
    }

    /**
     * Uses all the required test to validate a personal no.
     * @param $personalNo string
     * @return bool
     */
    public function validate(string $personalNo): bool {
        $personalNo = $this->removeLeadingCenturies($personalNo);

        return parent::validate($personalNo);
    }

    /**
     * Returns a censored version of the personal number.
     *
     * @param string $personalNo
     * @return string
     */
    public function getCensored(string $personalNo): string {
        $match = $this->getElements($personalNo);

        return $match['century'] . $match['year'] . $match['month'] . $match['day'] . $match['separator'] . '****';
    }

    /**
     * Removes the leading century digits because they are not
     * used to calculate the checksum
     * @param $personalNo string
     * @return string
     */
    public function removeLeadingCenturies(string $personalNo): string {
        if (empty($personalNo)) {
            return $personalNo;
        }

        $match = $this->getElements($personalNo);

        $newPersonalNo = $match['year'] .
            $match['month'] .
            $match['day'] .
            $match['separator'] .
            $match['identifier'] .
            $match['checksum'];

        return $newPersonalNo;
    }

    /**
     * Takes personal number and calculate the year of birth
     *
     * @param string $personalNo
     * @return string
     */
    public function getYear(string $personalNo): string {
        $match = $this->getElements($personalNo);

        return $match['century'] . $match['year'];
    }
}
