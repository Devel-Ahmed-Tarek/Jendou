<?php
namespace Plugin\Carrier\Http\Services;

use SoapClient;

class AramexService
{
    protected $client;
    protected $accountDetails;

    public function __construct()
    {
        // بيانات الحساب (يمكن وضعها في ملف .env)
        $this->accountDetails = [
            'UserName'           => env('ARAMEX_USERNAME', 'testingapi@aramex.com'),
            'Password'           => env('ARAMEX_PASSWORD', 'R123456789$r'),
            'Version'            => 'v1.0',
            'AccountNumber'      => env('ARAMEX_ACCOUNT_NUMBER', '20016'),
            'AccountPin'         => env('ARAMEX_ACCOUNT_PIN', '331421'),
            'AccountEntity'      => env('ARAMEX_ACCOUNT_ENTITY', 'AMM'),
            'AccountCountryCode' => env('ARAMEX_COUNTRY_CODE', 'JO'),
        ];

        // تهيئة SOAP Client
        $this->client = new SoapClient(
            'https://ws.dev.aramex.net/shippingapi/shipping/service_1_0.svc?wsdl',
            ['trace' => 1]
        );
    }

    /**
     * إنشاء شحنة جديدة
     */
    public function createShipment(array $shipmentData)
    {
        $request = [
            'ClientInfo'  => $this->accountDetails,
            'Transaction' => [
                'Reference1' => 'Order #12345',
            ],
            'Shipments'   => [
                'Shipment' => $shipmentData,
            ],
        ];

        try {
            $response = $this->client->CreateShipments($request);
            return $response;
        } catch (\Exception $e) {
            return [
                'error'   => $e->getMessage(),
                'request' => $this->client->__getLastRequest(),
            ];
        }
    }

    /**
     * طباعة ملصق الشحنة (Label)
     */
    public function printLabel($shipmentNumber)
    {
        $request = [
            'ClientInfo'     => $this->accountDetails,
            'Transaction'    => [
                'Reference1' => 'Label Print',
            ],
            'ShipmentNumber' => $shipmentNumber,
        ];

        try {
            $response = $this->client->PrintLabel($request);
            return $response;
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
