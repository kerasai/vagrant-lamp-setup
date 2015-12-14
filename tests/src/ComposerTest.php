<?php

/**
 * Class ComposerTest.
 */
class ComposerTest extends PHPUnit_Framework_TestCase {

  public function testComposer() {
    $output = `which composer`;
    $this->assertEquals("/usr/local/bin/composer\n", $output, 'composer installed');
  }

}
