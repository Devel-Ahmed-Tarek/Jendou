<?php
namespace Plugin\Multivendor\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Plugin\TlcommerceCore\Repositories\SellerShippingCarrierRepository;

class ShippingCarrierController extends Controller
{
    protected $carrier_repository;

    public function __construct(SellerShippingCarrierRepository $carrier_repository)
    {
        $this->carrier_repository = $carrier_repository;
    }

    /**
     * عرض صفحة شركات الشحن
     */
    public function carriers()
    {
        $sellerId = auth()->user()->id;

        $availableCarriers = $this->carrier_repository->getAvailableCarriers();
        $sellerCarriers    = $this->carrier_repository->getSellerCarriers($sellerId);
        $activeCarrier     = $this->carrier_repository->getActiveCarrier($sellerId);
        $stats             = $this->carrier_repository->getCarrierStats($sellerId);

        return view('plugin/multivendor::seller.shipping.carriers')->with([
            'availableCarriers' => $availableCarriers,
            'sellerCarriers'    => $sellerCarriers,
            'activeCarrier'     => $activeCarrier,
            'stats'             => $stats,
        ]);
    }

    /**
     * تفعيل شركة شحن
     */
    public function activateCarrier(Request $request)
    {
        $request->validate([
            'carrier_id'      => 'required|exists:tl_com_shipping_courier,id',
            'base_cost'       => 'required|numeric|min:0',
            'cost_per_kg'     => 'nullable|numeric|min:0',
            'cost_per_km'     => 'nullable|numeric|min:0',
            'min_cost'        => 'required|numeric|min:0',
            'max_cost'        => 'nullable|numeric|min:0',
            'shipping_zones'  => 'nullable|array',
            'excluded_zones'  => 'nullable|array',
            'weight_ranges'   => 'nullable|array',
            'distance_ranges' => 'nullable|array',
            'api_credentials' => 'nullable|string',
        ]);

        $sellerId = auth()->user()->id;
        $data     = $request->only([
            'base_cost', 'cost_per_kg', 'cost_per_km', 'min_cost', 'max_cost',
            'shipping_zones', 'excluded_zones', 'weight_ranges', 'distance_ranges', 'api_credentials',
        ]);

        $result = $this->carrier_repository->activateCarrier($sellerId, $request->carrier_id, $data);

        if ($result) {
            toastNotification('success', translate('Carrier activated successfully'));
        } else {
            toastNotification('error', translate('Failed to activate carrier'));
        }

        return redirect()->back();
    }

    /**
     * تحديث إعدادات شركة الشحن
     */
    public function updateCarrierSettings(Request $request)
    {
        $request->validate([
            'carrier_id'      => 'required|exists:tl_com_shipping_courier,id',
            'base_cost'       => 'required|numeric|min:0',
            'cost_per_kg'     => 'nullable|numeric|min:0',
            'cost_per_km'     => 'nullable|numeric|min:0',
            'min_cost'        => 'required|numeric|min:0',
            'max_cost'        => 'nullable|numeric|min:0',
            'shipping_zones'  => 'nullable|array',
            'excluded_zones'  => 'nullable|array',
            'weight_ranges'   => 'nullable|array',
            'distance_ranges' => 'nullable|array',
            'api_credentials' => 'nullable|string',
        ]);

        $sellerId = auth()->user()->id;
        $data     = $request->only([
            'base_cost', 'cost_per_kg', 'cost_per_km', 'min_cost', 'max_cost',
            'shipping_zones', 'excluded_zones', 'weight_ranges', 'distance_ranges', 'api_credentials',
        ]);

        $result = $this->carrier_repository->updateCarrierSettings($sellerId, $request->carrier_id, $data);

        if ($result) {
            toastNotification('success', translate('Carrier settings updated successfully'));
        } else {
            toastNotification('error', translate('Failed to update carrier settings'));
        }

        return redirect()->back();
    }

    /**
     * إلغاء تفعيل شركة الشحن
     */
    public function deactivateCarrier(Request $request)
    {
        $request->validate([
            'carrier_id' => 'required|exists:tl_com_shipping_courier,id',
        ]);

        $sellerId = auth()->user()->id;
        $result   = $this->carrier_repository->deactivateCarrier($sellerId, $request->carrier_id);

        if ($result) {
            toastNotification('success', translate('Carrier deactivated successfully'));
        } else {
            toastNotification('error', translate('Failed to deactivate carrier'));
        }

        return redirect()->back();
    }

    /**
     * حذف شركة الشحن
     */
    public function deleteCarrier(Request $request)
    {
        $request->validate([
            'carrier_id' => 'required|exists:tl_com_shipping_courier,id',
        ]);

        $sellerId = auth()->user()->id;
        $result   = $this->carrier_repository->deleteCarrier($sellerId, $request->carrier_id);

        if ($result) {
            toastNotification('success', translate('Carrier deleted successfully'));
        } else {
            toastNotification('error', translate('Failed to delete carrier'));
        }

        return redirect()->back();
    }

    /**
     * حساب تكلفة الشحن
     */
    public function calculateShippingCost(Request $request)
    {
        $request->validate([
            'weight'   => 'required|numeric|min:0',
            'distance' => 'nullable|numeric|min:0',
            'zone'     => 'nullable|string',
        ]);

        $sellerId = auth()->user()->id;
        $cost     = $this->carrier_repository->calculateShippingCost(
            $sellerId,
            $request->weight,
            $request->distance ?? 0,
            $request->zone
        );

        return response()->json([
            'success'  => true,
            'cost'     => $cost,
            'currency' => 'USD', // يمكن تغييرها حسب إعدادات النظام
        ]);
    }

    /**
     * الحصول على معلومات شركة الشحن
     */
    public function getCarrierInfo(Request $request)
    {
        $request->validate([
            'carrier_id' => 'required|exists:tl_com_shipping_courier,id',
        ]);

        $sellerId    = auth()->user()->id;
        $carrierInfo = $this->carrier_repository->getCarrierInfo($sellerId, $request->carrier_id);

        if ($carrierInfo) {
            return response()->json([
                'success' => true,
                'data'    => $carrierInfo,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => translate('Carrier not found'),
        ]);
    }

    /**
     * الحصول على إحصائيات شركات الشحن
     */
    public function getCarrierStats()
    {
        $sellerId = auth()->user()->id;
        $stats    = $this->carrier_repository->getCarrierStats($sellerId);

        return response()->json([
            'success' => true,
            'data'    => $stats,
        ]);
    }

    /**
     * اختبار الاتصال بـ API شركة الشحن
     */
    public function testApiConnection(Request $request)
    {
        $request->validate([
            'carrier_id'      => 'required|exists:tl_com_shipping_courier,id',
            'api_credentials' => 'required|string',
        ]);

        $sellerId    = auth()->user()->id;
        $carrierInfo = $this->carrier_repository->getCarrierInfo($sellerId, $request->carrier_id);

        if (! $carrierInfo) {
            return response()->json([
                'success' => false,
                'message' => translate('Carrier not found'),
            ]);
        }

        // هنا يمكن إضافة منطق اختبار الاتصال بـ API
        // مثال: اختبار الاتصال بـ Armex API
        try {
                                // اختبار الاتصال
            $testResult = true; // يجب استبدال هذا باختبار حقيقي

            if ($testResult) {
                return response()->json([
                    'success' => true,
                    'message' => translate('API connection successful'),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => translate('API connection failed'),
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => translate('API connection error: ') . $e->getMessage(),
            ]);
        }
    }
}
