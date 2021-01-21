<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Order;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Spatie\Tags\Tag;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\OrderController
 */
class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_returns_an_ok_response()
    {
        Order::query()->forceDelete();
        factory(Order::class)->create();

        $user = factory(User::class)->create();

        $response = $this->actingAs($user, 'api')->getJson(route('orders.index'));

        $response->assertOk();

        $this->assertNotEquals(0, $response->json('meta.total'));

        $response->assertJsonStructure([
            'meta',
            'links',
            'data' => [
                '*' => [
                    'id',
                    'status_code',
                ]
            ]
        ]);
    }

    /**
     * @test
     */
    public function update_returns_an_ok_response()
    {
        $order = factory(Order::class)->create();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user, 'api')->putJson(route('orders.update', [$order]), [
            'status_code' => "test_status_code",
            'packer_user_id' => $user->getKey(),
        ]);

        $response->assertOk();
        $response->assertJsonStructure([
//            'meta',
//            'links',
            'data' => [
                '*' => [
                ]
            ]
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_has_tags_filter_exists()
    {
        Passport::actingAs(
            factory(User::class)->create()
        );

        Order::query()->forceDelete();
        Tag::query()->forceDelete();

        $order = factory(Order::class)->create();

        $order->attachTag('Test');

        $response = $this->get('api/orders?filter[has_tags]=Test');

        $this->assertEquals(1, $response->json()['meta']['total']);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_has_tags_filter_missing()
    {
        Passport::actingAs(
            factory(User::class)->create()
        );

        Order::query()->forceDelete();
        Tag::query()->forceDelete();

        $order = factory(Order::class)->create();

        $response = $this->get('api/orders?filter[has_tags]=Test');

        $this->assertEquals(0, $response->json()['meta']['total']);
    }

    /**
     * @test
     */
    public function store_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $user = factory(\App\Models\User::class)->create();

        $response = $this->actingAs($user, 'api')->postJson(route('orders.store'), [
            // TODO: send request data
        ]);

        $response->assertOk();
        $response->assertJsonStructure([
            // TODO: compare expected response data
        ]);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function show_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $order = factory(Order::class)->create();
        $user = factory(\App\Models\User::class)->create();

        $response = $this->actingAs($user, 'api')->getJson(route('orders.show', [$order]));

        $response->assertOk();
        $response->assertJsonStructure([
            // TODO: compare expected response data
        ]);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function destroy_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $order = factory(Order::class)->create();
        $user = factory(\App\Models\User::class)->create();

        $response = $this->actingAs($user, 'api')->deleteJson(route('orders.destroy', [$order]));

        $response->assertOk();
        $response->assertJsonStructure([
            // TODO: compare expected response data
        ]);
        $this->assertDeleted($orders);

        // TODO: perform additional assertions
    }

    // test cases...
}
