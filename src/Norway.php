<?php
/*
88""Yb 888888 88  dP 88""Yb    db    888888 888888    db
88__dP 88__   88odP  88__dP   dPYb   88__     88     dPYb
88""Yb 88""   88"Yb  88"Yb   dP__Yb  88""     88    dP__Yb
88oodP 888888 88  Yb 88  Yb dP""""Yb 88       88   dP""""Yb
*/

namespace Bekrafta;

class Norway extends BekraftaAbstract {
    /**
     * Norway constructor.
     * @param string $personalNo
     */
    public function __construct(string $personalNo) {
        $this->format = '#';
        $this->format .= '(?P<day>[0-9]{2})';
        $this->format .= '(?P<month>[0-9]{2})';
        $this->format .= '(?P<year>[0-9]{2})';
        $this->format .= '(?P<individualNumber>[0-9]{3})';
        $this->format .= '(?P<checksum1>[0-9])';
        $this->format .= '(?P<checksum2>[0-9])';
        $this->format .= '#';

        parent::__construct($personalNo);
    }

    public function getYear(): string {
        $individualNumber = intval($this->elements['individualNumber']);
        $year = intval($this->elements['year']);

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

        return $century . $this->elements['year'];
    }

    protected function validateChecksum(): bool {
        $group1 = [3, 7, 6, 1, 8, 9, 4, 5, 2, 1];
        $group2 = [5, 4, 3, 2, 7, 6, 5, 4, 3, 2, 1];

        if (!$this->validateBitCheckSum($group1) or
            !$this->validateBitCheckSum($group2)) {
            return false;
        }

        return true;
    }

    /**
     * Validets a checksum in the personal number.
     * @param array $numbers
     * @return bool
     */
    protected function validateBitCheckSum(array $numbers) {
        $sum = 0;

        foreach ($numbers as $index => $number) {
            $sum += ($number * intval($this->personalNo[$index]));
        }

        return $sum % 11 === 0;
    }

    public function getCensored(): string {
        return $this->elements['day'] . $this->elements['month'] . $this->elements['year'] . '*****';
    }

    public function getGender(): string {
        $identifier = intval($this->elements['individualNumber']);

        if (($identifier % 2) == 0) {
            return 'f';
        }

        return 'm';
    }
}
