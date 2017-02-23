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

    public function validate($personal_no)
    {
        // Check the format!
        preg_match($this->pattern, $personal_no, $matches);

        if (!$matches) {
            return false;
        }

        return true;

        // var_dump($matches);

        // TODO: Implement validate() method.
    }
}
