# Bekräfta [![Build Status](https://travis-ci.org/Milad/bekrafta.svg?branch=master)](https://travis-ci.org/Milad/bekrafta)
[Bekräfta](https://en.wiktionary.org/wiki/bekr%C3%A4fta#Swedish): A PHP Library to Validate Personal Numbers

### Supported Countries
- Finland
- Norway
- Sweden

### Supported PHP Versions
- PHP 7.0
- PHP 7.1
- PHP 7.2

### Installation
```
composer require miladk/bekrafta
```

### Usage
This library offers one interface for all supported countries. Developers don't have to use specific countries' classes, instead there is one class that detects and uses the country and serves the appropriate values.

```php
use Bekrafta\PersonalNumber;

$oPN = new PersonalNumber('811228-9874');

// True on successful detection, false otherwise.
// True also means a valid personal number.
$oPN->detect();

// 811228-****
$oPN->getCensored();

// 35
$oPN->getAge();

// m
$oPN->getGender();
```

Or you can use a specific country if you only need that.

```php
use Bekrafta\Sweden;

$oSweden = new Sweden();

// True on valid personal number, false otherwise.
$oSweden->validate('811228-9874');

// 811228-****
$oSweden->getCensored('811228-9874');

 // 35
$oSweden->getAge('811228-9874');

 // m
$oSweden->getGender('811228-9874');
```

### License
MIT