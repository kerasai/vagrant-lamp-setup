# -*- mode: ruby -*-
# vi: set ft=ruby :

# This Vagrantfile is for creating the lamp.box
# vagrant box file.

# Required plugins:
# - vagrant plugin install vagrant-auto_network
# - vagrant plugin install vagrant-hostmanager
# - vagrant plugin install vagrant-vbguest

Vagrant.configure(2) do |config|
  config.vm.box = "ubuntu/xenial64"

  config.vm.network :private_network, :auto_network => true

  config.vm.hostname = "lamp.local"
  config.hostmanager.enabled = true
  config.hostmanager.manage_host = true
  config.hostmanager.manage_guest = true
  config.hostmanager.aliases = %w(lamp.local)

  # Sites directory.
  config.vm.synced_folder "sites", "/sites", type: :nfs, create: true

  # General vagrant share.
  config.vm.synced_folder "./vagrant", "/vagrant", create: true

  config.vm.provision "ansible" do |ansible|
    ansible.playbook = "provisioning/playbook.yml"
    ansible.groups = {
      "lamp" => ["default"],
      "develop_drupal" => ["default"],
    }
  end

  config.vm.provider "virtualbox" do |vb|
    # Display the VirtualBox GUI when booting the machine
    # vb.gui = true

    # Customize the amount of memory on the VM:
    vb.memory = "2048"
  end
end
