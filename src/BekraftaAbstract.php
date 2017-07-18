<?php

namespace Bekrafta;

abstract class BekraftaAbstract {
    /**
     * Uses all the required test to validate a personal no.
     * @param $personalNo string
     * @return bool
     */
    abstract public function validate(string $personalNo): bool;

    /**
     * Validates the format of a personal no.
     * Does not checksum the no.
     * @param $personalNo string
     * @return bool
     */
    public function validateFormat(string $personalNo): bool {
        preg_match($this->format, $personalNo, $matches);

        if (!$matches) {
            return false;
        }

        return true;
    }

    abstract public function getCensored(string $personalNo): string;
}
