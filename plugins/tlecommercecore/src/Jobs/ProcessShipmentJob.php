<?php
namespace Plugin\TlcommerceCore\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Plugin\TlcommerceCore\Models\OrderHasProducts;
use Plugin\TlcommerceCore\Models\ShippingIntegration;
use Plugin\TlcommerceCore\Services\ArmexShippingService;

class ProcessShipmentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orderProductId;
    protected $retryCount;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($orderProductId, $retryCount = 0)
    {
        $this->orderProductId = $orderProductId;
        $this->retryCount     = $retryCount;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ArmexShippingService $armexService)
    {
        try {
            // Check if shipment already exists
            $existingShipment = ShippingIntegration::where('order_product_id', $this->orderProductId)
                ->where('carrier_name', 'Armex')
                ->first();

            if ($existingShipment) {
                Log::info('Shipment already exists for order product', [
                    'order_product_id' => $this->orderProductId,
                    'shipment_id'      => $existingShipment->id,
                ]);
                return;
            }

            // Create shipment
            $result = $armexService->createShipment($this->orderProductId);

            if ($result) {
                Log::info('Shipment created successfully', [
                    'order_product_id' => $this->orderProductId,
                    'tracking_number'  => $result->tracking_number ?? null,
                    'shipment_id'      => $result->id,
                ]);
            } else {
                Log::error('Failed to create shipment', [
                    'order_product_id' => $this->orderProductId,
                ]);

                // Retry if we haven't exceeded the maximum retry count
                if ($this->retryCount < 3) {
                    $this->release(300); // Retry after 5 minutes
                }
            }
        } catch (\Exception $e) {
            Log::error('Error processing shipment job', [
                'order_product_id' => $this->orderProductId,
                'error'            => $e->getMessage(),
                'retry_count'      => $this->retryCount,
            ]);

            // Retry if we haven't exceeded the maximum retry count
            if ($this->retryCount < 3) {
                $this->release(300); // Retry after 5 minutes
            }
        }
    }

    /**
     * Handle a job failure.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(\Throwable $exception)
    {
        Log::error('Shipment job failed permanently', [
            'order_product_id' => $this->orderProductId,
            'error'            => $exception->getMessage(),
            'retry_count'      => $this->retryCount,
        ]);

        // Mark shipment as failed
        ShippingIntegration::updateOrCreate(
            [
                'order_product_id' => $this->orderProductId,
                'carrier_name'     => 'Armex',
            ],
            [
                'order_id'     => OrderHasProducts::find($this->orderProductId)->order_id ?? null,
                'status'       => 'failed',
                'api_response' => ['error' => $exception->getMessage()],
            ]
        );
    }
}
