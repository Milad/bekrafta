<?php
/*
88""Yb 888888 88  dP 88""Yb    db    888888 888888    db
88__dP 88__   88odP  88__dP   dPYb   88__     88     dPYb
88""Yb 88""   88"Yb  88"Yb   dP__Yb  88""     88    dP__Yb
88oodP 888888 88  Yb 88  Yb dP""""Yb 88       88   dP""""Yb
*/

namespace Bekrafta;

use Exception;
use ReflectionClass;

class PersonalNumber {
    /**
     * @var string
     */
    protected $personalNo;

    /**
     * @var BekraftaAbstract
     */
    protected $bekrafta;

    /**
     * @var string
     */
    protected $exceptionMessage = "No format was detected.";

    public function __construct(string $personalNo) {
        $this->personalNo = $personalNo;
    }

    public function detect(): bool {
        $classes = $this->getList();

        foreach ($classes as $class) {
            $detection = new $class($this->personalNo);
            if ($detection->validate()) {
                $this->bekrafta = $detection;
                return true;
            }
        }

        return false;
    }

    public function getCensored(): string {
        if ($this->bekrafta === null) {
            $this->detect();
        }

        if ($this->bekrafta === null) {
            throw new Exception($this->exceptionMessage);
        }

        return $this->bekrafta->getCensored();
    }

    public function getBirthday(): string {
        if ($this->bekrafta === null) {
            $this->detect();
        }

        if ($this->bekrafta === null) {
            throw new Exception($this->exceptionMessage);
        }

        return $this->bekrafta->getBirthday();
    }

    public function getAge(string $today = 'today'): int {
        if ($this->bekrafta === null) {
            $this->detect();
        }

        if ($this->bekrafta === null) {
            throw new Exception($this->exceptionMessage);
        }

        return $this->bekrafta->getAge($today);
    }

    public function getGender(): string {
        if ($this->bekrafta === null) {
            $this->detect();
        }

        if ($this->bekrafta === null) {
            throw new Exception($this->exceptionMessage);
        }

        return $this->bekrafta->getGender();
    }

    public function getYear(): string {
        if ($this->bekrafta === null) {
            $this->detect();
        }

        if ($this->bekrafta === null) {
            throw new Exception($this->exceptionMessage);
        }

        return $this->bekrafta->getYear();
    }

    protected function getList(): array {
        $classes = [];

        $scan = scandir(__DIR__ . '/../src');

        foreach ($scan as $filename) {
            if ($filename === '.' || $filename === '..') {
                continue;
            }

            $className = str_replace('.php', '', $filename);
            $classPath = "Bekrafta\\$className";

            $reflection = new ReflectionClass($classPath);

            if ($reflection->isAbstract() || !$reflection->isSubclassOf('Bekrafta\\BekraftaAbstract')) {
                continue;
            }

            $classes[] = $classPath;
        }

        return $classes;
    }
}
