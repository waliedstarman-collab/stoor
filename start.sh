#!/bin/bash

php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan optimize:clear

php artisan migrate --force || echo "Migration failed, continuing..."

# ⭐ ربط مجلد التخزين
php artisan storage:link || echo "Storage link already exists"

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


echo "SESSION_DOMAIN: $SESSION_DOMAIN"
echo "SESSION_SECURE_COOKIE: $SESSION_SECURE_COOKIE"

php artisan serve --host=0.0.0.0 --port=$PORT