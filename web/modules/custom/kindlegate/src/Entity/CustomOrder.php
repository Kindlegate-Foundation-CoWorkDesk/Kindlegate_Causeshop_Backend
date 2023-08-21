<?php

namespace Drupal\kindlegate\Entity;

use Drupal\commerce_order\Entity\Order;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the custom Order entity.
 *
 * @ContentEntityType(
 *   id = "custom_order",
 *   label = @Translation("Custom Order"),
 *   base_table = "commerce_order",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *   },
 *   handlers = {
 *     "list_builder" = "Drupal\your_module\OrderListBuilder",
 *     "form" = {
 *       "default" = "Drupal\your_module\Form\CustomOrderForm",
 *     },
 *     "views_data" = "Drupal\your_module\CustomOrderViewsData",
 *   },
 * )
 */
class CustomOrder extends Order {

  // Define any custom fields or methods here if needed.

}
