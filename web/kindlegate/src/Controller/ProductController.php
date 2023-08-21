<?php

namespace Drupal\kindlegate\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\kindlegate\Entity\Product;

class ProductController extends ControllerBase
{

    /**
     * Adds a new product.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *   The request object.
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *   The JSON response.
     */
    public function store(Request $request)
    {
        // var_dump($request->request->all());
        // die;
        // $data = json_decode($request->getContent(), TRUE);
        $data = $request->request->all();

        // Basic validation of required fields
        if (empty($data['name']) || empty($data['price']) || empty($data['sku'])) {
            return new JsonResponse(['message' => 'Name, price, and SKU are required.'], 400);
        }

        // Create a new product entity
        $product = Product::create([
            'type' => 'kindlegate_product_type', // Use the product type you defined
            'title' => $data['name'],
            'description' => isset($data['description']) ? $data['description'] : '',
            'price' => [
                'number' => $data['price'],
                'currency_code' => 'USD', // Adjust the currency code as needed
            ],
            'sku' => $data['sku'],
            'images' => $data['images'], // Array of file IDs or URIs for images
            'category' => [
                'target_id' => $data['category'], // Assuming $data['category'] contains the term ID
            ],
            'additional_information' => $data['additional_information'],
            // ... Set other fields and properties
        ]);

        try {
            $product->save();
            return new JsonResponse(['message' => 'Product added successfully.']);
        } catch (\Exception $e) {
            return new JsonResponse(['message' => 'An error occurred while adding the product.'], 500);
        }
    }


    /**
     * Updates an existing product.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *   The request object.
     * @param int $pid
     *   The product ID to update.
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *   The JSON response.
     */
    public function update(Request $request, $pid)
    {
        $data = json_decode($request->getContent(), TRUE);

        // Load the product entity by ID
        $product = Product::load($pid);
        if (!$product) {
            return new JsonResponse(['message' => 'Product not found.'], 404);
        }

        // Update the product properties
        if (isset($data['name'])) {
            $product->setTitle($data['name']);
        }

        if (isset($data['description'])) {
            $product->set('description', $data['description']);
        }

        // Update other fields as needed

        try {
            $product->save();
            return new JsonResponse(['message' => 'Product updated successfully.']);
        } catch (\Exception $e) {
            return new JsonResponse(['message' => 'An error occurred while updating the product.'], 500);
        }
    }

    /**
     * Retrieves a product.
     *
     * @param int $pid
     *   The product ID to retrieve.
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *   The JSON response.
     */
    public function retrieve($pid)
    {
        // Load the product entity by ID
        $product = Product::load($pid);
        if (!$product) {
            return new JsonResponse(['message' => 'Product not found.'], 404);
        }

        // Prepare and return the product data
        $productData = [
            'pid' => $product->id(),
            'name' => $product->getTitle(),
            'description' => $product->get('description')->value,
            // ... Include other fields as needed
        ];

        return new JsonResponse($productData);
    }

    /**
     * Deletes a product.
     *
     * @param int $pid
     *   The product ID to delete.
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *   The JSON response.
     */
    public function delete($pid)
    {
        // Load the product entity by ID
        $product = Product::load($pid);
        if (!$product) {
            return new JsonResponse(['message' => 'Product not found.'], 404);
        }

        try {
            $product->delete();
            return new JsonResponse(['message' => 'Product deleted successfully.']);
        } catch (\Exception $e) {
            return new JsonResponse(['message' => 'An error occurred while deleting the product.'], 500);
        }
    }



    /**
     * Retrieves a list of all products.
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *   The JSON response.
     */
    public function getAllProducts()
    {
        $products = [];
        $productEntities = \Drupal\kindlegate\Entity\Product::loadMultiple();
      
        foreach ($productEntities as $product) {
            print_r($product);
            die();
          $products[] = $this->prepareProductData($product);
        }
      
        return new JsonResponse($products);
    }


    /**
     * Prepares product data for response.
     *
     * @param \Drupal\kindlegate\Entity\Product $product
     *   The product entity.
     *
     * @return array
     *   The prepared product data.
     */
    protected function prepareProductData(Product $product)
    {
        $productData = [
            'pid' => $product->id(),
            'name' => $product->getTitle(),
            'description' => $product->get('description')->value,
            'sku' => $product->get('sku')->value,
            'price' => $product->get('price')->value,
            'category' => $product->get('category')->entity->getName(),
            'images' => $this->getProductImages($product),
            'additional_information' => $product->get('additional_information')->value,
            // ... Include other fields as needed
        ];

        return $productData;
    }

    /**
     * Retrieves product images.
     *
     * @param \Drupal\kindlegate\Entity\Product $product
     *   The product entity.
     *
     * @return array
     *   The array of image URIs.
     */
    protected function getProductImages(Product $product)
    {
        $images = [];
        foreach ($product->get('images') as $image) {
            if (!$image->isEmpty()) {
                $images[] = $image->entity->url();
            }
        }
        return $images;
    }
}
