# خطوات إعداد وتشغيل نظام التكامل مع الشحن

## الخطوة 1: تشغيل Migration

```bash
php artisan migrate
```

## الخطوة 2: إضافة متغيرات البيئة

### للاختبار (مُوصى به للمبتدئين)

أضف المتغيرات التالية إلى ملف `.env`:

```env
# تفعيل وضع الاختبار
ARMEX_TEST_MODE=true

# بيانات اختبار افتراضية
ARMEX_API_KEY=test_api_key_12345
ARMEX_USERNAME=test_user
ARMEX_PASSWORD=test_password_123

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

### للإنتاج

```env
# Armex API Configuration (للإنتاج)
ARMEX_API_URL=https://api.armex.com
ARMEX_API_KEY=your_real_api_key_here
ARMEX_USERNAME=your_real_username_here
ARMEX_PASSWORD=your_real_password_here

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

## الخطوة 3: تسجيل Service Provider

أضف Service Provider التالي إلى ملف `config/app.php` في مصفوفة `providers`:

```php
'providers' => [
    // ...
    Plugin\TlcommerceCore\Providers\ShippingIntegrationServiceProvider::class,
],
```

## الخطوة 4: تشغيل Queue Worker

```bash
php artisan queue:work
```

أو يمكنك تشغيله في الخلفية:

```bash
php artisan queue:work --daemon
```

## الخطوة 5: اختبار النظام

### اختبار وضع الاختبار (مُوصى به)

إذا كنت تستخدم بيانات الاختبار الافتراضية:

```bash
# إنشاء شحنة لطلب محدد
php artisan shipping:create-shipments --order-id=123

# إنشاء شحنات لجميع الطلبات الجاهزة
php artisan shipping:create-shipments --all

# عرض ما سيتم إنشاؤه بدون إنشاء فعلي
php artisan shipping:create-shipments --all --dry-run
```

### التحقق من وضع الاختبار

```bash
php artisan tinker
```

```php
// التحقق من وضع الاختبار
config('tlecommercecore.armex.test_mode')  // يجب أن يعيد true

// التحقق من بيانات API
config('tlecommercecore.armex.api_key')    // يجب أن يعيد test_api_key_12345
```

### اختبار إعادة محاولة الشحنات الفاشلة

```bash
php artisan shipping:retry-failed-shipments
```

### فحص السجلات

```bash
# عرض سجلات الاختبار
tail -f storage/logs/laravel.log | grep -i "test.*armex"

# أو
tail -f storage/logs/laravel.log | grep -i "test mode"
```

## الخطوة 6: الوصول إلى لوحة التحكم

1. انتقل إلى `/admin/shipping-integrations`
2. ستجد قائمة بجميع الشحنات
3. يمكنك تصفية الشحنات حسب الحالة والناقل
4. يمكنك عرض تفاصيل الشحنة وطباعة الملصقات

## الخطوة 7: إعداد Cron Job (اختياري)

أضف Cron Job التالي لتشغيل المهام المجدولة:

```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

## اختبار API

### إنشاء شحنة عبر API

```bash
curl -X POST http://your-domain/admin/shipping-integrations/create \
  -H "Content-Type: application/json" \
  -H "X-CSRF-TOKEN: your-csrf-token" \
  -d '{"order_product_id": 123}'
```

### تتبع الشحنة عبر API

```bash
curl -X POST http://your-domain/api/shipping/track \
  -H "Content-Type: application/json" \
  -d '{"tracking_number": "ARMEX123456789"}'
```

## استكشاف الأخطاء

### فحص السجلات

```bash
tail -f storage/logs/laravel.log | grep -i armex
```

### فحص حالة Queue

```bash
php artisan queue:failed
php artisan queue:retry all
```

### فحص قاعدة البيانات

```sql
-- عرض جميع الشحنات
SELECT * FROM tl_com_shipping_integrations;

-- عرض الشحنات الفاشلة
SELECT * FROM tl_com_shipping_integrations WHERE status = 'failed';

-- عرض الشحنات الناجحة
SELECT * FROM tl_com_shipping_integrations WHERE status = 'success';
```

## التحول إلى الإنتاج

### من وضع الاختبار إلى الإنتاج

1. **إيقاف وضع الاختبار**

   ```env
   ARMEX_TEST_MODE=false
   ```

2. **تحديث بيانات API الحقيقية**

   ```env
   ARMEX_API_KEY=your_real_api_key
   ARMEX_USERNAME=your_real_username
   ARMEX_PASSWORD=your_real_password
   ```

3. **التحقق من الإعدادات**
   ```bash
   php artisan tinker
   ```
   ```php
   config('tlecommercecore.armex.test_mode')  // يجب أن يعيد false
   config('tlecommercecore.armex.api_key')    // يجب أن يعيد API key الحقيقي
   ```

## ملاحظات مهمة

1. **للاختبار**: استخدم بيانات الاختبار الافتراضية
2. **للإنتاج**: تأكد من أن API أرمكس متاح ويعمل بشكل صحيح
3. تأكد من صحة بيانات API (API Key, Username, Password)
4. تأكد من تشغيل Queue Worker لمعالجة الشحنات في الخلفية
5. راجع السجلات بانتظام للتحقق من الأخطاء
6. تأكد من أن الطلبات تحتوي على عنوان شحن صحيح

## الدعم

إذا واجهت أي مشاكل، يرجى:

1. فحص سجلات الأخطاء في `storage/logs/laravel.log`
2. التأكد من صحة إعدادات API
3. اختبار الاتصال بـ API أرمكس
4. التواصل مع فريق التطوير للمساعدة
