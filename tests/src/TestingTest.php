<?php

/**
 * Class TestingTest.
 */
class TestingTest extends PHPUnit_Framework_TestCase {

  protected $javaVersion = '1.7.0_91';

  public function testSelenium() {
    $this->assertTrue(file_exists('/usr/lib/selenium/selenium-server.jar'), 'selenium installed');
    $output = `service selenium status`;
    $this->assertEquals("Usage: /etc/init.d/selenium {start|stop|restart}\n", $output, 'selenium service installed');
  }

  public function testXvfb() {
    $output = `which firefox`;
    $this->assertEquals("/usr/bin/firefox\n", $output, 'firefox installed');

    $output = `which Xvfb`;
    $this->assertEquals("/usr/bin/Xvfb\n", $output, 'Xvfb installed');

    $output = `service xvfb status`;
    $this->assertEquals("Usage: /etc/init.d/xvfb {start|stop|restart}\n", $output, 'selenium service installed');
  }

}
