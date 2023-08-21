<?php

namespace Drupal\kindlegate\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\taxonomy\Entity\Term;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controller for Kindlegate Product Category API endpoints.
 */
class CategoryController extends ControllerBase
{




    /**
     * Retrieves a list of all product categories.
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *   The JSON response.
     */

    public function getAllCategories()
    {
        // Load all terms from the product categories vocabulary
        $query = \Drupal::entityQuery('taxonomy_term')
            ->condition('vid', 'product_categories'); // Replace with the actual vocabulary machine name
        $term_ids = $query->accessCheck(FALSE)->execute();

        $categories = [];
        foreach ($term_ids as $tid) {
            $term = Term::load($tid);
            if ($term) {
                $categories[] = [
                    'tid' => $term->id(),
                    'name' => $term->getName(),
                    // ... Include other fields as needed
                ];
            }
        }

        return new JsonResponse($categories);
    }

    /**
     * Creates a new product category.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *   The request object.
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *   The JSON response.
     */
    public function createCategory(Request $request)
    {
        $data = json_decode($request->getContent(), TRUE);

        // Basic validation of required fields
        if (empty($data['name'])) {
            return new JsonResponse(['message' => 'Name is required.'], 400);
        }

        // Create a new taxonomy term (product category)
        $term = Term::create([
            'vid' => 'product_categories', // Replace with the actual vocabulary machine name
            'name' => $data['name'],
            // ... Set other fields and properties
        ]);

        try {
            $term->save();
            return new JsonResponse(['message' => 'Product category created successfully.']);
        } catch (\Exception $e) {
            return new JsonResponse(['message' => 'An error occurred while creating the product category.'], 500);
        }
    }

    /**
     * Updates an existing product category.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *   The request object.
     * @param int $tid
     *   The term ID of the category to update.
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *   The JSON response.
     */
    public function updateCategory(Request $request, $tid)
    {
        $data = json_decode($request->getContent(), TRUE);

        // Load the term by term ID
        $term = Term::load($tid);
        if (!$term) {
            return new JsonResponse(['message' => 'Product category not found.'], 404);
        }

        // Update the term properties
        if (isset($data['name'])) {
            $term->setName($data['name']);
        }

        // ... Update other fields as needed

        try {
            $term->save();
            return new JsonResponse(['message' => 'Product category updated successfully.']);
        } catch (\Exception $e) {
            return new JsonResponse(['message' => 'An error occurred while updating the product category.'], 500);
        }
    }

    /**
     * Deletes a product category.
     *
     * @param int $tid
     *   The term ID of the category to delete.
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *   The JSON response.
     */
    public function deleteCategory($tid)
    {
        // Load the term by term ID
        $term = Term::load($tid);
        if (!$term) {
            return new JsonResponse(['message' => 'Product category not found.'], 404);
        }

        try {
            $term->delete();
            return new JsonResponse(['message' => 'Product category deleted successfully.']);
        } catch (\Exception $e) {
            return new JsonResponse(['message' => 'An error occurred while deleting the product category.'], 500);
        }
    }

    /**
     * Retrieves a product category.
     *
     * @param int $tid
     *   The term ID of the category to retrieve.
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *   The JSON response.
     */
    public function getCategory($tid)
    {
        // Load the term by term ID
        $term = Term::load($tid);
        if (!$term) {
            return new JsonResponse(['message' => 'Product category not found.'], 404);
        }

        // Prepare and return the term data
        $categoryData = [
            'tid' => $term->id(),
            'name' => $term->getName(),
            // ... Include other fields as needed
        ];

        return new JsonResponse($categoryData);
    }
}
