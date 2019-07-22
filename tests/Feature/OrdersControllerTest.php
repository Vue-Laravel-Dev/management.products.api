<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Laravel\Passport\Passport;



class OrdersControllerTest extends TestCase
{
    public function test_orders_route_authenticated_user () {

        Passport::actingAs(
            factory(User::class)->create()
        );

        $data = [
            'orderID'      => '001241',
            'sku'          => '123456',
            'quantity'     => 9,
            'pricePerUnit' => 78,
            'priceTotal'   => 702,
        ];

        $this->json('POST', 'api/orders', [$data])->assertStatus(200);

    }

    public function test_orders_route_unauthenticated_user () {

        $data =
            '{
                "orderID": "001241",
                "sku": "123456",
                "quantity": 9,
                "pricePerUnit": 78,
                "priceTotal": 702
            }';

        $response = $this->json('POST', 'api/orders',[
                $data
            ]);

        $response->assertStatus(401);
    }
}
