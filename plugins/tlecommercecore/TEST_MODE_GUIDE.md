# دليل وضع الاختبار - تكامل أرمكس

## نظرة عامة

تم إضافة وضع الاختبار إلى نظام التكامل مع أرمكس للسماح باختبار النظام بدون الحاجة إلى بيانات API حقيقية.

## الميزات

### ✅ بيانات اختبار افتراضية

- API Key: `test_api_key_12345`
- Username: `test_user`
- Password: `test_password_123`

### ✅ استجابات اختبار واقعية

- إنشاء شحنات ببيانات اختبار
- تتبع الشحنات ببيانات وهمية
- طباعة ملصقات شحن اختبار
- إلغاء الشحنات

### ✅ تسجيل العمليات

- جميع عمليات الاختبار مسجلة في السجلات
- يمكن تتبع جميع العمليات

## الإعداد

### 1. تفعيل وضع الاختبار

أضف المتغيرات التالية إلى ملف `.env`:

```env
# تفعيل وضع الاختبار
ARMEX_TEST_MODE=true

# بيانات اختبار افتراضية
ARMEX_API_KEY=test_api_key_12345
ARMEX_USERNAME=test_user
ARMEX_PASSWORD=test_password_123

# أو يمكنك استخدام المتغيرات المخصصة للاختبار
ARMEX_TEST_API_KEY=test_api_key_12345
ARMEX_TEST_USERNAME=test_user
ARMEX_TEST_PASSWORD=test_password_123
```

### 2. التحقق من الإعدادات

يمكنك التحقق من الإعدادات من خلال:

```bash
php artisan tinker
```

```php
config('tlecommercecore.armex.test_mode')  // يجب أن يعيد true
config('tlecommercecore.armex.api_key')    // يجب أن يعيد test_api_key_12345
```

## الاستخدام

### 1. إنشاء شحنة اختبار

```bash
# إنشاء شحنة لطلب محدد
php artisan shipping:create-shipments --order-id=123

# إنشاء شحنات لجميع الطلبات الجاهزة
php artisan shipping:create-shipments --all
```

### 2. تتبع شحنة اختبار

```bash
# تتبع شحنة عبر API
curl -X POST http://your-domain/api/shipping/track \
  -H "Content-Type: application/json" \
  -d '{"tracking_number": "ARMEX_TEST_1234567890_123"}'
```

### 3. طباعة ملصق اختبار

```bash
# طباعة ملصق شحن
curl -X GET "http://your-domain/admin/shipping-integrations/print-label?tracking_number=ARMEX_TEST_1234567890_123"
```

## بيانات الاختبار

### أرقام التتبع

- تنسيق: `ARMEX_TEST_{timestamp}_{order_product_id}`
- مثال: `ARMEX_TEST_1703123456_123`

### بيانات التتبع

- الحالة: "In Transit"
- الموقع: "Test Warehouse"
- الأحداث: تاريخين مع بيانات وهمية

### ملصقات الشحن

- ملصق HTML بسيط
- يحتوي على بيانات اختبار
- علامة واضحة "TEST LABEL"

## السجلات

### فحص سجلات الاختبار

```bash
# عرض سجلات الاختبار
tail -f storage/logs/laravel.log | grep -i "test.*armex"

# أو
tail -f storage/logs/laravel.log | grep -i "test mode"
```

### أمثلة على السجلات

```
[2024-01-01 10:00:00] local.INFO: Armex service running in test mode
[2024-01-01 10:00:01] local.INFO: Test Armex shipment created successfully
[2024-01-01 10:00:02] local.INFO: Test Armex tracking data returned
[2024-01-01 10:00:03] local.INFO: Test Armex shipping label generated
```

## اختبار الواجهة

### 1. الوصول إلى لوحة التحكم

- انتقل إلى `/admin/shipping-integrations`
- ستجد الشحنات التي تم إنشاؤها في وضع الاختبار

### 2. اختبار التتبع

- انقر على "Track Shipment" لأي شحنة
- ستظهر بيانات تتبع وهمية

### 3. اختبار طباعة الملصقات

- انقر على "Print Label"
- سيتم إنشاء ملصق HTML بسيط

## التحول إلى الإنتاج

### 1. إيقاف وضع الاختبار

```env
ARMEX_TEST_MODE=false
```

### 2. تحديث بيانات API الحقيقية

```env
ARMEX_API_KEY=your_real_api_key
ARMEX_USERNAME=your_real_username
ARMEX_PASSWORD=your_real_password
```

### 3. التحقق من الإعدادات

```bash
php artisan tinker
```

```php
config('tlecommercecore.armex.test_mode')  // يجب أن يعيد false
config('tlecommercecore.armex.api_key')    // يجب أن يعيد API key الحقيقي
```

## استكشاف الأخطاء

### مشاكل شائعة

1. **عدم تفعيل وضع الاختبار**

   - تحقق من `ARMEX_TEST_MODE=true`
   - تحقق من بيانات API

2. **عدم ظهور بيانات التتبع**

   - تحقق من السجلات
   - تأكد من أن الشحنة تم إنشاؤها في وضع الاختبار

3. **مشاكل في طباعة الملصقات**
   - تحقق من أن رقم التتبع يبدأ بـ `ARMEX_TEST_`
   - تحقق من السجلات للأخطاء

### فحص السجلات

```bash
# فحص جميع سجلات أرمكس
grep -i "armex" storage/logs/laravel.log

# فحص سجلات الاختبار فقط
grep -i "test.*armex" storage/logs/laravel.log
```

## ملاحظات مهمة

1. **لا تستخدم في الإنتاج**: وضع الاختبار مخصص للتطوير والاختبار فقط
2. **بيانات وهمية**: جميع البيانات المولدة هي بيانات اختبار وهمية
3. **التسجيل**: جميع العمليات مسجلة في السجلات
4. **الأمان**: لا يتم إرسال أي بيانات حقيقية إلى API أرمكس

## الدعم

إذا واجهت أي مشاكل في وضع الاختبار:

1. تحقق من السجلات
2. تأكد من صحة الإعدادات
3. تأكد من تشغيل النظام
4. تواصل مع فريق التطوير
