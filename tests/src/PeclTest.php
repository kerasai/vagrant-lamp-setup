<?php

/**
 * Class PeclTest.
 */
class PeclTest extends PHPUnit_Framework_TestCase {

  public function testPecl() {
    $output = `which pecl`;
    $this->assertEquals("/usr/bin/pecl\n", $output, 'pecl installed');
  }

}
