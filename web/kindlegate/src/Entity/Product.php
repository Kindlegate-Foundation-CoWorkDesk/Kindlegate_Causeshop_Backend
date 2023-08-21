<?php

namespace Drupal\kindlegate\Entity;

use Drupal\commerce_product\Entity\Product as CommerceProduct;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\taxonomy\Entity\Term;

/**
 * Defines the Product entity.
 *
 * @ContentEntityType(
 *   id = "Product",
 *   label = @Translation("Kindlegate Product"),
 *   handlers = {
 *     "translation" = "Drupal\content_translation\ContentTranslationHandler",
 *   },
 *   entity_keys = {
 *     "langcode" = "langcode",
 *   },
 *   base_table = "commerce_product",
 *   entity_keys = {
 *     "id" = "product_id",
 *     "uuid" = "uuid",
 *     "label" = "title",
 *   },
 *   fieldable = TRUE,
 * )
 */
// class Product extends CommerceProduct
class Product extends ContentEntityBase
{
    /**
     * {@inheritdoc}
     */
    public static function baseFieldDefinitions(EntityTypeInterface $entity_type)
    {
        $fields = parent::baseFieldDefinitions($entity_type);


        // Description field.
        $fields['description'] = BaseFieldDefinition::create('text_long')
            ->setLabel(t('Description'))
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

        // Images
        $fields['images'] = BaseFieldDefinition::create('image')
            ->setLabel(t('Images'))
            ->setCardinality(FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED)
            ->setDisplayOptions('view', [
                'label' => 'hidden',
                'type' => 'image',
                'weight' => -5,
            ])
            ->setDisplayOptions('form', [
                'type' => 'image_image',
                'weight' => -5,
            ])
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE);

        // SKU
        $fields['sku'] = BaseFieldDefinition::create('string')
            ->setLabel(t('SKU'))
            ->setDescription(t('The product SKU.'))
            ->setRequired(TRUE)
            ->setSettings([
                'max_length' => 255,
            ])
            ->setDisplayOptions('view', [
                'label' => 'above',
                'weight' => -4,
            ])
            ->setDisplayOptions('form', [
                'type' => 'string_textfield',
                'weight' => -4,
            ])
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE);

        // Additional Information
        $fields['additional_information'] = BaseFieldDefinition::create('text_long')
            ->setLabel(t('Additional Information'))
            ->setDescription(t('Additional information about the product.'))
            ->setDisplayOptions('view', [
                'label' => 'above',
                'weight' => -3,
            ])
            ->setDisplayOptions('form', [
                'type' => 'text_textarea',
                'weight' => -3,
            ])
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE);

        // Variations
        $fields['variations'] = BaseFieldDefinition::create('entity_reference')
            ->setLabel(t('Variations'))
            ->setDescription(t('The product variations.'))
            ->setCardinality(FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED)
            ->setSetting('target_type', 'commerce_product_variation')
            ->setDisplayOptions('view', [
                'type' => 'entity_reference_entity_view',
                'label' => 'above',
                'weight' => -2,
            ])
            ->setDisplayOptions('form', [
                'type' => 'inline_entity_form_complex',
                'settings' => [
                    'allow_new' => TRUE,
                    'allow_existing' => TRUE,
                    'allow_duplicate' => FALSE,
                    'available_types' => ['product_variation_type'], // Define your variation type
                ],
                'weight' => -2,
            ])
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE);

        // Category
        $fields['category'] = BaseFieldDefinition::create('entity_reference')
            ->setLabel(t('Category'))
            ->setDescription(t('The product category.'))
            ->setSetting('target_type', 'taxonomy_term')
            ->setSetting('handler', 'default:taxonomy_term')
            ->setDisplayOptions('view', [
                'type' => 'entity_reference_label',
                'label' => 'above',
                'weight' => -6,
            ])
            ->setDisplayOptions('form', [
                'type' => 'options_select',
                'weight' => -6,
            ])
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE);

        return $fields;
    }
}
