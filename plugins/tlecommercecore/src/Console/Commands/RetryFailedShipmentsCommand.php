<?php

namespace Plugin\TlcommerceCore\Console\Commands;

use Illuminate\Console\Command;
use Plugin\TlcommerceCore\Models\ShippingIntegration;
use Plugin\TlcommerceCore\Jobs\ProcessShipmentJob;

class RetryFailedShipmentsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shipping:retry-failed-shipments 
                            {--limit=10 : Maximum number of shipments to retry}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retry failed shipments';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting retry process for failed shipments...');

        $failedShipments = ShippingIntegration::where('status', 'failed')
            ->where('carrier_name', 'Armex')
            ->limit($this->option('limit'))
            ->get();

        if ($failedShipments->isEmpty()) {
            $this->info('No failed shipments found to retry.');
            return 0;
        }

        $this->info("Found {$failedShipments->count()} failed shipments to retry.");

        $bar = $this->output->createProgressBar($failedShipments->count());
        $bar->start();

        foreach ($failedShipments as $shipment) {
            // Dispatch job to retry shipment
            ProcessShipmentJob::dispatch($shipment->order_product_id);
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('Retry jobs have been dispatched successfully!');

        return 0;
    }
}
