<?php

namespace Drupal\module_example;

/**
 * Defines a custom service to get an inspiring quote.
 */
class Inspiring {

  /**
   * The collection of quotes to select from.
   *
   * @var string[]
   */
  protected $quotes;

  /**
   * Create a new class of the Inspiring class.
   *
   * @param string[] $quotes
   *   The collection of quotes to select from.
   */
  public function __construct(array $quotes) {
    $this->quotes = $quotes;
  }

  /**
   * Get an inspiring quote.
   *
   * @return string
   *   A random quote from the source collection.
   */
  public function quote() {
    return $this->quotes[array_rand($this->quotes)];
  }

}
