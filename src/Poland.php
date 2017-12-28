<?php
/*
88""Yb 888888 88  dP 88""Yb    db    888888 888888    db
88__dP 88__   88odP  88__dP   dPYb   88__     88     dPYb
88""Yb 88""   88"Yb  88"Yb   dP__Yb  88""     88    dP__Yb
88oodP 888888 88  Yb 88  Yb dP""""Yb 88       88   dP""""Yb
*/

namespace Bekrafta;

class Poland extends BekraftaAbstract {
    protected $genderElement = 'gender';

    /**
     * Poland constructor.
     * @param string $personalNo
     */
    public function __construct(string $personalNo) {
        $this->format = '#^';
        $this->format .= '(?P<year>[0-9]{2})';
        $this->format .= '(?P<month>[0-9]{2})';
        $this->format .= '(?P<day>[0-9]{2})';
        $this->format .= '(?P<individualNumber>[0-9]{3})';
        $this->format .= '(?P<gender>[0-9])';
        $this->format .= '(?P<checksum>[0-9])';
        $this->format .= '$#';

        parent::__construct($personalNo);
    }

    public function getYear(): string {
        $month = intval($this->elements['month']);

        $century = '19';

        if ($month < 20) {
            $century = '19';
        } elseif ($month > 20 && $month < 33) {
            $century = '20';
        } elseif ($month > 40 && $month < 53) {
            $century = '21';
        } elseif ($month > 60 && $month < 73) {
            $century = '22';
        }

        return $century . $this->elements['year'];
    }

    protected function getMonth(): string {
        $month = intval($this->elements['month']);

        $newMonth = $month % 20;

        return sprintf('%02d', $newMonth);
    }

    protected function validateDate(): bool {
        return checkdate(
            (int) $this->getMonth(),
            (int) $this->elements['day'],
            (int) $this->getYear()
        );
    }

    protected function validateChecksum(): bool {
        $group = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3];

        $sum = 0;

        foreach ($group as $index => $number) {
            $sum += ($number * intval($this->personalNo[$index]));
        }

        $modulo = $sum % 10;

        if ($modulo === 0 && intval($this->personalNo[10]) === 0) {
            return true;
        } elseif (intval($this->personalNo[10]) === 10 - $modulo) {
            return true;
        }

        return false;
    }

    public function getBirthday(): string {
        return $this->getYear() . '-' . $this->getMonth() . '-' . $this->elements['day'];
    }

    public function getCensored(): string {
        return $this->elements['year'] .
            $this->elements['month'] .
            $this->elements['day'] .
            '*****';
    }

    protected function validateSaneValues(): bool {
        return $this->elements['month'] % 20 <= 12 && $this->elements['day'] <= 31;
    }
}
