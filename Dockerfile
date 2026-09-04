FROM php:8.4-cli

# تثبيت dependencies المطلوبة
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpq-dev \
    libicu-dev \
    unzip \
    git \
    && docker-php-ext-install zip pdo pdo_pgsql intl

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# إنشاء مجلد العمل
WORKDIR /app

# نسخ الملفات
COPY . .
FROM php:8.4-cli

# تثبيت dependencies المطلوبة
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpq-dev \
    libicu-dev \
    unzip \
    git \
    && docker-php-ext-install zip pdo pdo_pgsql intl

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# إنشاء مجلد العمل
WORKDIR /app

# نسخ الملفات
COPY . .

# إنشاء جميع مجلدات Laravel المطلوبة ومنحها صلاحيات 777
RUN mkdir -p /app/bootstrap/cache \
    && mkdir -p /app/storage/framework/sessions \
    && mkdir -p /app/storage/framework/views \
    && mkdir -p /app/storage/framework/cache \
    && mkdir -p /app/storage/framework/testing \
    && mkdir -p /app/storage/logs \
    && chmod -R 777 /app/bootstrap/cache \
    && chmod -R 777 /app/storage

# تثبيت الحزم (بدون scripts)
RUN composer install --no-dev --optimize-autoloader --ignore-platform-req=php --no-scripts

# ⭐ تشغيل الهجرات وإنشاء مستخدم أدمن (للخطة المجانية)
RUN php artisan migrate --force || true
RUN php artisan tinker --execute="if(!\App\Models\User::where('email','admin@example.com')->exists()){ \App\Models\User::create(['name'=>'Admin','email'=>'admin@example.com','password'=>bcrypt('password')]); }"

# إعداد متغيرات البيئة الافتراضية
ENV PORT=10000
ENV APP_ENV=production
ENV APP_DEBUG=false

# فتح المنفذ
EXPOSE $PORT

# أمر التشغيل
CMD php artisan serve --host=0.0.0.0 --port=$PORT
# إنشاء جميع مجلدات Laravel المطلوبة ومنحها صلاحيات 777
RUN mkdir -p /app/bootstrap/cache \
    && mkdir -p /app/storage/framework/sessions \
    && mkdir -p /app/storage/framework/views \
    && mkdir -p /app/storage/framework/cache \
    && mkdir -p /app/storage/framework/testing \
    && mkdir -p /app/storage/logs \
    && chmod -R 777 /app/bootstrap/cache \
    && chmod -R 777 /app/storage

# تثبيت الحزم (بدون scripts)
RUN composer install --no-dev --optimize-autoloader --ignore-platform-req=php --no-scripts

# ⭐ تشغيل الهجرات وإنشاء مستخدم أدمن (للخطة المجانية)
RUN php artisan migrate --force || true
RUN php artisan tinker --execute="if(!\App\Models\User::where('email','admin@yhoo.com')->exists()){ \App\Models\User::create(['name'=>'Admin','email'=>'admin@yahoo.com','password'=>bcrypt('12345678')]); }"

# إعداد متغيرات البيئة الافتراضية
ENV PORT=10000
ENV APP_ENV=production
ENV APP_DEBUG=false

# فتح المنفذ
EXPOSE $PORT

# أمر التشغيل
CMD php artisan serve --host=0.0.0.0 --port=$PORT