<?php

namespace Drupal\kindlegate\Entity;

use Drupal\commerce_product\Entity\Product as CommerceProduct;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Field\FieldStorageDefinitionInterface;

/**
 * Defines the custom Product entity.
 *
 * @ContentEntityType(
 *   id = "custom_product",
 *   label = @Translation("Custom Product"),
 *   base_table = "commerce_product",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *   },
 *   handlers = {
 *     "list_builder" = "Drupal\your_module\ProductListBuilder",
 *     "form" = {
 *       "add" = "Drupal\your_module\Form\ProductForm",
 *       "edit" = "Drupal\your_module\Form\ProductForm",
 *       "delete" = "Drupal\your_module\Form\ProductDeleteForm",
 *     },
 *   },
 * )
 */
class Product extends CommerceProduct {
/**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    // Define additional fields here.
    $fields['body'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Body'))
      ->setDescription(t('The product description.'))
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'text_default',
        'weight' => -3,
      ])
      ->setDisplayOptions('form', [
        'type' => 'text_textarea',
        'weight' => -3,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['field_price'] = BaseFieldDefinition::create('commerce_price')
      ->setLabel(t('Price'))
      ->setDescription(t('The product price.'))
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'commerce_price_default',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'commerce_price_default',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['field_category'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Category'))
      ->setDescription(t('The product category.'))
      ->setSetting('target_type', 'taxonomy_term')
      ->setSetting('handler', 'default:taxonomy_term')
      ->setDisplayOptions('view', [
        'type' => 'entity_reference_label',
        'label' => 'above',
        'weight' => -5,
      ])
      ->setDisplayOptions('form', [
        'type' => 'options_select',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['field_additional_information'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Additional Information'))
      ->setDescription(t('Additional information about the product.'))
      ->setDisplayOptions('view', [
        'label' => 'above',
        'weight' => -6,
      ])
      ->setDisplayOptions('form', [
        'type' => 'text_textarea',
        'weight' => -6,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    // Add more fields as needed.

    $fields['field_images'] = BaseFieldDefinition::create('entity_reference')
        ->setLabel(t('Images'))
        ->setCardinality(FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED)
        ->setSetting('target_type', 'file') // Assuming you're using the core File entity
        ->setDisplayOptions('view', [
            'label' => 'hidden',
            'type' => 'image',
            'weight' => -5,
        ])
        ->setDisplayOptions('form', [
            'type' => 'inline_entity_form_complex',
            'settings' => [
            'allow_new' => TRUE,
            'allow_existing' => TRUE,
            'allow_duplicate' => FALSE,
            'available_types' => ['file'],
            ],
            'weight' => -5,
        ])
        ->setDisplayConfigurable('form', TRUE)
        ->setDisplayConfigurable('view', TRUE);


    return $fields;
  }
}
