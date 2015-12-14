<?php

/**
 * Class SolrTest.
 */
class SolrTest extends PHPUnit_Framework_TestCase {

  public function testInstall() {
    $this->assertTrue(file_exists('/usr/lib/solr/solr-5.3.1'), 'solr installed');
    $this->assertFalse(file_exists('/usr/lib/solr/solr-5.3.1.tgz'), 'solr tarball exists');

    $output = `service solr status`;
    $this->assertEquals("Usage: /etc/init.d/solr {start|stop|restart}\n", $output, 'solr service installed');
  }

  public function testCore() {
    $this->assertTrue(file_exists('/usr/lib/solr/solr-5.3.1/server/solr/drupal'), 'solr core "drupal" files installed');
    $output = file_get_contents('http://localhost:8983/solr/drupal/get');
    $this->assertEquals("{}\n", $output, 'solr responds to queries for "drupal" core');
  }

}
