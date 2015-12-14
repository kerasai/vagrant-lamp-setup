<?php

/**
 * Class LampTest.
 */
class LampTest extends PHPUnit_Framework_TestCase {

  protected $apacheVersion = 'Apache/2.4.7';
  protected $mysqlVersion = 'Ver 14.14 Distrib 5.6.27';
  protected $phpVersion = '5.5.9-1ubuntu4.14';

  public function testScripts() {
    foreach (array('increase_swap', 'mysqlcreate', 'write_vhost') as $item) {
      $this->assertTrue(file_exists('/usr/bin/' . $item), $item . ' script installed');
    }
  }

  public function testSwap() {
    $output = `free -m`;
    $this->assertContains('Swap:         2047', $output, 'swap configured');
  }

  public function testBasics() {
    foreach (array('git', 'curl', 'gzip', 'unzip') as $item) {
      $output = `$item --help`;
      $this->assertNotNull($output, "$item not installed.");
    }
  }

  public function testApache() {
    $output = `apache2 -v`;
    $this->assertNotNull($output, "apache2 not installed.");
    $this->assertContains("Server version: {$this->apacheVersion} (Ubuntu)", $output, "apache2 not at version {$this->apacheVersion}");

    $this->assertFalse(file_exists('/etc/apache2/sites-enabled/000-default.conf'), 'default site enabled');
    $this->assertFalse(file_exists('/etc/apache2/mods-enabled/php5.conf'), 'php5 conf enabled');
    $this->assertTrue(file_exists('/etc/apache2/mods-enabled/actions.conf'), 'actions mod enabled');
    $this->assertTrue(file_exists('/etc/apache2/mods-enabled/alias.conf'), 'alias mod enabled');
    $this->assertTrue(file_exists('/etc/apache2/mods-enabled/fastcgi.conf'), 'fastcgi mod enabled');
    $this->assertTrue(file_exists('/etc/apache2/mods-enabled/rewrite.load'), 'rewrite mod enabled');
    $this->assertTrue(file_exists('/etc/apache2/conf-enabled/php5-fpm.conf'), 'php5-fpm conf enabled');

    $this->assertContains('FastCgiExternalServer /usr/lib/cgi-bin/php5-fcgi -socket /var/run/php5-fpm.sock -idle-timeout 250 -pass-header Authorization', file_get_contents('/etc/apache2/conf-enabled/php5-fpm.conf'), 'php5-fpm configured');
  }

  public function testMySql() {
    $output = `mysql -h localhost -V`;
    $this->assertNotNull($output, "mysql not installed.");
    $this->assertContains(" {$this->mysqlVersion},", $output, "mysql not at version {$this->mysqlVersion}");
    $db = new PDO('mysql:host=localhost', 'root', 'root');
  }

  public function testPhp() {
    $output = `php -v`;
    $this->assertNotNull($output, "php5 not installed.");
    $this->assertContains(" {$this->phpVersion} ", $output, "php not at version {$this->phpVersion}");

    $this->assertTrue(extension_loaded('curl'), 'php5-curl installed');
    $this->assertTrue(extension_loaded('gd'), 'php5-gd installed');
    $this->assertTrue(extension_loaded('PDO'), 'php5-pdo installed');
    $this->assertTrue(extension_loaded('pdo_mysql'), 'php5-pdo_mysql installed');

    $this->assertTrue(file_exists('/etc/init/php5-fpm.override'), 'PHP5-FPM override file exists');
    $this->assertEquals("reload signal USR2\n", file_get_contents('/etc/init/php5-fpm.override'), 'PHP5-FPM override contents acceptable');

    $this->assertTrue(file_exists('/etc/php5/fpm/conf.d/00-core.ini'), 'php5 core.ini enabled');
    $this->assertTrue(file_exists('/etc/php5/fpm/conf.d/99-tweaks.ini'), 'php5 tweaks.ini enabled');

    $this->assertEquals(ini_get('variables_order'), 'EGPCS', 'php5 variable order set');
  }

}
