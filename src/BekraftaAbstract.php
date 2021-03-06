<?php
/*
88""Yb 888888 88  dP 88""Yb    db    888888 888888    db
88__dP 88__   88odP  88__dP   dPYb   88__     88     dPYb
88""Yb 88""   88"Yb  88"Yb   dP__Yb  88""     88    dP__Yb
88oodP 888888 88  Yb 88  Yb dP""""Yb 88       88   dP""""Yb
*/

namespace Bekrafta;

use DateTime;

abstract class BekraftaAbstract {
    /**
     * @var string Personal Number
     */
    protected $personalNo;

    /**
     * @var array Elements of the personal no.
     */
    protected $elements;

    /**
     * @var string Regex pattern to verify the format of the personal no.
     */
    protected $format;

    /**
     * @var string Defines which element contains the gender.
     */
    protected $genderElement;

    /**
     * BekraftaAbstract constructor.
     * @param string $personalNo The personal no.
     */
    public function __construct(string $personalNo) {
        $this->personalNo = trim($personalNo);
        $this->validateFormat();
    }

    /**
     * Uses all the required tests to validate a personal no.
     * @return bool
     */
    public function validate(): bool {
        return (
            !empty($this->personalNo) &&
            $this->validateFormat() &&
            $this->validateSaneValues() &&
            $this->validateDate() &&
            $this->validateChecksum()
        );
    }

    /**
     * Validates the format of a personal no.
     * @return bool
     */
    protected function validateFormat(): bool {
        if (preg_match($this->format, $this->personalNo, $match)) {
            $this->elements = $match;
            return true;
        }

        return false;
    }

    /**
     * Takes personal number and calculate the year of birth.
     * @return string
     */
    abstract public function getYear(): string;

    /**
     * Checks if the birthday is valid.
     * @return bool
     */
    protected function validateDate(): bool {
        return checkdate(
            (int) $this->elements['month'],
            (int) $this->elements['day'],
            (int) $this->getYear()
        );
    }

    /**
     * Validates the checksum.
     * @return bool
     */
    abstract protected function validateChecksum(): bool;

    /**
     * Takes the personal number and returns the birthday in the format YYYY-MM-DD
     * @return string
     */
    public function getBirthday(): string {
        if (!$this->validateSaneValues()) {
            return '';
        }
        return $this->getYear() . '-' . $this->elements['month'] . '-' . $this->elements['day'];
    }

    /**
     * Gets the age of the person using the personal number.
     * @param string $today
     * @return int
     */
    public function getAge(string $today = 'today'): int {
        $birthday = $this->getBirthday();

        return $this->calculateAge($birthday, $today);
    }

    /**
     * Calculates the age from the birthday.
     * @param string $birthday
     * @param string $today
     * @return int
     */
    protected function calculateAge(string $birthday, string $today = "today"): int {
        $from = new DateTime($birthday);
        $todayObj = new DateTime($today);

        return $from->diff($todayObj)->y;
    }

    /**
     * Returns a censored version of the personal number.
     * @return string
     */
    abstract public function getCensored(): string;

    /**
     * Returns the gender from the personal number.
     * @return string
     */
    public function getGender(): string {
        $identifier = intval($this->elements[$this->genderElement]);

        if (($identifier % 2) === 0) {
            return 'f';
        }

        return 'm';
    }

    /**
     * Validates a checksum in the personal number.
     * @param array $numbers Checksum digits
     * @param int $mod The modulus divider.
     * @return bool
     */
    protected function validateBitCheckSum(array $numbers, int $mod = 11) {
        $personalNoCleaned = preg_replace('/[^0-9]/', '', $this->personalNo);
        $sum = 0;

        foreach ($numbers as $index => $number) {
            $sum += ($number * intval($personalNoCleaned[$index]));
        }

        return $sum % $mod === 0;
    }

    /**
     * Returns personal number.
     *
     * @return string
     */
    public function getPN(): string {
        return $this->personalNo;
    }

    /**
     * Validates Month and Day integers to be within sane limits.
     * @return bool
     */
    protected function validateSaneValues(): bool {
        return $this->elements['month'] <= 12 && $this->elements['day'] <= 31;
    }
}
