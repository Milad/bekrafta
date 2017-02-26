<?php
/**
 * Created by PhpStorm.
 * User: Milad
 * Date: 23-Feb-17
 * Time: 21:18
 */

namespace Bekrafta;

class Sweden extends BekraftaAbstract
{
    /**
     * @var string Regex pattern to verify the format of the personal no.
     */
    protected $format;

    public function __construct()
    {
        $this->format = '#';
        $this->format .= '(?P<century>18|19|20)?';
        $this->format .= '(?P<year>[0-9]{2})';
        $this->format .= '(?P<month>[0-9]{2})';
        $this->format .= '(?P<day>[0-9]{2})';
        $this->format .= '(?P<separator>\-|\+)?';
        $this->format .= '(?P<identifier>[0-9]{3})';
        $this->format .= '(?P<checksum>[0-9]{1})';
        $this->format .= '#';
    }

    /**
     * Uses all the required test to validate a personal no.
     * @param $personalNo string
     * @return bool
     */
    public function validate($personalNo)
    {
        $personalNo = trim($personalNo);
        $personalNo = $this->removeLeadingCenturies($personalNo);

        $luhnAlgorithm = new LuhnAlgorithm();

        if (empty($personalNo) || !$this->validateFormat($personalNo)
            || !$luhnAlgorithm->isLuhnValid($personalNo)) {
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
    public function removeLeadingCenturies($personalNo)
    {
        if (strlen($personalNo) > 11) {
            return preg_replace('#^(18|19|20)#', '', $personalNo);
        }

        return $personalNo;
    }
}
