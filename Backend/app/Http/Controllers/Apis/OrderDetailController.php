<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderDetail;

class OrderDetailController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/order-details",
     *     tags={"Order Details"},
     *     security={{"bearerAuth": {}}},
     *     summary="Get a list of order details",
     *     description="Returns a list of order details along with their associated products.",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="order_id", type="integer", example=101),
     *                 @OA\Property(property="product_id", type="integer", example=202),
     *                 @OA\Property(property="quantity", type="integer", example=2),
     *                 @OA\Property(property="price", type="number", format="float", example=50.00),
     *                 @OA\Property(
     *                     property="product",
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=202),
     *                     @OA\Property(property="name", type="string", example="Product Name"),
     *                     @OA\Property(property="description", type="string", example="Product Description"),
     *                     @OA\Property(property="price", type="number", format="float", example=50.00),
     *                     @OA\Property(property="category_id", type="integer", example=3)
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Internal server error message")
     *         )
     *     )
     * )
     */
    public function index() {
        try {
            $orderDetails = OrderDetail::with('product')->get();

            return response()->json(['data' => $orderDetails], 200);
        }catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/v1/orders/{id}/order-details",
     *     tags={"Order Details"},
     *     security={{"bearerAuth": {}}},
     *     summary="Get order details by order ID",
     *     description="Returns a list of order details for a specific order ID along with their associated products.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Order ID",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             example=101
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="order_id", type="integer", example=101),
     *                 @OA\Property(property="product_id", type="integer", example=202),
     *                 @OA\Property(property="quantity", type="integer", example=2),
     *                 @OA\Property(property="price", type="number", format="float", example=50.00),
     *                 @OA\Property(
     *                     property="product",
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=202),
     *                     @OA\Property(property="name", type="string", example="Product Name"),
     *                     @OA\Property(property="description", type="string", example="Product Description"),
     *                     @OA\Property(property="price", type="number", format="float", example=50.00),
     *                     @OA\Property(property="category_id", type="integer", example=3)
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Order detail not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Order detail not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Internal server error message")
     *         )
     *     )
     * )
     */
    public function getOrderId($id) {
        try {
            $orderDetails = OrderDetail::with('product')->where('order_id', $id)->get();
            if ($orderDetails->isEmpty()) {
                return response()->json(['message' => 'Order detail not found'], 404);
            }
            return response()->json(['data' => $orderDetails], 200);
        }catch (\Throwable $e) {
            return response()->json(['message' => 'Internal server error'], 500);
        }
    }
}
