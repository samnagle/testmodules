<?php

namespace Drupal\Tests\salesforce\Unit;

use Drupal\Tests\UnitTestCase;
use Drupal\salesforce\SFID;

/**
 * Test Object instantitation.
 *
 * @group salesforce_pull
 */
class SFIDTest extends UnitTestCase {

  /**
   * Required modules.
   *
   * @var array
   */
  static public $modules = ['salesforce'];

  /**
   * Test object instantiation with good ID.
   */
  public function testGoodId() {
    $sfid = new SFID('1234567890abcde');
    $this->assertTrue($sfid instanceof SFID);
  }

  /**
   * Test object instantiation with bad ID.
   */
  public function testBadId() {
    $this->expectException(\Exception::class);
    new SFID('1234567890');
  }

  /**
   * Test object instantiation with bad ID.
   */
  public function testConvertId() {
    $sfid = new SFID('1234567890adcde');
    $this->assertEquals('1234567890adcdeAAA', $sfid);
  }

}
