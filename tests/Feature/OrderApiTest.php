<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_order()
    {
        $response = $this->postJson('/api/orders', [
            'customer_email' => 'test@example.com',
            'items' => [
                [
                    'product_name' => 'Keyboard',
                    'unit_price' => 45.50,
                    'quantity' => 1
                ],
                [
                    'product_name' => 'Mouse',
                    'unit_price' => 20.00,
                    'quantity' => 2
                ]
            ]
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'status'
            ]);
    }

    public function test_get_order()
    {
        $order = \App\Models\Order::factory()
            ->has(\App\Models\OrderItem::factory()->count(2))
            ->create();

        $response = $this->getJson("/api/orders/{$order->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'customer_email',
                'status',
                'total_price',
                'created_at',
                'items'
            ]);
    }

    public function test_list_orders()
    {
        \App\Models\Order::factory()
            ->has(\App\Models\OrderItem::factory()->count(2))
            ->count(3)
            ->create();

        $response = $this->getJson('/api/orders');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }
}
