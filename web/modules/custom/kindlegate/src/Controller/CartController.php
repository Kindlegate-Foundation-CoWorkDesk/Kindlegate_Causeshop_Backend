<?php

namespace Drupal\kindlegate\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityStorageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\kindlegate_cart\Entity\Cart;
use Symfony\Component\HttpFoundation\JsonResponse;

class CartController extends ControllerBase {

    public  $entityStorage;
  /**
   * Constructs a CartController object.
   *
   * @param \Drupal\Core\Entity\EntityStorageInterface $entity_storage
   *   The entity storage service.
   */
  public function __construct(EntityStorageInterface $entity_storage) {
    $this->entityStorage = $entity_storage;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager')->getStorage('cart')
    );
  }


  public function addToCart($product_id, $quantity) {
    // Load the product by ID (replace 'product' with your actual entity type ID).
    $product = \Drupal::entityTypeManager()->getStorage('product')->load($product_id);

    if (!$product) {
      return new JsonResponse(['error' => 'Product not found'], 404);
    }

    // Add the product to the cart entity.
    // Your logic for creating and adding cart items here.
    // Make sure to save the cart entity after adding the item.

    return new JsonResponse(['message' => 'Product added to cart']);
  }

  public function updateCartItem($cart_item_id, $quantity) {
    // Load the cart item by ID (replace 'cart_item' with your actual entity type ID).
    $cart_item = \Drupal::entityTypeManager()->getStorage('cart_item')->load($cart_item_id);

    if (!$cart_item) {
      return new JsonResponse(['error' => 'Cart item not found'], 404);
    }

    // Update the quantity of the cart item.
    // Your logic for updating cart item quantity here.
    // Make sure to save the cart item entity after updating.

    return new JsonResponse(['message' => 'Cart item updated']);
  }

  public function removeFromCart($cart_item_id) {
    // Load the cart item by ID (replace 'cart_item' with your actual entity type ID).
    $cart_item = \Drupal::entityTypeManager()->getStorage('cart_item')->load($cart_item_id);

    if (!$cart_item) {
      return new JsonResponse(['error' => 'Cart item not found'], 404);
    }

    // Delete the cart item entity.
    // Your logic for removing cart items here.

    return new JsonResponse(['message' => 'Cart item removed']);
  }

  public function viewCart() {
    // Implement logic to retrieve cart contents and prepare data.
    // Your logic for loading and preparing cart data here.
    $cart = []; // Example cart data

    return new JsonResponse($cart);
  }


  // Implement cart-related operations (add, update, remove, view).
}
