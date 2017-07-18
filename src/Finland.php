<?php

namespace Bekrafta;

class Finland extends BekraftaAbstract {
    /**
     * @var string Regex pattern to verify the format of the personal no.
     */
    protected $format;

    public function __construct() {
        $this->format = '#';
        $this->format .= '(?P<day>[0-9]{2})';
        $this->format .= '(?P<month>[0-9]{2})';
        $this->format .= '(?P<year>[0-9]{2})';
        $this->format .= '(?P<centurySign>\+|\-|A)?';
        $this->format .= '(?P<individualNumber>[0-9]{3})';
        $this->format .= '(?P<checksum>[0-9A-Y]{1})';
        $this->format .= '#i';
    }

    /**
     * Uses all the required test to validate a personal no.
     * @param $personalNo string
     * @return bool
     */
    public function validate(string $personalNo): bool {
        $personalNo = trim($personalNo);

        if (empty($personalNo) || !$this->validateFormat($personalNo)
            || !$this->isValidChecksum($personalNo)) {
            return false;
        }

        return true;
    }

    public function isValidChecksum(string $personalNo): bool {
        $controlCharacter = "0123456789ABCDEFHJKLMNPRSTUVWXY";

        if (preg_match($this->format, $personalNo, $matches)) {
            $num = $matches['day'] . $matches['month'] . $matches['year'] . $matches['individualNumber'];
            $num = intval($num);

            $remainder = $num % 31;

            if ($controlCharacter[$remainder] == strtoupper($matches['checksum'])) {
                return true;
            }
        }

        return false;
    }

    public function getCensored(string $personalNo): string {
        return $personalNo;
    }
}
