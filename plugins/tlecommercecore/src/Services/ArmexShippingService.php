<?php
namespace Plugin\TlcommerceCore\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Plugin\TlcommerceCore\Models\OrderHasProducts;
use Plugin\TlcommerceCore\Models\ShippingIntegration;

class ArmexShippingService
{
    protected $apiUrl;
    protected $apiKey;
    protected $username;
    protected $password;

    public function __construct()
    {
        // يمكن تحميل هذه القيم من الإعدادات
        $this->apiUrl   = config('tlecommercecore.armex.api_url', 'https://api.armex.com');
        $this->apiKey   = config('tlecommercecore.armex.api_key');
        $this->username = config('tlecommercecore.armex.username');
        $this->password = config('tlecommercecore.armex.password');

        // التحقق من وضع الاختبار
        if ($this->isTestMode()) {
            Log::info('Armex service running in test mode');
        }
    }

    /**
     * التحقق من وضع الاختبار
     */
    protected function isTestMode()
    {
        $testMode     = config('tlecommercecore.armex.test_mode', true);
        $testApiKey   = config('tlecommercecore.armex.test_api_key', 'test_api_key_12345');
        $testUsername = config('tlecommercecore.armex.test_username', 'test_user');

        return $testMode ||
        $this->apiKey === $testApiKey ||
        $this->username === $testUsername ||
        app()->environment('local', 'testing');
    }

    /**
     * إنشاء شحنة جديدة
     */
    public function createShipment($orderProductId)
    {
        try {
            $orderProduct = OrderHasProducts::with(['order', 'order.shipping_details', 'product_details'])
                ->findOrFail($orderProductId);

            $order           = $orderProduct->order;
            $shippingAddress = $order->shipping_details;

            // تحضير بيانات الشحنة
            $shipmentData = [
                'consignee' => [
                    'name'        => $shippingAddress->name ?? $order->customer_info->name,
                    'phone'       => $shippingAddress->phone ?? $order->customer_info->phone,
                    'email'       => $shippingAddress->email ?? $order->customer_info->email,
                    'address'     => $shippingAddress->address ?? '',
                    'city'        => $shippingAddress->city ?? '',
                    'state'       => $shippingAddress->state ?? '',
                    'country'     => $shippingAddress->country ?? '',
                    'postal_code' => $shippingAddress->postal_code ?? '',
                ],
                'package'   => [
                    'weight'      => $orderProduct->product_details->weight ?? 1,
                    'length'      => $orderProduct->product_details->length ?? 10,
                    'width'       => $orderProduct->product_details->width ?? 10,
                    'height'      => $orderProduct->product_details->height ?? 10,
                    'description' => $orderProduct->product_details->name ?? 'Product',
                ],
                'reference' => $order->order_code,
                'order_id'  => $order->id,
            ];

            // التحقق من وضع الاختبار
            if ($this->isTestMode()) {
                // إنشاء استجابة اختبار
                $testResponse = [
                    'tracking_number' => 'ARMEX_TEST_' . time() . '_' . $orderProduct->id,
                    'label_url'       => 'https://test.armex.com/labels/test_label.pdf',
                    'status'          => 'created',
                    'message'         => 'Test shipment created successfully',
                ];

                // حفظ معلومات الشحنة
                $shippingIntegration = ShippingIntegration::create([
                    'order_id'           => $order->id,
                    'order_product_id'   => $orderProduct->id,
                    'carrier_name'       => 'Armex',
                    'tracking_number'    => $testResponse['tracking_number'],
                    'shipping_label_url' => $testResponse['label_url'],
                    'api_response'       => $testResponse,
                    'status'             => 'success',
                ]);

                // تحديث tracking_id في الطلب
                $orderProduct->tracking_id = $testResponse['tracking_number'];
                $orderProduct->save();

                Log::info('Test Armex shipment created successfully', [
                    'order_id'        => $order->id,
                    'tracking_number' => $testResponse['tracking_number'],
                ]);

                return $shippingIntegration;
            }

            // إرسال الطلب إلى API أرمكس
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type'  => 'application/json',
            ])->post($this->apiUrl . '/shipments', $shipmentData);

