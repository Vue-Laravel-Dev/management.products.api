<?php

namespace App\Jobs;

use App\Models\Product;
use App\Services\Api2cartService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncProductsToApi2Cart implements ShouldQueue
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
     * @throws Exception
     */
    public function handle()
    {
        $limit = 100;

        $products = Product::withAllTags(['Available Online', 'Not Synced'])
            // we want to sync products with smallest quantities first to avoid oversells
            ->orderBy('quantity')
            ->orderBy('updated_at')
            ->chunk($limit, function ($products) {
                foreach ($products as $product) {
                    Api2cartService::dispatchSyncProductJob($product);
                }
            });

        info('Dispatched Api2cart product sync jobs', ['count' => $products->count()]);
    }
}
