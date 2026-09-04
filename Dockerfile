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

# نسخ الملفات
WORKDIR /app
RUN mkdir -p /app/bootstrap/cache && chmod -R 775 /app/bootstrap/cache
COPY . .

# تثبيت الحزم (بدون scripts لتجنب الأخطاء)
RUN composer install --no-dev --optimize-autoloader --ignore-platform-req=php --no-scripts

# إعداد متغيرات البيئة الافتراضية
ENV PORT=10000
ENV APP_ENV=production

# فتح المنفذ
EXPOSE $PORT

# أمر التشغيل
CMD php artisan serve --host=0.0.0.0 --port=$PORT