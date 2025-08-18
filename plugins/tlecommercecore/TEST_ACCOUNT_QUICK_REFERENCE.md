# مرجع سريع - بيانات حساب الاختبار أرمكس

## بيانات الاختبار الافتراضية

```env
# تفعيل وضع الاختبار
ARMEX_TEST_MODE=true

# بيانات API للاختبار
ARMEX_API_KEY=test_api_key_12345
ARMEX_USERNAME=test_user
ARMEX_PASSWORD=test_password_123
```

## تنسيق أرقام التتبع

```
ARMEX_TEST_{timestamp}_{order_product_id}
```

**مثال:**

```
ARMEX_TEST_1703123456_123
```

## بيانات التتبع الوهمية

- **الحالة**: "In Transit"
- **الموقع**: "Test Warehouse"
- **آخر تحديث**: الوقت الحالي
- **الأحداث**: تاريخين مع بيانات وهمية

## ملصقات الشحن

- **النوع**: HTML بسيط
- **المحتوى**: بيانات اختبار
- **العلامة**: "TEST LABEL - NOT FOR ACTUAL SHIPPING"

## التحقق من وضع الاختبار

```bash
php artisan tinker
```

```php
config('tlecommercecore.armex.test_mode')  // true = وضع الاختبار مفعل
config('tlecommercecore.armex.api_key')    // test_api_key_12345 = بيانات اختبار
```

## فحص السجلات

```bash
# سجلات الاختبار
tail -f storage/logs/laravel.log | grep -i "test.*armex"

# جميع سجلات أرمكس
tail -f storage/logs/laravel.log | grep -i "armex"
```

## أوامر الاختبار

```bash
# إنشاء شحنة اختبار
php artisan shipping:create-shipments --order-id=123

# إنشاء جميع الشحنات الجاهزة
php artisan shipping:create-shipments --all

# عرض ما سيتم إنشاؤه (بدون إنشاء فعلي)
php artisan shipping:create-shipments --all --dry-run
```

## التحول إلى الإنتاج

```env
# إيقاف وضع الاختبار
ARMEX_TEST_MODE=false

# تحديث بيانات API الحقيقية
ARMEX_API_KEY=your_real_api_key
ARMEX_USERNAME=your_real_username
ARMEX_PASSWORD=your_real_password
```

## ملاحظات مهمة

✅ **للاختبار**: استخدم البيانات الافتراضية  
❌ **للإنتاج**: لا تستخدم بيانات الاختبار  
📝 **التسجيل**: جميع العمليات مسجلة  
🔒 **الأمان**: لا يتم إرسال بيانات حقيقية في وضع الاختبار
