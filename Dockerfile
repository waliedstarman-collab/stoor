FROM php:8.4-cli

# تثبيت dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpq-dev \
    libicu-dev \
    unzip \
    git \
    && docker-php-ext-install zip pdo pdo_pgsql intl

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# نسخ الملفات
COPY . .

# إنشاء مجلدات التخزين
RUN mkdir -p /app/bootstrap/cache \
    && mkdir -p /app/storage/framework/sessions \
    && mkdir -p /app/storage/framework/views \
    && mkdir -p /app/storage/framework/cache \
    && mkdir -p /app/storage/framework/testing \
    && mkdir -p /app/storage/logs \
    && chmod -R 777 /app/bootstrap/cache \
    && chmod -R 777 /app/storage

# تثبيت الحزم
RUN composer install --no-dev --optimize-autoloader --ignore-platform-req=php --no-scripts

# ⭐ نسخ start.sh وجعله قابلاً للتنفيذ
COPY start.sh /app/start.sh
RUN chmod +x /app/start.sh

ENV PORT=10000
ENV APP_ENV=production
ENV APP_DEBUG=false

EXPOSE $PORT

# ⭐ استخدام start.sh كأمر التشغيل
CMD ["/bin/bash", "/app/start.sh"]