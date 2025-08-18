<?php
namespace Plugin\TlcommerceCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class SellerShippingCarrier extends Model
{
    protected $table = "tl_com_seller_shipping_carriers";

    protected $fillable = [
        'seller_id',
        'carrier_id',
        'is_active',
        'base_cost',
        'cost_per_kg',
        'cost_per_km',
        'min_cost',
        'max_cost',
        'shipping_zones',
        'excluded_zones',
        'weight_ranges',
        'distance_ranges',
        'api_credentials',
        'settings',
    ];

    protected $casts = [
        'is_active'       => 'boolean',
        'base_cost'       => 'decimal:2',
        'cost_per_kg'     => 'decimal:2',
        'cost_per_km'     => 'decimal:2',
        'min_cost'        => 'decimal:2',
        'max_cost'        => 'decimal:2',
        'shipping_zones'  => 'array',
        'excluded_zones'  => 'array',
        'weight_ranges'   => 'array',
        'distance_ranges' => 'array',
        'settings'        => 'array',
    ];

    /**
     * علاقة مع التاجر
     */
    public function seller()
    {
        return $this->belongsTo(\Core\Models\User::class, 'seller_id');
    }

    /**
     * علاقة مع شركة الشحن
     */
    public function carrier()
    {
        return $this->belongsTo(\Plugin\Carrier\Models\ShippingCarrier::class, 'carrier_id');
    }

    /**
     * تشفير بيانات API
     */
    public function setApiCredentialsAttribute($value)
    {
        $this->attributes['api_credentials'] = $value ? Crypt::encryptString($value) : null;
    }

    /**
     * فك تشفير بيانات API
     */
    public function getApiCredentialsAttribute($value)
    {
        return $value ? Crypt::decryptString($value) : null;
    }

    /**
     * حساب تكلفة الشحن
     */
    public function calculateShippingCost($weight = 0, $distance = 0, $zone = null)
    {
        $cost = $this->base_cost;

        // إضافة تكلفة الوزن
        if ($weight > 0 && $this->cost_per_kg > 0) {
            $cost += ($weight * $this->cost_per_kg);
        }

        // إضافة تكلفة المسافة
        if ($distance > 0 && $this->cost_per_km > 0) {
            $cost += ($distance * $this->cost_per_km);
        }

        // تطبيق نطاقات الوزن
        if ($this->weight_ranges && is_array($this->weight_ranges)) {
            foreach ($this->weight_ranges as $range) {
                if ($weight >= $range['min'] && $weight <= $range['max']) {
                    $cost = $range['cost'];
                    break;
                }
            }
        }

        // تطبيق نطاقات المسافة
        if ($this->distance_ranges && is_array($this->distance_ranges)) {
            foreach ($this->distance_ranges as $range) {
                if ($distance >= $range['min'] && $distance <= $range['max']) {
                    $cost = $range['cost'];
                    break;
                }
            }
        }

        // التحقق من الحد الأدنى والأقصى
        if ($cost < $this->min_cost) {
            $cost = $this->min_cost;
        }

        if ($this->max_cost && $cost > $this->max_cost) {
            $cost = $this->max_cost;
        }

        return round($cost, 2);
    }

    /**
     * التحقق من صحة المنطقة
     */
    public function isZoneValid($zone)
    {
        // التحقق من المناطق المستثناة
        if ($this->excluded_zones && in_array($zone, $this->excluded_zones)) {
            return false;
        }

        // التحقق من المناطق المسموحة
        if ($this->shipping_zones && ! empty($this->shipping_zones)) {
            return in_array($zone, $this->shipping_zones);
        }

        return true;
    }

    /**
     * تفعيل شركة الشحن (وإلغاء تفعيل الباقي)
     */
    public static function activateCarrier($sellerId, $carrierId)
    {
        // إلغاء تفعيل جميع شركات الشحن للتاجر
        self::where('seller_id', $sellerId)->update(['is_active' => false]);

        // تفعيل الشركة المحددة
        return self::updateOrCreate(
            ['seller_id' => $sellerId, 'carrier_id' => $carrierId],
            ['is_active' => true]
        );
    }

    /**
     * الحصول على شركة الشحن النشطة للتاجر
     */
    public static function getActiveCarrier($sellerId)
    {
        return self::where('seller_id', $sellerId)
            ->where('is_active', true)
            ->with('carrier')
            ->first();
    }

    /**
     * الحصول على جميع شركات الشحن للتاجر
     */
    public static function getSellerCarriers($sellerId)
    {
        return self::where('seller_id', $sellerId)
            ->with('carrier')
            ->get();
    }
}
