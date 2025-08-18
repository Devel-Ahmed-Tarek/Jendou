<?php
namespace Plugin\TlcommerceCore\Repositories;

use Plugin\Carrier\Models\ShippingCarrier;
use Plugin\TlcommerceCore\Models\SellerShippingCarrier;

class SellerShippingCarrierRepository
{
    /**
     * الحصول على جميع شركات الشحن المتاحة
     */
    public function getAvailableCarriers()
    {
        return ShippingCarrier::where('status', config('settings.general_status.active'))
            ->get()
            ->map(function ($carrier) {
                return [
                    'id'           => $carrier->id,
                    'name'         => $carrier->name,
                    'logo'         => $carrier->logo,
                    'tracking_url' => $carrier->tracking_url,
                    'status'       => $carrier->status,
                ];
            });
    }

    /**
     * الحصول على شركات الشحن الخاصة بالتاجر
     */
    public function getSellerCarriers($sellerId)
    {
        return SellerShippingCarrier::where('seller_id', $sellerId)
            ->with('carrier')
            ->get();
    }

    /**
     * الحصول على شركة الشحن النشطة للتاجر
     */
    public function getActiveCarrier($sellerId)
    {
        return SellerShippingCarrier::where('seller_id', $sellerId)
            ->where('is_active', true)
            ->with('carrier')
            ->first();
    }

    /**
     * تفعيل شركة شحن للتاجر
     */
    public function activateCarrier($sellerId, $carrierId, $data = [])
    {
        try {
            // إلغاء تفعيل جميع شركات الشحن للتاجر
            SellerShippingCarrier::where('seller_id', $sellerId)
                ->update(['is_active' => false]);

            // إنشاء أو تحديث شركة الشحن المحددة
            $sellerCarrier = SellerShippingCarrier::updateOrCreate(
                [
                    'seller_id'  => $sellerId,
                    'carrier_id' => $carrierId,
                ],
                [
                    'is_active'       => true,
                    'base_cost'       => $data['base_cost'] ?? 0,
                    'cost_per_kg'     => $data['cost_per_kg'] ?? 0,
                    'cost_per_km'     => $data['cost_per_km'] ?? 0,
                    'min_cost'        => $data['min_cost'] ?? 0,
                    'max_cost'        => $data['max_cost'] ?? null,
                    'shipping_zones'  => $data['shipping_zones'] ?? null,
                    'excluded_zones'  => $data['excluded_zones'] ?? null,
                    'weight_ranges'   => $data['weight_ranges'] ?? null,
                    'distance_ranges' => $data['distance_ranges'] ?? null,
                    'api_credentials' => $data['api_credentials'] ?? null,
                    'settings'        => $data['settings'] ?? null,
                ]
            );

            return $sellerCarrier;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * تحديث إعدادات شركة الشحن
     */
    public function updateCarrierSettings($sellerId, $carrierId, $data)
    {
        try {
            $sellerCarrier = SellerShippingCarrier::where('seller_id', $sellerId)
                ->where('carrier_id', $carrierId)
                ->first();

            if (! $sellerCarrier) {
                return false;
            }

            $sellerCarrier->update($data);
            return $sellerCarrier;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * إلغاء تفعيل شركة الشحن
     */
    public function deactivateCarrier($sellerId, $carrierId)
    {
        try {
            return SellerShippingCarrier::where('seller_id', $sellerId)
                ->where('carrier_id', $carrierId)
                ->update(['is_active' => false]);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * حذف شركة الشحن
     */
    public function deleteCarrier($sellerId, $carrierId)
    {
        try {
            return SellerShippingCarrier::where('seller_id', $sellerId)
                ->where('carrier_id', $carrierId)
                ->delete();
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * حساب تكلفة الشحن
     */
    public function calculateShippingCost($sellerId, $weight = 0, $distance = 0, $zone = null)
    {
        $activeCarrier = $this->getActiveCarrier($sellerId);

        if (! $activeCarrier) {
            return 0;
        }

        // التحقق من صحة المنطقة
        if ($zone && ! $activeCarrier->isZoneValid($zone)) {
            return 0;
        }

        return $activeCarrier->calculateShippingCost($weight, $distance, $zone);
    }

    /**
     * الحصول على معلومات شركة الشحن
     */
    public function getCarrierInfo($sellerId, $carrierId)
    {
        return SellerShippingCarrier::where('seller_id', $sellerId)
            ->where('carrier_id', $carrierId)
            ->with('carrier')
            ->first();
    }

    /**
     * التحقق من وجود شركة شحن نشطة
     */
    public function hasActiveCarrier($sellerId)
    {
        return SellerShippingCarrier::where('seller_id', $sellerId)
            ->where('is_active', true)
            ->exists();
    }

    /**
     * الحصول على إحصائيات شركات الشحن
     */
    public function getCarrierStats($sellerId)
    {
        $totalCarriers  = SellerShippingCarrier::where('seller_id', $sellerId)->count();
        $activeCarriers = SellerShippingCarrier::where('seller_id', $sellerId)
            ->where('is_active', true)
            ->count();

        return [
            'total'    => $totalCarriers,
            'active'   => $activeCarriers,
            'inactive' => $totalCarriers - $activeCarriers,
        ];
    }
}
