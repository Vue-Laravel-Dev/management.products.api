<?php

namespace App\Modules\AutoPilot\src\Jobs\Refill;

use App\Modules\AutoPilot\src\Jobs\SetStatusPaidIfPaidJob;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RefillPaidJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $orders = Order::whereStatusCode('processing')->get();

        foreach ($orders as $order) {
            SetStatusPaidIfPaidJob::dispatch($order);
        }
    }
}
