<?php
/*
88""Yb 888888 88  dP 88""Yb    db    888888 888888    db
88__dP 88__   88odP  88__dP   dPYb   88__     88     dPYb
88""Yb 88""   88"Yb  88"Yb   dP__Yb  88""     88    dP__Yb
88oodP 888888 88  Yb 88  Yb dP""""Yb 88       88   dP""""Yb
*/

namespace Bekrafta;

class SwedenExtended extends Sweden {
    /**
     * SwedenExtended constructor.
     * @param string $personalNo
     */
    public function __construct(string $personalNo) {
        parent::__construct($personalNo);

        $this->format = '#';
        $this->format .= '(?P<century>18|19|20)?';
        $this->format .= '(?P<year>[0-9]{2})';
        $this->format .= '(?P<month>[0-9]{2})';
        $this->format .= '(?P<day>[0-9]{2})';
        $this->format .= '(?P<separator>[\-+])?';
        $this->format .= '(?P<identifier>[0-9]{3})';
        $this->format .= '(?P<checksum>[0-9]{1})';
        $this->format .= '#';

        $this->personalNo = trim($personalNo);
        $this->validateFormat();
    }

    public function getYear(): string {
        return $this->elements['century'] . $this->elements['year'];
    }

    protected function validateChecksum(): bool {
        $this->personalNo = $this->removeLeadingCenturies();
        return parent::validateChecksum();
    }

    public function getCensored(): string {
        return $this->elements['century'] .
            $this->elements['year'] .
            $this->elements['month'] .
            $this->elements['day'] .
            $this->elements['separator'] .
            '****';
    }

    public function getGender(): string {
        $identifier = intval($this->elements['identifier']);

        if (($identifier % 2) == 0) {
            return 'f';
        }

        return 'm';
    }

    /**
     * Removes the leading century digits because they are not
     * used to calculate the checksum
     * @return string
     */
    public function removeLeadingCenturies(): string {
        if (empty($this->personalNo)) {
            return $this->personalNo;
        }

        return $this->elements['year'] .
            $this->elements['month'] .
            $this->elements['day'] .
            $this->elements['separator'] .
            $this->elements['identifier'] .
            $this->elements['checksum'];
    }
}
