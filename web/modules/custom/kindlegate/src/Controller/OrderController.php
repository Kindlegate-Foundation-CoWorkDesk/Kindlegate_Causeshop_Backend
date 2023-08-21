<?php


namespace Drupal\kindlegate\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityStorageInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\kindlegate\Entity\Product;

class OrderController extends ControllerBase
{


    public  $entityStorage;
    /**
     * Constructs a CartController object.
     *
     * @param \Drupal\Core\Entity\EntityStorageInterface $entity_storage
     *   The entity storage service.
     */
    public function __construct(EntityStorageInterface $entity_storage)
    {
        $this->entityStorage = $entity_storage;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container)
    {
        return new static(
            $container->get('entity_type.manager')->getStorage('order')
        );
    }

    public function createOrder(Request $request)
    {
        // Load the current user.
        $user = \Drupal::currentUser();

        // Create a new order entity.
        $order = \Drupal\commerce_order\Entity\Order::create([
            'type' => 'default', // Replace with your order type.
            'store_id' => 1, // Replace with the appropriate store ID.
            'uid' => $user->id(),
            'state' => 'draft',
        ]);
        $order->save();

        // Create order items based on the provided product IDs and quantities.
        $data = $request->getContent();
        $data = json_decode($data, true);

        foreach ($data['items'] as $item) {
            $product_id = $item['product_id'];
            $quantity = $item['quantity'];
            // Load the product entity.
            $product = \Drupal\commerce_product\Entity\Product::load($product_id);

            if ($product) {
                $order_item = \Drupal\commerce_order\Entity\OrderItem::create([
                    'type' => 'default', // Replace with your order item type.
                    'order_id' => $order->id(),
                    'quantity' => $quantity,
                    'title' => $product->getTitle(),
                    'purchased_entity' => $product,
                ]);
                $order_item->save();
                // Add the order item to the order entity.
                $order->addItem($order_item);
            }
        }

        $order->save();

        return new JsonResponse(['message' => 'Order created']);
    }

    public function updateOrder($order_id, Request $request)
    {
        // Load the order by ID.
        $order = \Drupal\commerce_order\Entity\Order::load($order_id);

        if (!$order) {
            return new JsonResponse(['error' => 'Order not found'], 404);
        }

        // Update the order status or other fields as needed.
        $data = $request->getContent();
        $data = json_decode($data, true);

        if (isset($data['status'])) {
            $order->setState($data['status']);
        }

        $order->save();

        return new JsonResponse(['message' => 'Order updated']);
    }

    public function deleteOrder($order_id)
    {
        // Load the order by ID.
        $order = \Drupal\commerce_order\Entity\Order::load($order_id);

        if (!$order) {
            return new JsonResponse(['error' => 'Order not found'], 404);
        }

        // Delete the order.
        $order->delete();

        return new JsonResponse(['message' => 'Order deleted']);
    }

    public function viewOrder($order_id)
    {
        // Load the order by ID.
        $order = \Drupal\commerce_order\Entity\Order::load($order_id);

        if (!$order) {
            return new JsonResponse(['error' => 'Order not found'], 404);
        }

        // Prepare and return order data.
        $order_data = [
            'id' => $order->id(),
            'order_number' => $order->getOrderNumber(),
            'total_price' => $order->getTotalPrice(),
            'status' => $order->getState()->getValue(),
            // Add more fields as needed.
        ];

        return new JsonResponse($order_data);
    }
}
