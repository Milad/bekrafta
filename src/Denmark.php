<?php
/*
88""Yb 888888 88  dP 88""Yb    db    888888 888888    db
88__dP 88__   88odP  88__dP   dPYb   88__     88     dPYb
88""Yb 88""   88"Yb  88"Yb   dP__Yb  88""     88    dP__Yb
88oodP 888888 88  Yb 88  Yb dP""""Yb 88       88   dP""""Yb
*/

namespace Bekrafta;

class Denmark extends BekraftaAbstract {
    protected $genderElement = 'checksum';

    /**
     * Denmark constructor.
     * @param string $personalNo
     */
    public function __construct(string $personalNo) {
        $this->format = '#^';
        $this->format .= '(?P<day>[0-9]{2})';
        $this->format .= '(?P<month>[0-9]{2})';
        $this->format .= '(?P<year>[0-9]{2})';
        $this->format .= '(?P<separator>[\-])';
        $this->format .= '(?P<centuryIndicator>[0-9])';
        $this->format .= '(?P<individualNumber>[0-9]{2})';
        $this->format .= '(?P<checksum>[0-9])';
        $this->format .= '$#';

        parent::__construct($personalNo);
    }

    public function getYear(): string {
        $centuryIndicator = intval($this->elements['centuryIndicator']);
        $year = intval($this->elements['year']);

        // https://da.wikipedia.org/wiki/CPR-nummer#Under_eller_over_100_.C3.A5r
        $century = '19';
        if ((in_array($centuryIndicator, [4, 9]) and $year <= 36) or
            (in_array($centuryIndicator, [5, 6, 7, 8]) and $year <= 57)
        ) {
            $century = '20';
        } elseif (in_array($centuryIndicator, [5, 6, 7, 8]) and $year >= 58) {
            $century = '18';
        }

        return $century . $this->elements['year'];
    }

    protected function validateChecksum(): bool {
        // Since not all Danish numbers validate
        // Then there is no point of checking them!
        return true;
    }

    public function getCensored(): string {
        return $this->elements['day'] . $this->elements['month'] . $this->elements['year'] . '-****';
    }
}
