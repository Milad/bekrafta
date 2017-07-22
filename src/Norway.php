<?php

namespace Bekrafta;

class Norway extends BekraftaAbstract {
    /**
     * @var string Regex pattern to verify the format of the personal no.
     */
    protected $format;

    public function __construct() {
        $this->format = '#';
        $this->format .= '(?P<day>[0-9]{2})';
        $this->format .= '(?P<month>[0-9]{2})';
        $this->format .= '(?P<year>[0-9]{2})';
        $this->format .= '(?P<individualNumber>[0-9]{3})';
        $this->format .= '(?P<checksum1>[0-9])';
        $this->format .= '(?P<checksum2>[0-9])';
        $this->format .= '#';
    }

    public function validate(string $personalNo): bool {
        $personalNo = trim($personalNo);

        if (empty($personalNo) || !$this->validateFormat($personalNo)
            || !$this->isValidChecksum($personalNo)) {
            return false;
        }

        return true;
    }

    protected function isValidChecksum(string $personalNo): bool {
        $group1 = [3, 7, 6, 1, 8, 9, 4, 5, 2, 1];
        $group2 = [5, 4, 3, 2, 7, 6, 5, 4, 3, 2, 1];

        if (!$this->validateCheckSum($personalNo, $group1) or
            !$this->validateCheckSum($personalNo, $group2)) {
            return false;
        }

        return true;
    }

    protected function validateCheckSum(string $personalNo, array $numbers) {
        $sum = 0;

        foreach ($numbers as $index => $number) {
            $sum += ($number * intval($personalNo[$index]));
        }

        return $sum % 11 === 0;
    }

    public function getAge(string $personalNo, string $today = 'today'): int {
        $match = $this->getElements($personalNo);

        $birthday = $match['year'] . '-' . $match['month'] . '-' . $match['day'];

        /*
         * 000-499 -> 1900-1999.
         * 500-749 -> 1854-1899.
         * 500-999 -> 2000-2039.
         * 900-999 -> 1940-1999.
         */
        if ($match['individualNumber'] <= 499) {
            $birthday = '19' . $birthday;
        }

        return $this->calculateAge($birthday, $today);
    }

    public function getCensored(string $personalNo): string {
        $match = $this->getElements($personalNo);

        return $match['day'] . $match['month'] . $match['year'] . '*****';
    }
}
