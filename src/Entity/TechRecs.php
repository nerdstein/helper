<?php

/**
 * @file
 * Contains Drupal\helper\Entity\TechRecs.
 */

namespace Drupal\helper\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\helper\TechRecsInterface;

/**
 * Defines the TechRecs entity.
 *
 * @ConfigEntityType(
 *   id = "tech_recs",
 *   label = @Translation("TechRecs"),
 *   handlers = {
 *     "list_builder" = "Drupal\helper\Controller\TechRecsListBuilder",
 *     "form" = {
 *       "add" = "Drupal\helper\Form\TechRecsForm",
 *       "edit" = "Drupal\helper\Form\TechRecsForm",
 *       "delete" = "Drupal\helper\Form\TechRecsDeleteForm"
 *     }
 *   },
 *   config_prefix = "tech_recs",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/tech_recs/{tech_recs}",
 *     "edit-form" = "/admin/tech_recs/{tech_recs}/edit",
 *     "delete-form" = "/admin/tech_recs/{tech_recs}/delete"
 *   }
 * )
 */
class TechRecs extends ConfigEntityBase implements TechRecsInterface {
  /**
   * The TechRecs ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The TechRecs label.
   *
   * @var string
   */
  protected $label;

  /**
   * The TechRecs description.
   *
   * @var string
   */
  protected $description;

  /**
   * Returning the description for the tech rec.
   *
   * return @var string
   */
  public function getDescription(){
    return $this->description;
  }

}
