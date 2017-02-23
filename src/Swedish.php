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
    private $pattern = '#(18|19|20)?[0-9]{6}(\-|\+)?[0-9]{4}#';

    public function validate($personalNo)
    {
        if (empty($personalNo)) {
            return false;
        }

        // Check the format!
        preg_match($this->pattern, $personalNo, $matches);

        if (!$matches) {
            return false;
        }

        # Remove leading 19
        $personalNo = preg_replace('#^19#', '', $personalNo);
        # Remove non-numeric characters like - and +
        $personalNo = preg_replace('#[^0-9]#', '', $personalNo);

        if (!$this->isLuhnValid($personalNo)) {
            return false;
        }

        return true;
    }
}
