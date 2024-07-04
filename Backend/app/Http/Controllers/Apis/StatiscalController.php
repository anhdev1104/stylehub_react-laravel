<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\StatisticalService;

class StatiscalController extends Controller
{
    protected $statisticalService;

    public function __construct() {
        $this->statisticalService = new StatisticalService();
    }

    /**
     * @OA\Get(
     *     path="/api/v1/order-statistical",
     *     tags={"Statiscal"},
     *     summary="Get order statistics",
     *     description="Returns the total amount of orders within a specified date range and with a status of 'delivered'.",
     *     @OA\Parameter(
     *         name="start",
     *         in="query",
     *         description="Start datetime in format YYYY-MM-DD HH:MM:SS",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             format="date-time",
     *             example="2023-01-01 00:00:00"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="end",
     *         in="query",
     *         description="End datetime in format YYYY-MM-DD HH:MM:SS",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             format="date-time",
     *             example="2023-12-31 23:59:59"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="number",
     *                 example=12345.67
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Invalid date format"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="An error occurred while processing your request"
     *             )
     *         )
     *     )
     * )
     */
    public function orderStatistical(Request $request) {
        $result = $this->statisticalService->orderStatistical($request);
        return response()->json($result, 200);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/count-order",
     *     tags={"Statiscal"},
     *     summary="Count orders based on criteria",
     *     description="Count the number of orders based on optional criteria such as user ID and order status.",
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         description="Filter orders by user ID",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="order_status",
     *         in="query",
     *         description="Filter orders by status",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             enum={"pending", "processing", "delivered", "cancelled"}
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="total_orders",
     *                 type="integer",
     *                 example=50
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Invalid user ID"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Server error occurred"
     *             )
     *         )
     *     )
     * )
     */
    public function countOrder(Request $request) {
        $result = $this->statisticalService->countOrder($request);
        return response()->json($result, 200);
    }
}
