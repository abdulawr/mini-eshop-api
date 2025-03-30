<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(
 *     schema="Order",
 *     type="object",
 *     title="Order",
 *     required={"id", "customer_email", "status", "total_price", "created_at"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="customer_email", type="string", format="email", example="user@example.com"),
 *     @OA\Property(property="status", type="string", enum={"NEW", "PROCESSING", "COMPLETED", "CANCELLED"}, example="NEW"),
 *     @OA\Property(property="total_price", type="number", format="float", example=85.50),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-03-10T09:30:00Z"),
 *     @OA\Property(
 *         property="items",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/OrderItem")
 *     )
 * )
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_email',
        'status',
        'total_price'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
