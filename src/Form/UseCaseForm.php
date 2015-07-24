<?php

/**
 * @file
 * Contains Drupal\helper\Form\UseCaseForm.
 */

namespace Drupal\helper\Form;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class UseCaseForm.
 *
 * @package Drupal\helper\Form
 */
class UseCaseForm extends EntityForm {
  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $use_case = $this->entity;
    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $use_case->label(),
      '#description' => $this->t("Label for the UseCase."),
      '#required' => TRUE,
    );

    $form['id'] = array(
      '#type' => 'machine_name',
      '#default_value' => $use_case->id(),
      '#machine_name' => array(
        'exists' => '\Drupal\helper\Entity\UseCase::load',
      ),
      '#disabled' => !$use_case->isNew(),
    );

    /**
     * Tech recs.
     */
    $tech_recs_inst = \Drupal::entityManager()->getStorage('tech_recs');
    $tech_recs = [];

    foreach ($tech_recs_inst->loadMultiple() as $tech_rec) {
      $id = $tech_rec->id();
      $label = $tech_rec->label();
      $tech_recs[$id] = $label;
    }

    $form['tech_recs'] = array(
      '#title' => 'Tech Recs',
      '#type' => 'checkboxes',
      '#options' => $tech_recs,
      '#default_value' => $use_case->getTechRecs(),
    );

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $use_case = $this->entity;
    $status = $use_case->save();

    if ($status) {
      drupal_set_message($this->t('Saved the %label UseCase.', array(
        '%label' => $use_case->label(),
      )));
    }
    else {
      drupal_set_message($this->t('The %label UseCase was not saved.', array(
        '%label' => $use_case->label(),
      )));
    }
    $form_state->setRedirectUrl($use_case->urlInfo('collection'));
  }

}
