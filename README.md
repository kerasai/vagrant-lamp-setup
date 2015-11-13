# vagrant-lamp-setup

## Packaging the box

Tidy up the VM:

```bash
apt-get clean
dd if=/dev/zero of=/EMPTY bs=1M
rm -f /EMPTY
cat /dev/null > ~/.bash_history && history -c && exit
```

Package the box:

```bash
vagrant package --output lamp.box
```
