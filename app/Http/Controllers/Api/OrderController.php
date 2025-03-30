<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="Mini eShop Order API",
 *     version="1.0.0",
 *     description="API for managing e-commerce orders"
 * )
 * @OA\Server(
 *     url="http://localhost:8000",
 *     description="Local development server"
 * )
 * @OA\Tag(
 *     name="Orders",
 *     description="Order management endpoints"
 * )
 */
class OrderController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/orders",
     *     tags={"Orders"},
     *     summary="List all orders",
     *     description="Returns a list of all orders",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Order")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $orders = Order::with('items')->get();
        return response()->json($orders);
    }

    /**
     * @OA\Post(
     *     path="/api/orders",
     *     tags={"Orders"},
     *     summary="Create a new order",
     *     description="Creates a new order with items",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"customer_email", "items"},
     *             @OA\Property(property="customer_email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(
     *                 property="items",
     *                 type="array",
     *                 @OA\Items(
     *                     required={"product_name", "unit_price", "quantity"},
     *                     @OA\Property(property="product_name", type="string", example="Keyboard"),
     *                     @OA\Property(property="unit_price", type="number", format="float", example=45.50),
     *                     @OA\Property(property="quantity", type="integer", example=1)
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Order created",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="status", type="string", example="NEW")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(CreateOrderRequest $request)
    {
        $data = $request->validated();

        // Calculate total price
        $totalPrice = collect($data['items'])->sum(function ($item) {
            return $item['unit_price'] * $item['quantity'];
        });

        // Create order
        $order = Order::create([
            'customer_email' => $data['customer_email'],
            'status' => 'NEW',
            'total_price' => $totalPrice
        ]);

        // Create order items
        foreach ($data['items'] as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $item['product_name'],
                'unit_price' => $item['unit_price'],
                'quantity' => $item['quantity']
            ]);
        }

        return response()->json([
            'id' => $order->id,
            'status' => $order->status
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/orders/{id}",
     *     tags={"Orders"},
     *     summary="Get order by ID",
     *     description="Returns a single order with items",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Order ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Order details",
     *         @OA\JsonContent(ref="#/components/schemas/Order")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Order not found"
     *     )
     * )
     */
    public function show($id)
    {
        $order = Order::with('items')->find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json($order);
    }
}
