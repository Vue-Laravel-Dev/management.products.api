<?php

namespace Tests\Feature;

use App\Jobs\JobImportOrderApi2Cart;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ImportOrdersControllerTest extends TestCase
{

    use AuthorizedUserTestCase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_job_is_pushed_to_queue()
    {
        Queue::fake();

        $response = $this->get('/api/import/orders/api2cart');

        $response->assertStatus(200);

        Queue::assertPushed(JobImportOrderApi2Cart::class);
    }

    public function test_if_job_executes_without_exceptions()
    {
        $api2cart_demo_store_key = "ed58a22dfecb405a50ea3ea56979360d";

        $job = new JobImportOrderApi2Cart(
            auth()->user(),
            $api2cart_demo_store_key
        );

        $job->handle();

        $this->assertTrue(True);
    }
}
