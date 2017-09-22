<?php
/*
88""Yb 888888 88  dP 88""Yb    db    888888 888888    db
88__dP 88__   88odP  88__dP   dPYb   88__     88     dPYb
88""Yb 88""   88"Yb  88"Yb   dP__Yb  88""     88    dP__Yb
88oodP 888888 88  Yb 88  Yb dP""""Yb 88       88   dP""""Yb
*/

namespace Bekrafta;

class Finland extends BekraftaAbstract {
    protected $genderElement = 'individualNumber';

    /**
     * Finland constructor.
     * @param string $personalNo
     */
    public function __construct(string $personalNo) {
        $this->format = '#^';
        $this->format .= '(?P<day>[0-9]{2})';
        $this->format .= '(?P<month>[0-9]{2})';
        $this->format .= '(?P<year>[0-9]{2})';
        $this->format .= '(?P<centurySign>[\-+A])';
        $this->format .= '(?P<individualNumber>[0-9]{3})';
        $this->format .= '(?P<checksum>[0-9A-Y])';
        $this->format .= '$#i';

        parent::__construct($personalNo);
    }

    public function getYear(): string {
        $century = '19';

        switch ($this->elements['centurySign']) {
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

        return $century . $this->elements['year'];
    }

    protected function validateChecksum(): bool {
        $controlCharacter = "0123456789ABCDEFHJKLMNPRSTUVWXY";

        $num = $this->elements['day'] .
            $this->elements['month'] .
            $this->elements['year'] .
            $this->elements['individualNumber'];

        $num = intval($num);

        $remainder = $num % 31;

        if ($controlCharacter[$remainder] === strtoupper($this->elements['checksum'])) {
            return true;
        }

        return false;
    }

    public function getCensored(): string {
        return $this->elements['day'] .
            $this->elements['month'] .
            $this->elements['year'] .
            $this->elements['centurySign'] .
            '****';
    }
}
