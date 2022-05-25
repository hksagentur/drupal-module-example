<?php

namespace Drupal\Tests\module_example\Unit;

use Drupal\module_example\Inspiring;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\module_example\Inspiring
 * @group module_example
 */
class InspiringTest extends UnitTestCase {

  /**
   * The inspiring service.
   *
   * @var \Drupal\module_example\Inspiring
   */
  protected $inspiring;

  /**
   * {@inheritDoc}
   */
  public function setUp(): void {
    $this->inspiring = new Inspiring(['foo', 'bar', 'baz']);
  }

  /**
   * @covers ::quote
   */
  public function testGetRandomQuote() {
    $quote = $this->inspiring->quote();

    $this->assertTrue(in_array($quote, ['foo', 'bar', 'baz']));
  }

}
