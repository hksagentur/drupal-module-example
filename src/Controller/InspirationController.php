<?php

namespace Drupal\module_example\Controller;

use Drupal\Core\Config\Config;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\module_example\Inspiring;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines a controller that renders an inspiring quote.
 */
class InspirationController implements ContainerInjectionInterface {

  /**
   * The module configuration.
   *
   * @var \Drupal\Core\Config\Config
   */
  protected $config;

  /**
   * The inspiring quote service.
   *
   * @var \Drupal\module_example\Inspiring
   */
  protected $inspiring;

  /**
   * Create a new instance of the QuoteController class.
   *
   * @param \Drupal\Core\Config\Config $config
   *   The module configuration.
   * @param \Drupal\module_example\Inspiring $inspiring
   *   The inspiring quote service.
   */
  public function __construct(Config $config, Inspiring $inspiring) {
    $this->config = $config;
    $this->inspiring = $inspiring;
  }

  /**
   * {@inheritDoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory')->get('module_example.settings'),
      $container->get('module_example.inspiring')
    );
  }

  /**
   * Display an inspiring quote.
   *
   * @return array
   *   A render array representing the page content.
   */
  public function inspire() {
    return [
      '#theme' => 'inspiring_quote',
      '#quote' => $this->inspiring->quote(),
      '#cache' => [
        'max-age' => $this->config->get('cache_duration'),
      ],
    ];
  }

}
