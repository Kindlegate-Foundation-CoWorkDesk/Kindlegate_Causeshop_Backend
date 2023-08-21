<?php

// namespace Drupal\kindlegate\Entity;

// use Drupal\Core\Entity\ContentEntityBase;
// use Drupal\Core\Entity\EntityTypeInterface;

// use Drupal\Core\Entity\EntityManagerInterface;
// use Symfony\Component\DependencyInjection\ContainerInterface;
// use Drupal\Core\Field\BaseFieldDefinition;

// /**
//  * Defines the Kindlegate Image entity.
//  *
//  * @ContentEntityType(
//  *   id = "kindlegate_image",
//  *   label = @Translation("Kindlegate Image"),
//  *   handlers = {
//  *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
//  *     "list_builder" = "Drupal\Core\Entity\EntityListBuilder",
//  *     "form" = {
//  *       "default" = "Drupal\Core\Entity\ContentEntityForm",
//  *       "add" = "Drupal\Core\Entity\ContentEntityForm",
//  *       "edit" = "Drupal\Core\Entity\ContentEntityForm",
//  *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
//  *     },
//  *     "access" = "Drupal\entity\EntityAccessControlHandler",
//  *   },
//  *   base_table = "kindlegate_image",
//  *   entity_keys = {
//  *     "id" = "image_id",
//  *     "uuid" = "uuid",
//  *     "label" = "filename",
//  *   },
//  * )
//  */
// class Image extends ContentEntityBase {

//   /**
//    * {@inheritdoc}
//    */
//   public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
//     $fields = parent::baseFieldDefinitions($entity_type);

//     // Image filename.
//     $fields['filename'] = BaseFieldDefinition::create('string')
//       ->setLabel(t('Filename'))
//       ->setDescription(t('The image filename.'))
//       ->setRequired(TRUE)
//       ->setSettings([
//         'max_length' => 255,
//       ])
//       ->setDisplayOptions('view', [
//         'label' => 'above',
//         'weight' => -4,
//       ])
//       ->setDisplayOptions('form', [
//         'type' => 'string_textfield',
//         'weight' => -4,
//       ])
//       ->setDisplayConfigurable('form', TRUE)
//       ->setDisplayConfigurable('view', TRUE);

//     // Image URI.
//     $fields['uri'] = BaseFieldDefinition::create('string')
//       ->setLabel(t('URI'))
//       ->setDescription(t('The image URI.'))
//       ->setRequired(TRUE)
//       ->setSettings([
//         'max_length' => 255,
//       ])
//       ->setDisplayOptions('view', [
//         'label' => 'hidden',
//         'type' => 'image',
//         'weight' => -5,
//       ])
//       ->setDisplayOptions('form', [
//         'type' => 'image_image',
//         'weight' => -5,
//       ])
//       ->setDisplayConfigurable('form', TRUE)
//       ->setDisplayConfigurable('view', TRUE);

//     // Alt text.
//     $fields['alt'] = BaseFieldDefinition::create('string')
//       ->setLabel(t('Alt text'))
//       ->setDescription(t('The alt text for the image.'))
//       ->setSettings([
//         'max_length' => 255,
//       ])
//       ->setDisplayOptions('view', [
//         'label' => 'hidden',
//         'weight' => -6,
//       ])
//       ->setDisplayOptions('form', [
//         'type' => 'string_textfield',
//         'weight' => -6,
//       ])
//       ->setDisplayConfigurable('form', TRUE)
//       ->setDisplayConfigurable('view', TRUE);

//     return $fields;
//   }

// }
