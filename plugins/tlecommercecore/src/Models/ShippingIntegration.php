<?php
namespace Plugin\TlcommerceCore\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingIntegration extends Model
{
    protected $table = "tl_com_shipping_integrations";

    protected $fillable = [
        'order_id',
        'order_product_id',
        'carrier_name',
        'tracking_number',
        'shipping_label_url',
        'api_response',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'api_response' => 'array',
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }

    public function orderProduct()
    {
        return $this->belongsTo(OrderHasProducts::class, 'order_product_id');
    }
}
