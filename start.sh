#!/bin/bash

echo "🚀 Starting Laravel application..."

# تنظيف الكاش
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan optimize:clear

# توليد مفتاح التطبيق (للتأكد من أن APP_KEY صحيح)
php artisan key:generate --force

# إنشاء مجلدات التخزين
mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache storage/logs
chmod -R 777 storage/framework storage/logs

# ربط التخزين
php artisan storage:link || echo "Storage link already exists."

# تشغيل الهجرات
php artisan migrate --force || echo "Migration failed, continuing..."

# إنشاء مستخدم أدمن
php artisan tinker --execute="
if(!\App\Models\User::where('email','admin@example.com')->exists()){
    \App\Models\User::create([
        'name'=>'Admin',
        'email'=>'admin@example.com',
        'password'=>bcrypt('password')
    ]);
    echo '✅ Admin user created.';
} else {
    echo '✅ Admin user already exists.';
}
" || echo "User creation failed, continuing..."

echo "✅ Starting server on port $PORT..."
php artisan serve --host=0.0.0.0 --port=$PORT