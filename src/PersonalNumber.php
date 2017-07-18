<?php

namespace Bekrafta;

use Exception;
use ReflectionClass;

class PersonalNumber {
    private $personalNo;
    private $bekrafta;

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

    public function getCensored() {
        if ($this->bekrafta === null) {
            throw new Exception("No format was detected. Have you forgot to call detect()?");
        }

        return $this->bekrafta->getCensored($this->personalNo);
    }

    private function getList(): array {
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
