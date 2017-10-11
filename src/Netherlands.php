<?php
/*
88""Yb 888888 88  dP 88""Yb    db    888888 888888    db
88__dP 88__   88odP  88__dP   dPYb   88__     88     dPYb
88""Yb 88""   88"Yb  88"Yb   dP__Yb  88""     88    dP__Yb
88oodP 888888 88  Yb 88  Yb dP""""Yb 88       88   dP""""Yb
*/

namespace Bekrafta;

class Netherlands extends BekraftaAbstract {
    /**
     * Netherlands constructor.
     * @param string $personalNo
     */
    public function __construct(string $personalNo) {
        $this->format = '#^';
        $this->format .= '(?P<numbers>[0-9]{9})';
        $this->format .= '$#';

        parent::__construct($personalNo);
    }

    public function getYear(): string {
        return '';
    }

    protected function validateDate(): bool {
        return true;
    }

    protected function validateChecksum(): bool {
        $group = [9, 8, 7, 6, 5, 4, 3, 2, -1];

        if (!$this->validateBitCheckSum($group)) {
            return false;
        }

        return true;
    }

    public function getBirthday(): string {
        return '';
    }

    public function getAge(string $today = 'today'): int {
        return 0;
    }

    public function getCensored(): string {
        return $this->personalNo;
    }

    public function getGender(): string {
        return '';
    }
}
