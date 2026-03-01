# حل مشكلة 403 Forbidden

## سبب المشكلة
خطأ 403 يحدث عادة بسبب:
1. ❌ صلاحيات المجلدات/الملفات
2. ❌ ملف .htaccess غير متوافق
3. ❌ Document Root غير صحيح

---

## الحلول السريعة (مرتبة حسب الأهمية)

### 1️⃣ ضبط صلاحيات المجلدات (الأهم!)

افتح **Terminal في Hostinger** وشغل:

```bash
cd public_html
chmod -R 755 .
chmod -R 755 storage
chmod -R 755 bootstrap/cache
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;
```

أو من **File Manager**:
- اضغط كليك يمين على مجلد المشروع → **Permissions**
- المجلدات: `755`
- الملفات: `644`

---

### 2️⃣ التأكد من Document Root

في **Hostinger cPanel**:
1. اذهب إلى **Domains** أو **Website**
2. اختر الدومين الخاص بك
3. تأكد أن **Document Root** يشير إلى:
   ```
   public_html/public
   ```
   
   أو إذا كان المشروع في مجلد فرعي:
   ```
   public_html/اسم_المجلد/public
   ```

---

### 3️⃣ تحديث ملف .htaccess في الجذر

**الملف الحالي تم تحديثه تلقائياً!** ✅

لكن إذا استمرت المشكلة، جرب هذا الملف البديل:

#### ملف `.htaccess` في الجذر (خارج public):
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

أو أبسط:
```apache
RewriteEngine On
RewriteRule ^(.*)$ public/$1 [L]
```

---

### 4️⃣ التأكد من ملف .htaccess داخل public

يجب أن يكون ملف `public/.htaccess` كالتالي:

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Rewrite To Front Controller
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

---

### 5️⃣ إذا Document Root يشير مباشرة إلى public_html

في هذه الحالة، **احذف ملف .htaccess من الجذر** أو اجعله فارغاً:

```bash
cd public_html
rm .htaccess
# أو اجعله فارغ
echo "" > .htaccess
```

---

### 6️⃣ مسح الكاش (مهم!)

```bash
cd public_html
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# إعادة بناء الكاش
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

### 7️⃣ التحقق من ملف .env

تأكد من هذه الإعدادات في `.env`:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com
```

⚠️ **مهم:** اجعل `APP_DEBUG=false` في الإنتاج!

---

### 8️⃣ التأكد من PHP Version

تأكد أن **PHP 8.1+** مفعل:

```bash
php -v
```

إذا كان قديماً، غيره من **cPanel → Select PHP Version**

---

## الحلول المتقدمة

### إذا استمرت المشكلة، جرب:

#### أ) حذف ملف .htaccess من الجذر تماماً
```bash
cd public_html
rm .htaccess
```

ثم تأكد أن Document Root يشير إلى `public_html/public`

#### ب) تعطيل mod_security مؤقتاً
أضف في بداية ملف `.htaccess`:
```apache
<IfModule mod_security.c>
    SecFilterEngine Off
    SecFilterScanPOST Off
</IfModule>
```

#### ج) فحص سجل الأخطاء
افتح **File Manager → Error Log** أو:
```bash
tail -f storage/logs/laravel.log
```

---

## نصائح للوقاية

### ✅ اجعل هذه الملفات غير قابلة للوصول من المتصفح:

أضف في `public/.htaccess`:
```apache
# Deny access to .env
<Files .env>
    Order allow,deny
    Deny from all
</Files>

# Deny access to sensitive files
<FilesMatch "^\.">
    Order allow,deny
    Deny from all
</FilesMatch>
```

### ✅ تأمين مجلد storage
```bash
chmod -R 755 storage
chown -R www-data:www-data storage  # إذا كان متاحاً
```

---

## اختبار الحل

بعد تطبيق الحلول، جرب:

1. افتح الموقع: `https://your-domain.com`
2. جرب تسجيل الدخول: `https://your-domain.com/admin/login`
3. تحقق من الصلاحيات: `ls -la storage`

---

## إذا لم يعمل أي حل

اتصل بـ **دعم Hostinger** وأعطهم:
1. رسالة الخطأ الكاملة
2. محتوى ملف `storage/logs/laravel.log`
3. اسأل عن:
   - كيفية ضبط Document Root
   - هل mod_rewrite مفعل؟
   - ما هي PHP Version المستخدمة؟

---

## تلخيص الخطوات

```bash
# 1. ضبط الصلاحيات
chmod -R 755 storage bootstrap/cache

# 2. مسح الكاش
php artisan config:clear && php artisan cache:clear

# 3. حذف .htaccess من الجذر (إذا Document Root صحيح)
rm .htaccess

# 4. تأكد من Document Root → public_html/public
```

---

**آخر تحديث:** 1 مارس 2026
