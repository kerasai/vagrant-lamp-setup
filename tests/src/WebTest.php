<?php

/**
 * Class WebTest.
 */
class WebTest extends PHPUnit_Framework_TestCase {

  public function testWeb() {
    $this->assertTrue(file_exists('/var/www/web'), 'web folder exists');
    $this->assertContains('alias web="cd /var/www/web"', file_get_contents('/root/.bashrc'));
    $this->assertTrue(file_exists('/etc/apache2/sites-enabled/web.conf'), 'web site enabled');

    file_put_contents('/var/www/web/test.html', 'hello world!');
    $this->assertContains('hello world!', file_get_contents('http://localhost/test.html'), 'web response is appropriate');
    unlink('/var/www/web/test.html');
  }

}
