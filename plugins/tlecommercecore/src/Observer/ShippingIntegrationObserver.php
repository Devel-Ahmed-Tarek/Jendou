<?php
namespace Plugin\TlcommerceCore\Observer;

use Plugin\TlcommerceCore\Jobs\ProcessShipmentJob;
use Plugin\TlcommerceCore\Models\OrderHasProducts;
use Plugin\TlcommerceCore\Models\ShippingIntegration;
use Plugin\TlcommerceCore\Services\ArmexShippingService;

class ShippingIntegrationObserver
{
    protected $armexService;

    public function __construct(ArmexShippingService $armexService)
    {
        $this->armexService = $armexService;
    }

    /**
     * Handle the OrderHasProducts "updated" event.
     */
    public function updated(OrderHasProducts $orderProduct)
    {
        // التحقق من أن حالة التوصيل تم تغييرها إلى "جاهز للشحن"
        if ($orderProduct->delivery_status == config('tlecommercecore.order_delivery_status.ready_to_ship')) {
            $this->createShipmentIfNotExists($orderProduct);
        }
    }

    /**
     * إنشاء شحنة إذا لم تكن موجودة
     */
    protected function createShipmentIfNotExists(OrderHasProducts $orderProduct)
    {
        // التحقق من وجود شحنة سابقة
        $existingShipment = ShippingIntegration::where('order_product_id', $orderProduct->id)
            ->where('carrier_name', 'Armex')
            ->first();

        if (! $existingShipment) {
            // إنشاء شحنة جديدة باستخدام Job
            ProcessShipmentJob::dispatch($orderProduct->id);
        }
    }

    /**
     * Handle the OrderHasProducts "created" event.
     */
    public function created(OrderHasProducts $orderProduct)
    {
        // يمكن إضافة منطق إضافي هنا إذا لزم الأمر
    }

    /**
     * Handle the OrderHasProducts "deleted" event.
     */
    public function deleted(OrderHasProducts $orderProduct)
    {
        // إلغاء الشحنة إذا تم حذف الطلب
        $shipment = ShippingIntegration::where('order_product_id', $orderProduct->id)
            ->where('carrier_name', 'Armex')
            ->first();

        if ($shipment && $shipment->tracking_number) {
            $this->armexService->cancelShipment($shipment->tracking_number);
        }
    }
}
