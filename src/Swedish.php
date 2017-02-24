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

    public function validate($personalNo)
    {
        $personalNo = trim($personalNo);

        // Remove leading 18, 19 or 20
        $personalNo = $this->removeLeadingCentries($personalNo);

        if (empty($personalNo)) {
            return false;
        }

        if (!$this->validateFormat($personalNo)) {
            return false;
        }

        // Check if the checksum adds up!
        if (!$this->isLuhnValid($personalNo)) {
            return false;
        }

        return true;
    }
}
