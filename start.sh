#!/bin/bash

echo "🚀 Starting application..."

# تشغيل الهجرات
php artisan migrate --force

# تشغيل الخادم
php artisan serve --host=0.0.0.0 --port=$PORT