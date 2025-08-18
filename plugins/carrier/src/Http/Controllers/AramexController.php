<?php
namespace Plugin\Carrier\Http\Controllers;

ers / AramexController . php:

php
<   ?php

namespace App\Http\Controllers;

use App\Services\AramexService;
use Illuminate\Http\Request;

class AramexController extends Controller
{
    protected $aramex;

    public function __construct(AramexService $aramex)
    {
        $this->aramex = $aramex;
    }

    public function createShipment(Request $request)
    {
        $shipmentData = [
            'Shipper'   => [
                'Contact' => [
                    'PersonName'   => 'John Doe',
                    'CompanyName'  => 'Example Corp',
                    'PhoneNumber1' => '+966500000000',
                ],
                'Address' => [
                    'Line1'       => '123 Main St',
                    'City'        => 'Riyadh',
                    'CountryCode' => 'SA',
                ],
            ],
            'Consignee' => [
                'Contact' => [
                    'PersonName'   => 'Ahmed Ali',
                    'CompanyName'  => 'Client Inc',
                    'PhoneNumber1' => '+966500000001',
                ],
                'Address' => [
                    'Line1'       => '456 Market St',
                    'City'        => 'Jeddah',
                    'CountryCode' => 'SA',
                ],
            ],
            'Details'   => [
                'ProductGroup'       => 'DOM', // DOM للسعودية، EXP للدولي
                'ProductType'        => 'CDS', // CDS للسعودية، EPX للدولي
                'PaymentType'        => 'P',   // P = Prepaid, C = Collect
                'NumberOfPieces'     => 1,
                'ActualWeight'       => [
                    'Value' => 1.5,
                    'Unit'  => 'KG',
                ],
                'GoodsOriginCountry' => 'SA',
            ],
        ];

        $response = $this->aramex->createShipment($shipmentData);
        return response()->json($response);
    }

    public function printLabel($shipmentNumber)
    {
        $response = $this->aramex->printLabel($shipmentNumber);
        return response()->json($response);
    }
}
