<?php
/*
88""Yb 888888 88  dP 88""Yb    db    888888 888888    db
88__dP 88__   88odP  88__dP   dPYb   88__     88     dPYb
88""Yb 88""   88"Yb  88"Yb   dP__Yb  88""     88    dP__Yb
88oodP 888888 88  Yb 88  Yb dP""""Yb 88       88   dP""""Yb
*/

namespace Bekrafta;

use DateTime;

class Sweden extends BekraftaAbstract {
    protected $genderElement = 'identifier';

    /**
     * Sweden constructor.
     * @param string $personalNo
     */
    public function __construct(string $personalNo) {
        $this->format = '#^';
        $this->format .= '(?P<year>[0-9]{2})';
        $this->format .= '(?P<month>[0-9]{2})';
        $this->format .= '(?P<day>[0-9]{2})';
        $this->format .= '(?P<separator>[\-+])';
        $this->format .= '(?P<identifier>[0-9]{3})';
        $this->format .= '(?P<checksum>[0-9])';
        $this->format .= '$#';

        parent::__construct($personalNo);
    }

    public function getYear(): string {
        $birthday = $this->elements['year'] . '-' . $this->elements['month'] . '-' . $this->elements['day'];

        $todayObj = new DateTime('today');

        $century = '19';

        if ($todayObj < new DateTime('20' . $birthday)) {
            $century = '19';
        } elseif ($todayObj >= new DateTime('20' . $birthday) && $this->elements['separator'] === '-') {
            $century = '20';
        } elseif ($todayObj >= new DateTime('19' . $birthday) && $this->elements['separator'] === '+') {
            $century = '19';
        }

        return $century . $this->elements['year'];
    }

    protected function validateDate(): bool {
        return checkdate(
            (int) $this->elements['month'],
            (int) $this->elements['day'],
            (int) '19' . $this->elements['year']
        ) or checkdate(
            (int) $this->elements['month'],
            (int) $this->elements['day'],
            (int) '18' . $this->elements['year']
        ) or checkdate(
            (int) $this->elements['month'],
            (int) $this->elements['day'],
            (int) '20' . $this->elements['year']
        );
    }

    protected function validateChecksum(): bool {
        $luhnAlgorithm = new LuhnAlgorithm();

        return $luhnAlgorithm->isLuhnValid($this->personalNo);
    }

    public function getCensored(): string {
        return $this->elements['year'] .
            $this->elements['month'] .
            $this->elements['day'] .
            $this->elements['separator'] .
            '****';
    }
}
