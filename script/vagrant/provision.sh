#!/bin/sh -e

export DEBIAN_FRONTEND=noninteractive
apt-get --quiet 2 install apt-transport-https
wget --no-verbose --output-document /etc/apt/trusted.gpg.d/sury.gpg https://packages.sury.org/php/apt.gpg
echo "deb https://packages.sury.org/php stretch main" > /etc/apt/sources.list.d/sury.list
apt-get --quiet 2 update

# Set timezone for PHP.
echo Europe/Berlin > /etc/timezone
dpkg-reconfigure --frontend noninteractive tzdata

# Install tools for the user.
apt-get --quiet 2 install neovim multitail htop git tree

# Dependencies for check.sh.
apt-get --quiet 2 install hunspell shellcheck

apt-get --quiet 2 install php-cli php-fpm php-xdebug php-xml php-mbstring php-zip
cp /vagrant/configuration/xdebug.ini /etc/php/7.2/mods-available/xdebug.ini
systemctl restart php7.2-fpm

apt-get --quiet 2 install nginx-light
cp /vagrant/configuration/site.conf /etc/nginx/sites-available/default
systemctl restart nginx

# Let vagrant user read web server logs.
usermod --append --groups adm vagrant

# Download Composer manually because the Debian package depends on PHP 7.0.
wget --no-verbose --output-document /usr/local/bin/composer https://getcomposer.org/download/1.6.3/composer.phar
chmod +x /usr/local/bin/composer

cp /vagrant/configuration/php-utility.yaml /home/vagrant/.php-utility.yaml
chown vagrant:vagrant /home/vagrant/.php-utility.yaml
