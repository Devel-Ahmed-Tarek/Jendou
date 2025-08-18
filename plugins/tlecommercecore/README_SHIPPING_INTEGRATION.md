# Shipping Integration with Armex

## نظرة عامة

تم إضافة ميزة التكامل مع شركة الشحن أرمكس (Armex) إلى النظام. هذه الميزة تتيح إنشاء شحنات تلقائياً عندما يتم تحديث حالة الطلب إلى "جاهز للشحن".

## الميزات

### 1. إنشاء الشحنات التلقائي

- يتم إنشاء شحنة تلقائياً عند تغيير حالة الطلب إلى "جاهز للشحن"
- يتم إرسال بيانات العميل والمنتج إلى API أرمكس
- يتم حفظ رقم التتبع في قاعدة البيانات

### 2. إدارة الشحنات

- عرض قائمة جميع الشحنات
- تصفية الشحنات حسب الحالة والناقل
- عرض تفاصيل الشحنة
- طباعة ملصقات الشحن

### 3. تتبع الشحنات

- تتبع حالة الشحنة عبر API أرمكس
- عرض تاريخ التتبع
- عرض تفاصيل التحديثات

### 4. إدارة الأخطاء

- إعادة المحاولة للشحنات الفاشلة
- إلغاء الشحنات
- تسجيل الأخطاء في السجلات

## التثبيت والإعداد

### 1. تشغيل Migration

```bash
php artisan migrate
```

### 2. إضافة متغيرات البيئة

أضف المتغيرات التالية إلى ملف `.env`:

```env
# Armex API Configuration
ARMEX_API_URL=https://api.armex.com
ARMEX_API_KEY=your_api_key_here
ARMEX_USERNAME=your_username_here
ARMEX_PASSWORD=your_password_here

# Default Package Settings
ARMEX_DEFAULT_WEIGHT=1
ARMEX_DEFAULT_LENGTH=10
ARMEX_DEFAULT_WIDTH=10
ARMEX_DEFAULT_HEIGHT=10

# Auto Create Shipment
ARMEX_AUTO_CREATE_SHIPMENT=true

# Notification Settings
ARMEX_NOTIFY_ON_SHIPMENT_CREATED=true
ARMEX_NOTIFY_ON_SHIPMENT_FAILED=true
```

### 3. تسجيل Service Provider

أضف Service Provider التالي إلى ملف `config/app.php`:

```php
'providers' => [
    // ...
    Plugin\TlcommerceCore\Providers\ShippingIntegrationServiceProvider::class,
],
```

## الاستخدام

### 1. الوصول إلى لوحة التحكم

- انتقل إلى `/admin/shipping-integrations`
- ستجد قائمة بجميع الشحنات

### 2. إنشاء شحنة يدوياً

- يمكن إنشاء شحنة يدوياً من خلال API أو من لوحة التحكم
- استخدم endpoint: `POST /admin/shipping-integrations/create`

### 3. تتبع الشحنة

- استخدم endpoint: `POST /admin/shipping-integrations/track`
- أو استخدم API العام: `POST /api/shipping/track`

### 4. طباعة ملصق الشحن

- استخدم endpoint: `GET /admin/shipping-integrations/print-label?tracking_number=XXX`

## API Endpoints

### إنشاء شحنة

```http
POST /admin/shipping-integrations/create
Content-Type: application/json

{
    "order_product_id": 123
}
```

### تتبع الشحنة

```http
POST /admin/shipping-integrations/track
Content-Type: application/json

{
    "tracking_number": "ARMEX123456789"
}
```

### API العام لتتبع الشحنة

```http
POST /api/shipping/track
Content-Type: application/json

{
    "tracking_number": "ARMEX123456789"
}
```

## قاعدة البيانات

### جدول `tl_com_shipping_integrations`

| العمود             | النوع     | الوصف                                |
| ------------------ | --------- | ------------------------------------ |
| id                 | bigint    | المعرف الفريد                        |
| order_id           | bigint    | معرف الطلب                           |
| order_product_id   | bigint    | معرف منتج الطلب                      |
| carrier_name       | varchar   | اسم الناقل                           |
| tracking_number    | varchar   | رقم التتبع                           |
| shipping_label_url | text      | رابط ملصق الشحن                      |
| api_response       | json      | استجابة API                          |
| status             | enum      | حالة الشحنة (pending/success/failed) |
| created_at         | timestamp | تاريخ الإنشاء                        |
| updated_at         | timestamp | تاريخ التحديث                        |

## الأمان

### الصلاحيات المطلوبة

- `Manage Shipping Integration`: للوصول إلى لوحة التحكم
- يجب تسجيل الدخول للوصول إلى جميع endpoints

### حماية API

- جميع endpoints محمية بـ CSRF token
- API العام لا يحتاج إلى تسجيل دخول ولكن يجب التحقق من صحة البيانات

## استكشاف الأخطاء

### مشاكل شائعة

1. **فشل في إنشاء الشحنة**

   - تحقق من صحة بيانات API
   - تحقق من اتصال الإنترنت
   - راجع سجلات الأخطاء

2. **عدم تحديث رقم التتبع**

   - تحقق من استجابة API
   - تأكد من وجود حقل `tracking_number` في الاستجابة

3. **مشاكل في التتبع**
   - تحقق من صحة رقم التتبع
   - تأكد من أن الشحنة موجودة في نظام أرمكس

### سجلات الأخطاء

يتم تسجيل جميع الأخطاء في ملف `storage/logs/laravel.log` مع الكلمات المفتاحية:

- `Armex shipping service error`
- `Armex API error`
- `Armex tracking error`

## التخصيص

### إضافة ناقل شحن جديد

1. أنشئ خدمة جديدة مشابهة لـ `ArmexShippingService`
2. أضف الناقل إلى قائمة الناقلين في الواجهة
3. حدث Observer للتعامل مع الناقل الجديد

### تخصيص رسائل الإشعارات

يمكن تخصيص رسائل الإشعارات من خلال ملفات الترجمة في مجلد `lang/`.

## الدعم

للمساعدة أو الإبلاغ عن مشاكل، يرجى التواصل مع فريق التطوير.
