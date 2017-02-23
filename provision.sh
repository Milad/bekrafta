#!/usr/bin/env bash

apt-get update
echo "Installing curl / wget / nano"
apt-get install -y -qq curl wget nano

# Install PHP
echo "Installing PHP 7"
apt-get install -y -qq php php-cli

# Install composer
# https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-ubuntu-16-04
echo "Installing composer"
apt-get install -y -qq curl php-cli php-mbstring git unzip
curl -sS https://getcomposer.org/installer -o ~/composer-setup.php
php ~/composer-setup.php --install-dir=/usr/local/bin --filename=composer
rm ~/composer-setup.php

# Install PHPUnit / PHPMD / PHP_CodeSniffer
echo "Installing PHPUnit / PHPMD / PHP_CodeSniffer"
curl -Ls https://phar.phpunit.de/phpunit-6.0.phar -o phpunit.phar
curl -Ls http://static.phpmd.org/php/latest/phpmd.phar -o phpmd.phar
curl -Ls https://squizlabs.github.io/PHP_CodeSniffer/phpcs.phar -o phpcs.phar
curl -Ls https://squizlabs.github.io/PHP_CodeSniffer/phpcbf.phar -o phpcbf.phar
chmod +x php*.phar
for f in *.phar; do mv $f /usr/local/bin/`basename $f .phar`; done;
