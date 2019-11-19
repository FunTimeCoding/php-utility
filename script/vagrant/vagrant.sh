#!/bin/sh -e

if [ ! -f /home/vagrant/.ssh/id_rsa ]; then
    ssh-keygen -C vagrant@localhost -N '' -f /home/vagrant/.ssh/id_ansible
    cat /home/vagrant/.ssh/id_ansible.pub >>/home/vagrant/.ssh/authorized_keys
    sudo mkdir --parents --mode 700 /root/.ssh
    sudo cp /home/vagrant/.ssh/id_ansible.pub /root/.ssh/authorized_keys
    sudo chmod 600 /root/.ssh/authorized_keys
fi

if [ -d /vagrant/tmp/ssh ]; then
    cp /vagrant/tmp/ssh/id_rsa /home/vagrant/.ssh/id_rsa
    chmod 600 /home/vagrant/.ssh/id_rsa
    cp /vagrant/tmp/ssh/id_rsa.pub /home/vagrant/.ssh/id_rsa.pub
    chmod -x /home/vagrant/.ssh/id_rsa.pub
fi

cp /vagrant/configuration/ssh.txt /home/vagrant/.ssh/config
chmod -x /home/vagrant/.ssh/config
cp /vagrant/configuration/inputrc.txt /home/vagrant/.inputrc
chmod -x /home/vagrant/.inputrc
cp /vagrant/configuration/profile.sh /home/vagrant/.profile
chmod -x /home/vagrant/.profile
cp /vagrant/configuration/aliases.sh /home/vagrant/.aliases
chmod -x /home/vagrant/.aliases

if [ -f /vagrant/tmp/gitconfig.txt ]; then
    cp /vagrant/tmp/gitconfig.txt /home/vagrant/.gitconfig
    chmod -x /home/vagrant/.gitconfig
fi

if [ -f /vagrant/tmp/gitignore_global.txt ]; then
    cp /vagrant/tmp/gitignore_global.txt /home/vagrant/.gitignore_global
    chmod -x /home/vagrant/.gitignore_global
fi

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
