<?php
namespace Plugin\TlcommerceCore\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Plugin\TlcommerceCore\Models\ShippingIntegration;
use Plugin\TlcommerceCore\Services\ArmexShippingService;

class ShippingIntegrationController extends Controller
{
    protected $armexService;

    public function __construct(ArmexShippingService $armexService)
    {
        $this->armexService = $armexService;
    }

    /**
     * عرض قائمة الشحنات المتكاملة
     */
    public function index(Request $request)
    {
        $shipments = ShippingIntegration::with(['order', 'orderProduct'])
            ->when($request->has('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->has('carrier'), function ($query) use ($request) {
                $query->where('carrier_name', $request->carrier);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('plugin/tlecommercecore::shipping.integration.index', compact('shipments'));
    }

    /**
     * إنشاء شحنة يدوياً
     */
    public function createShipment(Request $request)
    {
        $request->validate([
            'order_product_id' => 'required|exists:tl_com_ordered_products,id',
        ]);

        try {
            $result = $this->armexService->createShipment($request->order_product_id);

            if ($result) {
                toastNotification('success', translate('Shipment created successfully'));
            } else {
                toastNotification('error', translate('Failed to create shipment'));
            }

            return redirect()->back();
        } catch (\Exception $e) {
            toastNotification('error', translate('An error occurred while creating shipment'));
            return redirect()->back();
        }
    }

    /**
     * تتبع الشحنة
     */
    public function trackShipment(Request $request)
    {
        $request->validate([
            'tracking_number' => 'required|string',
        ]);

        try {
            $trackingInfo = $this->armexService->trackShipment($request->tracking_number);

            if ($trackingInfo) {
                return response()->json([
                    'success' => true,
                    'data'    => $trackingInfo,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => translate('Tracking information not found'),
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => translate('An error occurred while tracking shipment'),
            ]);
        }
    }

    /**
     * طباعة ملصق الشحن
     */
    public function printLabel(Request $request)
    {
        $request->validate([
            'tracking_number' => 'required|string',
        ]);

        try {
            $labelContent = $this->armexService->getShippingLabel($request->tracking_number);

            if ($labelContent) {
                return response($labelContent)
                    ->header('Content-Type', 'application/pdf')
                    ->header('Content-Disposition', 'inline; filename="shipping_label.pdf"');
            } else {
                toastNotification('error', translate('Label not found'));
                return redirect()->back();
            }
        } catch (\Exception $e) {
            toastNotification('error', translate('An error occurred while printing label'));
            return redirect()->back();
        }
    }

    /**
     * إلغاء الشحنة
     */
    public function cancelShipment(Request $request)
    {
        $request->validate([
            'tracking_number' => 'required|string',
        ]);

        try {
            $result = $this->armexService->cancelShipment($request->tracking_number);

            if ($result) {
                // تحديث حالة الشحنة في قاعدة البيانات
                ShippingIntegration::where('tracking_number', $request->tracking_number)
                    ->update(['status' => 'cancelled']);

                toastNotification('success', translate('Shipment cancelled successfully'));
            } else {
                toastNotification('error', translate('Failed to cancel shipment'));
            }

            return redirect()->back();
        } catch (\Exception $e) {
            toastNotification('error', translate('An error occurred while cancelling shipment'));
            return redirect()->back();
        }
    }

    /**
     * عرض تفاصيل الشحنة
     */
    public function show($id)
    {
        $shipment = ShippingIntegration::with(['order', 'orderProduct'])
            ->findOrFail($id);

        return view('plugin/tlecommercecore::shipping.integration.show', compact('shipment'));
    }

    /**
     * إعادة إنشاء شحنة فاشلة
     */
    public function retryShipment($id)
    {
        try {
            $shipment = ShippingIntegration::findOrFail($id);

            if ($shipment->status === 'failed') {
                $result = $this->armexService->createShipment($shipment->order_product_id);

                if ($result) {
                    toastNotification('success', translate('Shipment recreated successfully'));
                } else {
                    toastNotification('error', translate('Failed to recreate shipment'));
                }
            } else {
                toastNotification('error', translate('Only failed shipments can be retried'));
            }

            return redirect()->back();
        } catch (\Exception $e) {
            toastNotification('error', translate('An error occurred while retrying shipment'));
            return redirect()->back();
        }
    }

    /**
     * API endpoint لتتبع الشحنة
     */
    public function apiTrackShipment(Request $request)
    {
        $request->validate([
            'tracking_number' => 'required|string',
        ]);

        try {
            $trackingInfo = $this->armexService->trackShipment($request->tracking_number);

            if ($trackingInfo) {
                return response()->json([
                    'success' => true,
                    'data'    => $trackingInfo,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Tracking information not found',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while tracking shipment',
            ], 500);
        }
    }
}
