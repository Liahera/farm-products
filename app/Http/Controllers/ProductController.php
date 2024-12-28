<?php

namespace App\Http\Controllers;

use App\Filters\ProductFilter;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of products with optional filters.
     *
     * This method retrieves a list of products from the database.
     * Optional query parameters can be used to filter the results based on product attributes
     * such as name, quantity, price, and sorting order.
     *
     * Query Parameters:
     * - name (string): Filter products by name (partial match).
     * - min_quantity (int): Minimum quantity of the product.
     * - max_quantity (int): Maximum quantity of the product.
     * - min_price (float): Minimum price of the product.
     * - max_price (float): Maximum price of the product.
     * - sort_by (string): Attribute to sort by (e.g., 'name', 'price', 'quantity').
     * - sort_order (string): Sorting order ('asc' for ascending, 'desc' for descending). Defaults to 'asc'.
     *
     * Example:
     * GET /products?name=apple&min_price=10&sort_by=price&sort_order=desc
     *
     * @param Request $request The HTTP request instance containing query parameters.
     * @param ProductFilter $filter The filter service to apply filters to the query.
     * @return JsonResponse A JSON response containing the filtered list of products.
     */
    public function index(Request $request, ProductFilter $filter): JsonResponse
    {
        $products = $filter->apply(Product::query())->get();

        return response()->json($products);
    }

    /**
     * Store a newly created product in storage.
     *
     * @param StoreProductRequest $request
     * @return JsonResponse
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = Product::create($request->validated());
        return response()->json($product, 201);
    }

    /**
     * Display the specified product.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    /**
     * Update the specified product in storage.
     *
     * @param UpdateProductRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateProductRequest $request, int $id): JsonResponse
    {
        $product = Product::find($id);

        $product->update($request->validated());

        return response()->json($product);
    }

    /**
     * Remove the specified product from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        if (!Product::destroy($id)) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json(null, 204);
    }
}
