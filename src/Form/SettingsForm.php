<?php

/**
 * @file
 * Contains \Drupal\fivestar\Form\SettingsForm.
 */

namespace Drupal\fivestar\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

/**
 * Configures fivestar settings.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'fivestar_settings_form';
  }

  protected function getEditableConfigNames() {
    return ['fivestar.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('fivestar.settings');
    $form['tags'] = array(
      '#tree' => FALSE,
      '#type' => 'fieldset',
      '#title' => t('Voting tags'),
      '#description' => t('Choose the voting tags that will be available for node rating. A tag is simply a category of vote. If you only need to rate one thing per node, leave this as the default "vote".'),
      '#weight' => 3,
    );

    $form['tags']['tags'] = array(
      '#type' => 'textfield',
      '#title' => t('Tags'),
      '#default_value' => $config->get('tags', 'vote'),
      '#required' => TRUE,
      '#description' => t('Separate multiple tags with commas.'),
    );
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    $config = $this->config('fivestar.settings');
    $config->set('tags', $form_state->getValue(array('tags', 'tags')));
    $config->save();
  }

}
