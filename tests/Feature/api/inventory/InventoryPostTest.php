<?php

namespace Tests\Feature\api\inventory;

use App\Models\Inventory;
use App\Models\Product;
use App\User;
use Laravel\Passport\Passport;
use Mockery\Generator\StringManipulation\Pass\Pass;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InventoryPostTest extends TestCase
{

    public function test_if_cant_post_without_data()
    {
        Passport::actingAs(
            factory(User::class)->create()
        );

        $response = $this->postJson('/api/inventory', []);

        $response->assertStatus(422);
    }

    public function test_quantity_update() {

        Passport::actingAs(
            factory(User::class)->create()
        );

        $inventory = factory(Inventory::class)->make();

        $product = factory(Product::class)->create();

        $update = [
            'sku' => $product->sku,
            'location_id' => 0,
            'quantity' => $inventory->quantity,
            'quantity_reserved' => $inventory->quantity_reserved
        ];

        $response = $this->postJson('/api/inventory', $update);

        $response->assertStatus(200);
    }
}
