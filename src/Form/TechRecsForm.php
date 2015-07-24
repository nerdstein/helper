<?php

/**
 * @file
 * Contains Drupal\helper\Form\TechRecsForm.
 */

namespace Drupal\helper\Form;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class TechRecsForm.
 *
 * @package Drupal\helper\Form
 */
class TechRecsForm extends EntityForm {
  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $tech_recs = $this->entity;
    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $tech_recs->label(),
      '#description' => $this->t("Label for the TechRecs."),
      '#required' => TRUE,
    );

    $form['id'] = array(
      '#type' => 'machine_name',
      '#default_value' => $tech_recs->id(),
      '#machine_name' => array(
        'exists' => '\Drupal\helper\Entity\TechRecs::load',
      ),
      '#disabled' => !$tech_recs->isNew(),
    );

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $tech_recs = $this->entity;
    $status = $tech_recs->save();

    if ($status) {
      drupal_set_message($this->t('Saved the %label TechRecs.', array(
        '%label' => $tech_recs->label(),
      )));
    }
    else {
      drupal_set_message($this->t('The %label TechRecs was not saved.', array(
        '%label' => $tech_recs->label(),
      )));
    }
    $form_state->setRedirectUrl($tech_recs->urlInfo('collection'));
  }

}
