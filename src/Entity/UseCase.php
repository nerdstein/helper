<?php

/**
 * @file
 * Contains Drupal\helper\Entity\UseCase.
 */

namespace Drupal\helper\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\helper\UseCaseInterface;

/**
 * Defines the UseCase entity.
 *
 * @ConfigEntityType(
 *   id = "use_case",
 *   label = @Translation("UseCase"),
 *   handlers = {
 *     "list_builder" = "Drupal\helper\Controller\UseCaseListBuilder",
 *     "form" = {
 *       "add" = "Drupal\helper\Form\UseCaseForm",
 *       "edit" = "Drupal\helper\Form\UseCaseForm",
 *       "delete" = "Drupal\helper\Form\UseCaseDeleteForm"
 *     }
 *   },
 *   config_prefix = "use_case",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/use_case/{use_case}",
 *     "edit-form" = "/admin/use_case/{use_case}/edit",
 *     "delete-form" = "/admin/use_case/{use_case}/delete"
 *   }
 * )
 */
class UseCase extends ConfigEntityBase implements UseCaseInterface {
  /**
   * The UseCase ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The UseCase label.
   *
   * @var string
   */
  protected $label;

  /**
   * The tech requirements.
   *
   * @var TechnicalRecommendation
   */
  protected $techRecs;

  /**
   * Get Tech Recs.
   *
   * return @array
   */
  public function getTechRecs(){
    return $this->techRecs;
  }

}
