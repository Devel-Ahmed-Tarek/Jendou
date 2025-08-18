<?php
namespace Plugin\TlcommerceCore\Providers;

use Illuminate\Support\ServiceProvider;
use Plugin\TlcommerceCore\Models\OrderHasProducts;
use Plugin\TlcommerceCore\Observer\ShippingIntegrationObserver;
use Plugin\TlcommerceCore\Services\ArmexShippingService;

class ShippingIntegrationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ArmexShippingService::class, function ($app) {
            return new ArmexShippingService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // تسجيل Observer
        OrderHasProducts::observe(ShippingIntegrationObserver::class);

        // تحميل الإعدادات
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/armex.php', 'tlecommercecore.armex'
        );

        // تحميل الـ Views
        $this->loadViewsFrom(__DIR__ . '/../Views/shipping', 'tlecommercecore::shipping');

        // تحميل الـ Routes
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');

        // تسجيل Commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Plugin\TlcommerceCore\Console\Commands\CreateShipmentsCommand::class,
                \Plugin\TlcommerceCore\Console\Commands\RetryFailedShipmentsCommand::class,
            ]);
        }
    }
}
