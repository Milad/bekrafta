#!/usr/bin/env bash

apt-get update -qq
apt-get upgrade -y -qq
echo "Installing curl / wget / nano / php"
apt-get install -y -qq curl wget git nano unzip php php-cli php-xdebug php-xml php-mbstring

# Install composer
# https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-ubuntu-16-04
echo "Installing composer"
curl -sS https://getcomposer.org/installer -o /home/ubuntu/composer-setup.php
php /home/ubuntu/composer-setup.php --install-dir=/usr/local/bin --filename=composer
rm /home/ubuntu/composer-setup.php

# Install PHPUnit / PHPMD / PHP_CodeSniffer
#curl -Ls https://phar.phpunit.de/phpunit-6.0.phar -o phpunit.phar
#curl -Ls http://static.phpmd.org/php/latest/phpmd.phar -o phpmd.phar
#curl -Ls https://squizlabs.github.io/PHP_CodeSniffer/phpcs.phar -o phpcs.phar
#curl -Ls https://squizlabs.github.io/PHP_CodeSniffer/phpcbf.phar -o phpcbf.phar
#chmod +x php*.phar
#for f in *.phar; do mv $f /usr/local/bin/`basename $f .phar`; done;
