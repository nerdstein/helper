<?php

/**
 * @file
 * Contains Drupal\helper\Form\HelperForm.
 */

namespace Drupal\helper\Form;

//use Drupal\Core\Entity\ContentEntityConfirmFormBase;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class HelperForm.
 *
 * @package Drupal\helper\Form
 */
class HelperForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'helper_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $use_cases_inst = \Drupal::entityManager()->getStorage('use_case');
    $use_cases = [];

    foreach ($use_cases_inst->loadMultiple() as $uc) {
      $id = $uc->id();
      $label = $uc->label();
      $use_cases[$id] = $label;
    }

    $rec_inst = \Drupal::entityManager()->getStorage('tech_recs');
    $recs_rows = [];

    foreach ($rec_inst->loadMultiple() as $rec) {
      $id = $rec->id();
      $label = $rec->label();
      $recs_rows[] = array(
        'yes',
        $label,
        $rec->getDescription(),
      );
    }

    $form['acquia_security_use_cases'] = array(
      '#type' => 'checkboxes',
      '#title' => $this->t('Acquia Security Use Cases'),
      '#description' => $this->t(''),
      '#options' => $use_cases,
      /*'#ajax' => array(

      ),*/
    );
    $form['hardware_and_software_recommendations'] = array(
      '#type' => 'table',
      '#title' => $this->t('Hardware and software recommendations'),
      '#header' => array(
        t('Required'),
        t('Name'),
        t('Description'),
      ),
      '#rows' => $recs_rows,
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    //parent::submitForm($form, $form_state);
  }

}
