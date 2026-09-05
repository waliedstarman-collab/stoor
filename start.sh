#!/bin/bash
set -e

echo "🚀 Starting Laravel application..."

# إنشاء مجلدات Laravel الضرورية
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/framework/cache/data
mkdir -p storage/logs
mkdir -p bootstrap/cache

chmod -R 777 storage bootstrap/cache

# إنشاء رابط storage
php artisan storage:link || true

# تشغيل migrations
echo "🗄️ Running migrations..."
php artisan migrate --force

# 🔍 التحقق من المستخدم (إضافة جديدة)
echo "🔍 Checking user admin@example.com..."
php artisan tinker --execute="
\$user = App\Models\User::where('email', 'admin@example.com')->first();
if (\$user) {
    echo '✅ User found: ' . \$user->email;
    echo ' 🆔 ID: ' . \$user->id;
    echo ' 🔑 Has Filament admin access? ' . (\$user->can('access_admin') ? 'Yes' : 'No');
} else {
    echo '❌ User not found';
}
"

echo "✅ Laravel is ready."

# تشغيل Laravel
php artisan serve --host=0.0.0.0 --port="${PORT:-10000}"