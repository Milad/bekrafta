<?php

namespace Bekrafta;

use Exception;
use ReflectionClass;

class PersonalNumber {
    protected $personalNo;
    protected $bekrafta;

    public function __construct(string $personalNo) {
        $this->personalNo = $personalNo;
    }

    public function detect(): bool {
        $classes = $this->getList();

        foreach ($classes as $class) {
            $detection = new $class();
            if ($detection->validate($this->personalNo)) {
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
            throw new Exception("No format was detected.");
        }

        return $this->bekrafta->getCensored($this->personalNo);
    }

    public function getAge(string $today = 'today'): int {
        if ($this->bekrafta === null) {
            $this->detect();
        }

        if ($this->bekrafta === null) {
            throw new Exception("No format was detected.");
        }

        return $this->bekrafta->getAge($this->personalNo, $today);
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
