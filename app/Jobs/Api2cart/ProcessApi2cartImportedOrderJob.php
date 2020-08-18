<?php

namespace App\Jobs\Api2cart;

use App\Events\OrderCreatedEvent;
use App\Events\OrderStatusChangedEvent;
use App\Models\OrderAddress;
use App\Modules\Api2cart\src\Models\Api2cartOrderImports;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use App\Models\OrderProductOption;
use App\Services\OrderService;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use test\Mockery\HasUnknownClassAsTypeHintOnMethod;

class ProcessApi2cartImportedOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $orderImport = null;

    /**
     * Create a new job instance.
     * @param Api2cartOrderImports $orderImport
     */
    public function __construct(Api2cartOrderImports $orderImport)
    {
        $this->orderImport = $orderImport;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws Exception
     */
    public function handle()
    {
        $this->updateOrCreateOrder();

        $this->orderImport->update([
            'order_number' => $this->orderImport['raw_import']['id'],
            'when_processed' => now(),
        ]);
    }

    /**
     * @param array $order
     * @return Collection
     */
    public function getChronologicalStatusHistory(array $order)
    {
        return Collection::make($order['status']['history'])
            ->sort(function ($a, $b) {
                $a_time = Carbon::make($a['modified_time']['value']);
                $b_time = Carbon::make($b['modified_time']['value']);
                return $a_time > $b_time;
            });
    }

    /**
     * @param $order
     * @return mixed
     */
    private function getAttributes($order)
    {
        $result = [];
        $result['raw_import'] = $order;
        $result['order_number'] = $order['id'];

        $result['order_placed_at'] = Carbon::createFromFormat(
            $order['create_at']['format'],
            $order['create_at']['value']
        );

        $result['status_code'] = $order['status']['id'];

        $statuses = $this->getChronologicalStatusHistory($order);

        foreach ($statuses as $status) {
            if ($status['id'] !== 'processing') {

                $time = $status['modified_time'];

                if (!is_null($time['value'])) {
                    $result['order_closed_at'] = Carbon::createFromFormat($time['format'], $time['value']);
                    break;
                }

            }
        }


        $result['products_count'] = 0;

        foreach ($order['order_products'] as $product) {
            $result['products_count'] += $product['quantity_ordered'];
        }

        return $result;
    }

    /**
     * @return Order
     */
    private function updateOrCreateOrder(): Order
    {
        $orderAttributes = [
            'order_number'          => $this->orderImport->raw_import['id'],
            'status_code'           => $this->orderImport->raw_import['status']['id'],
            'shipping_address'      => $this->orderImport->extractShippingAddressAttributes(),
            'order_products'        => $this->orderImport->extractOrderProducts(),
            'raw_import'            => $this->orderImport->raw_import,
        ];

        return OrderService::updateOrCreate($orderAttributes);
    }

}