            if ($response->successful()) {
                $responseData = $response->json();

                // حفظ معلومات الشحنة
                $shippingIntegration = ShippingIntegration::create([
                    'order_id'           => $order->id,
                    'order_product_id'   => $orderProduct->id,
                    'carrier_name'       => 'Armex',
                    'tracking_number'    => $responseData['tracking_number'] ?? null,
                    'shipping_label_url' => $responseData['label_url'] ?? null,
                    'api_response'       => $responseData,
                    'status'             => 'success',
                ]);

                // تحديث tracking_id في الطلب
                if (isset($responseData['tracking_number'])) {
                    $orderProduct->tracking_id = $responseData['tracking_number'];
                    $orderProduct->save();
                }

                Log::info('Armex shipment created successfully', [
                    'order_id'        => $order->id,
                    'tracking_number' => $responseData['tracking_number'] ?? null,
                ]);

                return $shippingIntegration;
            } else {
                Log::error('Armex API error', [
                    'order_id' => $order->id,
                    'response' => $response->body(),
                ]);

                // حفظ فشل العملية
                ShippingIntegration::create([
                    'order_id'         => $order->id,
                    'order_product_id' => $orderProduct->id,
                    'carrier_name'     => 'Armex',
                    'api_response'     => ['error' => $response->body()],
                    'status'           => 'failed',
                ]);

                return false;
            }
        } catch (\Exception $e) {
            Log::error('Armex shipping service error', [
                'order_product_id' => $orderProductId,
                'error'            => $e->getMessage(),
            ]);

            return false;
        }
    }

    /**
     * تتبع الشحنة
     */
    public function trackShipment($trackingNumber)
    {
        try {
            // التحقق من وضع الاختبار
            if ($this->isTestMode()) {
                // إنشاء بيانات تتبع اختبار
                $testTrackingData = [
                    'tracking_number' => $trackingNumber,
                    'status'          => 'In Transit',
                    'location'        => 'Test Warehouse',
                    'last_update'     => now()->format('Y-m-d H:i:s'),
                    'events'          => [
                        [
                            'date'        => now()->subHours(2)->format('Y-m-d H:i:s'),
                            'status'      => 'Package Picked Up',
                            'description' => 'Package has been picked up from sender',
                        ],
                        [
                            'date'        => now()->subHour()->format('Y-m-d H:i:s'),
                            'status'      => 'In Transit',
                            'description' => 'Package is in transit to destination',
                        ],
                    ],
                ];

                Log::info('Test Armex tracking data returned', [
                    'tracking_number' => $trackingNumber,
                ]);

                return $testTrackingData;
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type'  => 'application/json',
            ])->get($this->apiUrl . '/tracking/' . $trackingNumber);

            if ($response->successful()) {
                return $response->json();
            }

            return false;
        } catch (\Exception $e) {
            Log::error('Armex tracking error', [
                'tracking_number' => $trackingNumber,
                'error'           => $e->getMessage(),
            ]);

            return false;
        }
    }

    /**
     * طباعة ملصق الشحن
     */
    public function getShippingLabel($trackingNumber)
    {
        try {
            // التحقق من وضع الاختبار
            if ($this->isTestMode()) {
                // إنشاء ملصق شحن اختبار (PDF بسيط)
                $testLabelContent = $this->generateTestLabel($trackingNumber);

                Log::info('Test Armex shipping label generated', [
                    'tracking_number' => $trackingNumber,
                ]);

                return $testLabelContent;
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type'  => 'application/json',
            ])->get($this->apiUrl . '/labels/' . $trackingNumber);

            if ($response->successful()) {
                return $response->body();
            }

            return false;
        } catch (\Exception $e) {
            Log::error('Armex label error', [
                'tracking_number' => $trackingNumber,
                'error'           => $e->getMessage(),
            ]);

            return false;
        }
    }

    /**
     * إنشاء ملصق شحن اختبار
     */
    protected function generateTestLabel($trackingNumber)
    {
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Test Shipping Label</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                .label { border: 2px solid #000; padding: 20px; max-width: 400px; }
                .header { text-align: center; font-size: 18px; font-weight: bold; margin-bottom: 20px; }
                .tracking { font-size: 16px; margin-bottom: 15px; }
                .info { margin-bottom: 10px; }
                .barcode { text-align: center; font-family: monospace; font-size: 20px; margin: 20px 0; }
            </style>
        </head>
        <body>
            <div class="label">
                <div class="header">ARMEX SHIPPING LABEL</div>
                <div class="tracking">Tracking: ' . $trackingNumber . '</div>
                <div class="info"><strong>From:</strong> Test Sender</div>
                <div class="info"><strong>To:</strong> Test Recipient</div>
                <div class="info"><strong>Date:</strong> ' . now()->format('Y-m-d H:i:s') . '</div>
                <div class="barcode">*' . $trackingNumber . '*</div>
                <div style="text-align: center; font-size: 12px; color: #666;">
                    TEST LABEL - NOT FOR ACTUAL SHIPPING
                </div>
            </div>
        </body>
        </html>';

        return $html;
    }

    /**
     * إلغاء الشحنة
     */
    public function cancelShipment($trackingNumber)
    {
        try {
            // التحقق من وضع الاختبار
            if ($this->isTestMode()) {
                // إنشاء استجابة إلغاء اختبار
                $testCancelResponse = [
                    'tracking_number' => $trackingNumber,
                    'status'          => 'cancelled',
                    'message'         => 'Test shipment cancelled successfully',
                    'cancelled_at'    => now()->format('Y-m-d H:i:s'),
                ];

                Log::info('Test Armex shipment cancelled', [
                    'tracking_number' => $trackingNumber,
                ]);

                return $testCancelResponse;
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type'  => 'application/json',
            ])->delete($this->apiUrl . '/shipments/' . $trackingNumber);

            if ($response->successful()) {
                return $response->json();
            }

            return false;
        } catch (\Exception $e) {
            Log::error('Armex cancel shipment error', [
                'tracking_number' => $trackingNumber,
                'error'           => $e->getMessage(),
            ]);

            return false;
        }
    }
}
