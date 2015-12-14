<?php

/**
 * Class MongoTest.
 */
class MongoTest extends PHPUnit_Framework_TestCase {

  protected $mongodbVersion = 'MongoDB shell version: 3.0.7';
  protected $mongoExtensionVersion = 'ABOUT PECL.PHP.NET/MONGO-1.6.12';

  public function testMongo() {
    $output = `mongo --version`;
    $this->assertContains("$this->mongodbVersion\n", $output, 'mongodb installed');
  }

  public function testExtension() {
    $this->assertTrue(extension_loaded('mongo'), 'mongo php extension loaded');

    $output = `pecl info mongo`;
    $this->assertContains("$this->mongoExtensionVersion\n", $output, 'mongo php extension version 1.6.12');
  }

}
