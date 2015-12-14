<?php

/**
 * Class MemcachedTest.
 */
class MemcachedTest extends PHPUnit_Framework_TestCase {

  protected $memcachedVersion = 'memcached 1.4.14';
  protected $memcacheExtensionVersion = 'ABOUT PECL.PHP.NET/MEMCACHE-3.0.8';

  public function testMemcached() {
    $output = `memcached -h`;
    $this->assertContains("$this->memcachedVersion\n", $output, 'memcached installed');
  }

  public function testExtension() {
    $this->assertTrue(extension_loaded('memcache'), 'memcache php extension loaded');

    $output = `pecl info memcache`;
    $this->assertContains("$this->memcacheExtensionVersion\n", $output, 'memcache php extension version 3.0.8');
  }

}
