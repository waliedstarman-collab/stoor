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

# إعداد متغيرات البيئة الافتراضية
ENV PORT=10000
ENV APP_ENV=production
ENV APP_DEBUG=false

# فتح المنفذ
EXPOSE $PORT

# ⭐ استخدام سكربت البدء
RUN chmod +x start.sh
CMD ["/bin/bash", "start.sh"]