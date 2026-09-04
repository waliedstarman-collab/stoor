#!/bin/bash

echo "🚀 Starting application..."

# تنظيف الكاش
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan optimize:clear

# تشغيل الهجرات (إنشاء الجداول)
echo "📦 Running migrations..."
php artisan migrate --force

# إنشاء مستخدم أدمن إذا لم يكن موجوداً
echo "👤 Creating admin user if not exists..."
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
" || echo "⚠️ User creation failed, continuing..."

# تشغيل الخادم
echo "🌐 Starting server..."
php artisan serve --host=0.0.0.0 --port=$PORT