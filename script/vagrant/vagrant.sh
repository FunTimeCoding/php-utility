#!/bin/sh -e

cp /vagrant/configuration/inputrc.txt /home/vagrant/.inputrc

mkdir -p /home/vagrant/tmp

if [ ! -f /home/vagrant/tmp/mediawiki-1.33.0.tar.gz ]; then
    wget --output-document /home/vagrant/tmp/mediawiki-1.33.0.tar.gz https://releases.wikimedia.org/mediawiki/1.33/mediawiki-1.33.0.tar.gz
fi

mkdir -p /home/vagrant/opt/mediawiki-1.33.0

if [ ! -f /home/vagrant/opt/mediawiki-1.33.0/README ]; then
    tar --extract --file /home/vagrant/tmp/mediawiki-1.33.0.tar.gz -C /home/vagrant/opt/mediawiki-1.33.0 --strip-components 1
fi

ln --symbolic --force /home/vagrant/opt/mediawiki-1.33.0 /home/vagrant/opt/mediawiki

ADDRESS=$(/vagrant/script/vagrant/show-address.sh)

if [ ! -f /vagrant/tmp/password.txt ]; then
    /vagrant/script/generate-key.php 5 /vagrant/tmp/password.txt
fi

PASSWORD=$(cat /vagrant/tmp/password.txt)

sed --in-place "s/LOCATOR/${ADDRESS}:8080/g" /home/vagrant/.php-utility.yaml
sed --in-place "s/PASSWORD/${PASSWORD}/g" /home/vagrant/.php-utility.yaml

php /home/vagrant/opt/mediawiki-1.33.0/maintenance/install.php --confpath /home/vagrant/opt/mediawiki-1.33.0 --dbname mediawiki --dbuser mediawiki --dbpass mediawiki --pass "${PASSWORD}" --server "http://${ADDRESS}:8080" --scriptpath '' ExampleWiki Admin

git clone https://github.com/adsr/phpspy tmp/phpspy
cd tmp/phpspy
make
