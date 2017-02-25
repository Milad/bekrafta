<?php
/**
 * Created by PhpStorm.
 * User: Milad
 * Date: 23-Feb-17
 * Time: 21:18
 */

namespace Bekrafta;

class Swedish extends BekraftaAbstract
{
    protected $pattern = '#(18|19|20)?[0-9]{6}(\-|\+)?[0-9]{4}#';

    /**
     * Uses all the required test to validate a personal no.
     * @param $personalNo string
     * @return bool
     */
    public function validate(string $personalNo): bool
    {
        $personalNo = trim($personalNo);
        $personalNo = $this->removeLeadingCenturies($personalNo);

        if (empty($personalNo) || !$this->validateFormat($personalNo)
            || !$this->isLuhnValid($personalNo)) {
            return false;
        }

        return true;
    }

    /**
     * Removes the leading century digits because they are not
     * used to calculate the checksum
     * @param $personalNo string
     * @return string
     */
    public function removeLeadingCenturies(string $personalNo): string
    {
        if (strlen($personalNo) > 11) {
            return preg_replace('#^(18|19|20)#', '', $personalNo);
        }

        return $personalNo;
    }
}
