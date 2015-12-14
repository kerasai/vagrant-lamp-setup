<?php

/**
 * Class DashboardTest.
 */
class DashboardTest extends PHPUnit_Framework_TestCase {

  protected $phpmyadminVersion = 'Version 4.4.14.1';

  public function testPhpInfo() {
    $this->assertTrue(file_exists('/var/www/dashboard/phpinfo.php'), 'phpinfo file exists');
    $this->assertContains('phpinfo();', file_get_contents('/var/www/dashboard/phpinfo.php'), 'phpinfo file contains phpinfo');
  }

  public function testPhpMyAdmin() {
    $this->assertTrue(file_exists('/var/www/dashboard/phpmyadmin'), 'phpmyadmin exists');
    $this->assertTrue(file_exists('/var/www/dashboard/phpmyadmin/config.inc.php'), 'phpmyadmin config exists');
    $this->assertFalse(file_exists('/var/www/dashboard/phpMyAdmin-4.4.14.1-english.tar.gz'), 'phpmyadmin tarball exists');
    $this->assertContains("\n{$this->phpmyadminVersion}\n", file_get_contents('/var/www/dashboard/phpmyadmin/README'), 'phpmyadmin at version 4.4.14.1');
  }

  public function testOpcacheGui() {
    $this->assertTrue(file_exists('/var/www/dashboard/opcache-gui'), 'opcache-gui exists');
  }

  public function testHttp() {
    $links = array(
      'phpinfo' => '<a href="phpinfo.php">phpinfo.php</a>',
      'phpmyadmin' => '<a href="phpmyadmin/">phpmyadmin/</a>',
      'opcache-gui' => '<a href="opcache-gui/">opcache-gui/</a>',
    );

    $html = file_get_contents('http://localhost:8081');
    foreach ($links as $item => $markup) {
      $this->assertContains($markup, $html, $item . ' link present');
    }

  }

  public function testAlias() {
    $this->assertContains('alias dashboard="cd /var/www/dashboard"', file_get_contents('/root/.bashrc'));
  }

}
