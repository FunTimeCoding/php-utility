@echo off
for /F "tokens=* USEBACKQ" %%F IN (`vagrant ssh --command /vagrant/script/vagrant/show-address.sh`) DO SET address=%%F
start "" http://%address%
