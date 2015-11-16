# vagrant-lamp-setup

## Introduction

The scripts contained in this repository configure a generic LAMP stack and a few development utilities onto a Unbuntu Trusty Tahr based Vagrant box. The resulting box is to be repackaged in order to be used as a base box which can be tweaked and reused by numerous developers for numerous projects.

## Box Information

Base Box: Ubuntu 14.04 (ubuntu/trusty64)

LAMP stack:
* Apache 2.4
* PHP 5.5.9
* MySQL 5.6

Test suite:
* Firefox
* Selenium server
* Xvfb

Management utilities:
* PhpMyAdmin
* OpCache GUI
* XHProf

Misc:
* Composer
* Drush

Optional installations:
* Apache Solr
* Memcached
* MongoDB

## Packaging the box

Initialize the box using the included Vagrantfile and log in.

```bash
vagrant up
vagrant ssh
```

From the VM as root, copy the setup files, and run the setup.

```bash
cp -R /vagrant /setup
cd /setup
./setup
```

From the VM, tidy up the VM ():

```bash
apt-get clean
dd if=/dev/zero of=/EMPTY bs=1M
rm -f /EMPTY
cat /dev/null > ~/.bash_history && history -c
```

From the host machine, package the box:

```bash
vagrant package --output lamp.box
```
