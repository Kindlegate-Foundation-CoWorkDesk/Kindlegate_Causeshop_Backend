<?php
namespace Drupal\kindlegate\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Defines the Cart entity.
 *
 * @ContentEntityType(
 *   id = "cart",
 *   label = @Translation("Cart"),
 *   base_table = "cart",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *   },
 * )
 */
class Cart extends ContentEntityBase {

  // Define fields for the cart entity as needed.
  
}
