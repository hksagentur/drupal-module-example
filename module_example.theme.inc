<?php

/**
 * @file
 * Prepare variables for the custom templates.
 */

/**
 * Prepares variables for an inspiring quote.
 *
 * Default template: inspiring-quote.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - quote: The text of the quote including the source.
 */
function template_preprocess_inspiring_quote(array &$variables) {
  /** @var string */
  $quote = $variables['quote'];

  // Try to separate the source from the rest of the quote.
  $position = mb_strrpos($quote, '—');

  if ($position !== FALSE) {
    $variables['quote'] = mb_substr($quote, 0, $position);
    $variables['source'] = mb_substr($quote, $position + 1);
  }
}
