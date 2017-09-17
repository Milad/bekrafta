#!/usr/bin/env bash

echo "Installing PHPUnit / PHPMD / PHP_CodeSniffer"
composer global require phpunit/phpunit squizlabs/PHP_CodeSniffer phpmd/phpmd
echo "PATH=\"\$HOME/.config/composer/vendor/bin:\$PATH\"" >> /home/ubuntu/.profile
