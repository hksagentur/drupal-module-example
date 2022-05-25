<?php

namespace Drupal\module_example\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure module settings.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritDoc}
   */
  public function getFormId() {
    return 'module_example_settings';
  }

  /**
   * {@inheritDoc}
   */
  protected function getEditableConfigNames() {
    return [
      'module_example.settings',
    ];
  }

  /**
   * Get the available options for the cache duration field.
   *
   * @return int[]
   *   The
   */
  protected function getCacheDurations() {
    return array_map(function ($duration) {
      return $this->formatPlural($duration, '@duration hour', '@duration hours', ['@duration' => $duration]);
    }, [3600, 21600, 43200, 86400]);
  }

  /**
   * {@inheritDoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('module_example.settings');

    $form['caching'] = [
      '#type' => 'details',
      '#title' => $this->t('Caching'),
      '#open' => TRUE,
    ];

    $form['caching']['cache_maximum_age'] = [
      '#type' => 'select',
      '#title' => $this->t('Duration'),
      '#description' => $this->t('This is used as the value for max-age in the cache tags of a quote.'),
      '#options' => $this->getCacheDurations(),
      '#default_value' => $config->get('cache_duration'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('module_example.settings')
      ->set('cache_duration', $form_state->getValue('cache_maximum_age'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
