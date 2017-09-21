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
        return checkdate($this->elements['month'], $this->elements['day'], $this->getYear());
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
    abstract public function getGender(): string;
}
