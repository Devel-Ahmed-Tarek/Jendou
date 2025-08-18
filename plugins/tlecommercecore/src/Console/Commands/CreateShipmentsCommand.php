<?php
namespace Plugin\TlcommerceCore\Console\Commands;

use Illuminate\Console\Command;
use Plugin\TlcommerceCore\Models\OrderHasProducts;
use Plugin\TlcommerceCore\Models\ShippingIntegration;
use Plugin\TlcommerceCore\Services\ArmexShippingService;

class CreateShipmentsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shipping:create-shipments
                            {--order-id= : Create shipment for specific order}
                            {--all : Create shipments for all ready orders}
                            {--dry-run : Show what would be created without actually creating}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create shipments for orders that are ready to ship';

    protected $armexService;

    public function __construct(ArmexShippingService $armexService)
    {
        parent::__construct();
        $this->armexService = $armexService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting shipment creation process...');

        if ($this->option('order-id')) {
            $this->createShipmentForOrder($this->option('order-id'));
        } elseif ($this->option('all')) {
            $this->createShipmentsForAllReadyOrders();
        } else {
            $this->error('Please specify either --order-id or --all option');
            return 1;
        }

        $this->info('Shipment creation process completed!');
        return 0;
    }

    /**
     * Create shipment for specific order
     */
    protected function createShipmentForOrder($orderId)
    {
        $this->info("Creating shipment for order ID: {$orderId}");

        $orderProducts = OrderHasProducts::where('order_id', $orderId)
            ->where('delivery_status', config('tlecommercecore.order_delivery_status.ready_to_ship'))
            ->get();

        if ($orderProducts->isEmpty()) {
            $this->warn("No products found for order {$orderId} that are ready to ship");
            return;
        }

        foreach ($orderProducts as $orderProduct) {
            $this->processOrderProduct($orderProduct);
        }
    }

    /**
     * Create shipments for all ready orders
     */
    protected function createShipmentsForAllReadyOrders()
    {
        $this->info('Creating shipments for all orders ready to ship...');

        $orderProducts = OrderHasProducts::where('delivery_status', config('tlecommercecore.order_delivery_status.ready_to_ship'))
            ->get();

        if ($orderProducts->isEmpty()) {
            $this->warn('No orders found that are ready to ship');
            return;
        }

        $this->info("Found {$orderProducts->count()} products ready for shipment");

        $bar = $this->output->createProgressBar($orderProducts->count());
        $bar->start();

        foreach ($orderProducts as $orderProduct) {
            $this->processOrderProduct($orderProduct);
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
    }

    /**
     * Process individual order product
     */
    protected function processOrderProduct($orderProduct)
    {
        // Check if shipment already exists
        $existingShipment = ShippingIntegration::where('order_product_id', $orderProduct->id)
            ->where('carrier_name', 'Armex')
            ->first();

        if ($existingShipment) {
            if ($this->option('dry-run')) {
                $this->line("Shipment already exists for order product {$orderProduct->id}");
            }
            return;
        }

        if ($this->option('dry-run')) {
            $this->line("Would create shipment for order product {$orderProduct->id} (Order: {$orderProduct->order_id})");
            return;
        }

        try {
            $result = $this->armexService->createShipment($orderProduct->id);

            if ($result) {
                $this->info("✓ Created shipment for order product {$orderProduct->id} (Order: {$orderProduct->order_id})");
                if ($result->tracking_number) {
                    $this->line("  Tracking Number: {$result->tracking_number}");
                }
            } else {
                $this->error("✗ Failed to create shipment for order product {$orderProduct->id} (Order: {$orderProduct->order_id})");
            }
        } catch (\Exception $e) {
            $this->error("✗ Error creating shipment for order product {$orderProduct->id}: " . $e->getMessage());
        }
    }
}
