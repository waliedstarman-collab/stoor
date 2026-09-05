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

# تنظيف الكاش (ضروري بعد تغيير الإعدادات)
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan optimize:clear

# إنشاء رابط storage
php artisan storage:link || true

# تشغيل migrations
echo "🗄️ Running migrations..."
php artisan migrate --force

# التحقق من وجود المستخدم ومنحه صلاحية (باستخدام middleware، لكننا نتركه هنا للتأكد)
php artisan tinker --execute="
\$user = App\Models\User::where('email', 'admin@example.com')->first();
if (!\$user) {
    \$user = App\Models\User::create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'password' => bcrypt('password')
    ]);
    echo '✅ Admin user created.';
} else {
    echo '✅ Admin user already exists.';
}
" || echo "⚠️ User check failed."

echo "✅ Laravel is ready."

php artisan vendor:publish --tag=filament-assets --force

# تشغيل Laravel
php artisan serve --host=0.0.0.0 --port="${PORT:-10000}"