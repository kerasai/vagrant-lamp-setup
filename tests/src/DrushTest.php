<?php

/**
 * Class DrushTest.
 */
class DrushTest extends PHPUnit_Framework_TestCase {

  public function testDrush() {
    $output = `which drush`;
    $this->assertEquals("/root/.composer/vendor/bin/drush\n", $output, 'composer installed');
  }

}
