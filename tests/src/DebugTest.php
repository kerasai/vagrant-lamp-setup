<?php

/**
 * Class DebugTest.
 */
class DebugTest extends PHPUnit_Framework_TestCase {

  public function testExtensions() {
    $this->assertTrue(extension_loaded('xdebug'), 'xdebug extension loaded');
    $this->assertTrue(extension_loaded('xhprof'), 'xhprof extension loaded');
  }

  public function testConfig() {
    $this->assertTrue(file_exists('/etc/php5/fpm/conf.d/90-debug.ini'), 'xdebug configured');
    $this->assertTrue(file_exists('/etc/php5/fpm/conf.d/20-xhprof.ini'), 'xhprof configured');
  }

  public function testXhprof() {
    $this->assertTrue(file_exists('/var/www/dashboard/xhprof'), 'xdebug configured');
  }

}
