<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="OrderItem",
 *     type="object",
 *     title="Order Item",
 *     required={"id", "product_name", "unit_price", "quantity"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="product_name", type="string", example="Keyboard"),
 *     @OA\Property(property="unit_price", type="number", format="float", example=45.50),
 *     @OA\Property(property="quantity", type="integer", example=1)
 * )
 */
class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_name',
        'unit_price',
        'quantity'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
