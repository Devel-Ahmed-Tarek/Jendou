<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Armex Shipping API Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for Armex shipping API integration.
    |
    */

    'api_url'                    => env('ARMEX_API_URL', 'https://api.armex.com'),
    'api_key'                    => env('ARMEX_API_KEY', 'test_api_key_12345'),
    'username'                   => env('ARMEX_USERNAME', 'test_user'),
    'password'                   => env('ARMEX_PASSWORD', 'test_password_123'),

    /*
    |--------------------------------------------------------------------------
    | Default Settings
    |--------------------------------------------------------------------------
    |
    | Default settings for shipping integration.
    |
    */

    'default_weight'             => env('ARMEX_DEFAULT_WEIGHT', 1),  // kg
    'default_length'             => env('ARMEX_DEFAULT_LENGTH', 10), // cm
    'default_width'              => env('ARMEX_DEFAULT_WIDTH', 10),  // cm
    'default_height'             => env('ARMEX_DEFAULT_HEIGHT', 10), // cm

    /*
    |--------------------------------------------------------------------------
    | Auto Create Shipment
    |--------------------------------------------------------------------------
    |
    | Automatically create shipment when order status changes to ready_to_ship.
    |
    */

    'auto_create_shipment'       => env('ARMEX_AUTO_CREATE_SHIPMENT', true),

    /*
    |--------------------------------------------------------------------------
    | Notification Settings
    |--------------------------------------------------------------------------
    |
    | Settings for notifications when shipment status changes.
    |
    */

    'notify_on_shipment_created' => env('ARMEX_NOTIFY_ON_SHIPMENT_CREATED', true),
    'notify_on_shipment_failed'  => env('ARMEX_NOTIFY_ON_SHIPMENT_FAILED', true),

    /*
    |--------------------------------------------------------------------------
    | Test Mode Settings
    |--------------------------------------------------------------------------
    |
    | Settings for test mode functionality.
    |
    */

    'test_mode'                  => env('ARMEX_TEST_MODE', true),
    'test_api_key'               => env('ARMEX_TEST_API_KEY', 'test_api_key_12345'),
    'test_username'              => env('ARMEX_TEST_USERNAME', 'test_user'),
    'test_password'              => env('ARMEX_TEST_PASSWORD', 'test_password_123'),
];
