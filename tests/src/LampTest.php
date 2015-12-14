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
  }

}
