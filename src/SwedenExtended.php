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

    public function validate(string $personalNo): bool {
        $personalNo = $this->removeLeadingCenturies($personalNo);

        return parent::validate($personalNo);
    }

    public function getAge(string $personalNo, string $today = 'today'): int {
        $match = $this->getElements($personalNo);

        $birthday = $match['century'] . $match['year'] . '-' . $match['month'] . '-' . $match['day'];

        return $this->calculateAge($birthday, $today);
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
}
