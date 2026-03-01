# دليل نشر المشروع على Hostinger

## خطأ 500 Server Error - الحلول

عند ظهور خطأ 500، اتبع الخطوات التالية بالترتيب:

---

## 1. التأكد من Document Root

في Hostinger، يجب أن يشير المجلد الرئيسي (Document Root) إلى مجلد `public`:

1. ادخل على cpanel في Hostinger
2. اذهب إلى **File Manager**
3. تأكد أن الدومين يشير إلى مجلد `public`:
   - الطريقة الأولى: ضع المشروع في `public_html` واجعل Document Root يشير إلى `public_html/public`
   - الطريقة الثانية: انقل محتويات مجلد `public` إلى `public_html` (اتبع الخطوات أدناه)

---

## 2. ضبط صلاحيات المجلدات (مهم جداً!)

افتح Terminal في Hostinger وشغل هذه الأوامر:

```bash
cd public_html
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

أو من File Manager:
- كليك يمين على مجلد `storage` → Permissions → 755
- كليك يمين على مجلد `bootstrap/cache` → Permissions → 755

---

## 3. إعداد ملف .env

1. انسخ محتويات `.env.example`
2. أنشئ ملف جديد اسمه `.env`
3. غير الإعدادات التالية:

```env
APP_NAME="مكتب العقارات"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

⚠️ اجعل `APP_DEBUG=false` في الإنتاج!

---

## 4. توليد APP_KEY

افتح Terminal في Hostinger وشغل:

```bash
cd public_html
php artisan key:generate
```

---

## 5. تثبيت Dependencies

```bash
composer install --optimize-autoloader --no-dev
```

إذا لم يعمل، جرب:
```bash
composer update --no-dev
```

---

## 6. تشغيل Migrations

```bash
php artisan migrate --force
```

---

## 7. مسح الكاش ورفع الأداء

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# ثم إنشاء كاش جديد
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 8. إنشاء Storage Link

```bash
php artisan storage:link
```

---

## 9. إذا كان الدومين يشير مباشرة إلى public_html

إذا لم تستطع تغيير Document Root، اتبع هذه الخطوات:

### أ. نقل الملفات
1. انقل كل محتويات مجلد `public` إلى `public_html`
2. احذف مجلد `public` الفارغ

### ب. تعديل index.php
افتح `public_html/index.php` وغير السطر:

من:
```php
require __DIR__.'/../vendor/autoload.php';
```

إلى:
```php
require __DIR__.'/vendor/autoload.php';
```

ومن:
```php
$app = require_once __DIR__.'/../bootstrap/app.php';
```

إلى:
```php
$app = require_once __DIR__.'/bootstrap/app.php';
```

---

## 10. فحص السجلات (Logs)

إذا استمر الخطأ، افتح:
```
storage/logs/laravel.log
```

وابحث عن آخر خطأ حدث.

---

## 11. تعطيل Maintenance Mode (لو كان مفعل)

```bash
php artisan up
```

---

## نصائح إضافية

### تفعيل Error Reporting (للتشخيص فقط)
في ملف `.env`:
```env
APP_DEBUG=true
```
⚠️ تذكر إرجاعه إلى `false` بعد حل المشكلة!

### التأكد من PHP Version
تأكد أن Hostinger يستخدم PHP 8.1 أو أعلى:
```bash
php -v
```

إذا كان الإصدار قديماً، غيره من cpanel → **Select PHP Version**

---

## الأخطاء الشائعة وحلولها

### خطأ: "No default Filament panel is set"
✅ تم حله بالفعل في الكود

### خطأ: "Class not found"
```bash
composer dump-autoload
```

### خطأ: "SQLSTATE[HY000]"
- تأكد من بيانات الاتصال بقاعدة البيانات في `.env`
- تأكد أن قاعدة البيانات موجودة

### خطأ: "The stream or file storage/logs/laravel.log could not be opened"
```bash
chmod -R 775 storage
chown -R www-data:www-data storage
```

---

## التواصل

إذا استمرت المشكلة، شارك محتوى ملف:
- `storage/logs/laravel.log` (آخر 100 سطر)
- رسالة الخطأ الكاملة

---

**ملاحظة مهمة:** لا تنسَ إضافة `.env` إلى `.gitignore` ولا ترفعه على GitHub للحماية!
