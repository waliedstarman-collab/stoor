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

// ⭐ منح صلاحية الوصول إلى Filament Admin (هذا هو الحل)
try {
    // محاولة منح الصلاحية باستخدام Spatie Permission (في حالة استخدامه)
    \$user->givePermissionTo('access_admin');
    echo ' 🔑 Admin access granted via Spatie.';
} catch (\Exception \$e) {
    // إذا لم تكن حزمة Spatie مثبتة، نستخدم الطريقة الافتراضية في Filament
    try {
        // محاولة منح الصلاحية باستخدام Gate (الطريقة الافتراضية في Filament)
        \$user->allow('access_admin');
        echo ' 🔑 Admin access granted via Gate.';
    } catch (\Exception \$e) {
        // إذا لم تنجح أي من الطريقتين، نضبط المستخدم كـ 'super_admin' (في بعض الإصدارات)
        try {
            \$user->assignRole('super_admin');
            echo ' 🔑 Admin access granted via Role.';
        } catch (\Exception \$e) {
            echo ' ⚠️ Could not grant admin access automatically. Please check Filament permissions.';
        }
    }
}
" || echo "⚠️ User check/update failed."

echo ""


echo "✅ Laravel is ready."

# تشغيل Laravel
php artisan serve --host=0.0.0.0 --port="${PORT:-10000}"