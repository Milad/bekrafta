<?php
/**
 * Created by PhpStorm.
 * User: Milad
 * Date: 23-Feb-17
 * Time: 21:13
 */

namespace Bekrafta;

abstract class BekraftaAbstract
{
    /**
     * Uses all the required test to validate a personal no.
     * @param $personalNo string
     * @return bool
     */
    abstract public function validate($personalNo);

    /**
     * Validates the format of a personal no.
     * Does not checksum the no.
     * @param $personalNo string
     * @return bool
     */
    public function validateFormat($personalNo)
    {
        preg_match($this->format, $personalNo, $matches);

        if (!$matches) {
            return false;
        }

        return true;
    }
}
