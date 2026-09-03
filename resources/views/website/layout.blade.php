<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title>@yield('title', 'متجرنا')</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        * {
            font-family: 'Tajawal', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding-bottom: 20px;
        }
        
        /* شريط التنقل */
        .navbar-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            padding: 12px 0;
        }
        
        .navbar-custom .navbar-brand {
            color: white !important;
            font-weight: 700;
            font-size: 1.3rem;
        }
        
        .navbar-custom .navbar-brand i {
            font-size: 1.5rem;
        }
        
        .navbar-custom .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            padding: 10px 15px !important;
            font-size: 1.1rem;
        }
        
        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link:focus {
            color: white !important;
        }
        
        /* زر القائمة (الهامبرغر) */
        .navbar-toggler {
            border-color: rgba(255,255,255,0.5);
            padding: 8px 12px;
        }
        
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255,255,255,0.9)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        
        .navbar-custom .dropdown-menu {
            background: white;
            border: none;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            border-radius: 12px;
            padding: 10px;
            animation: slideDown 0.3s ease;
        }
        
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .navbar-custom .dropdown-item {
            border-radius: 8px;
            padding: 12px 20px;
            font-size: 1.1rem;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .navbar-custom .dropdown-item:hover,
        .navbar-custom .dropdown-item:focus {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .category-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            margin-right: 8px;
        }
        
        /* بطاقات المنتجات - محسّنة للموبايل */
        .product-card {
            background: white;
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            height: 100%;
            cursor: pointer;
            position: relative;
        }
        
        .product-card:active {
            transform: scale(0.97);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .product-card .card-img-top {
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .product-card .card-body {
            padding: 15px;
        }
        
        .product-card .card-title {
            font-weight: 700;
            color: #2d3748;
            font-size: 1rem;
            margin-bottom: 3px;
        }
        
        .product-card .price {
            color: #667eea;
            font-weight: 700;
            font-size: 1.2rem;
        }
        
        .product-card .btn-details {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            border-radius: 25px;
            padding: 10px 16px;
            font-size: 0.95rem;
            transition: all 0.3s;
            width: 100%;
        }
        
        .product-card .btn-details:active {
            transform: scale(0.95);
        }
        
        /* زر واتساب */
        .whatsapp-btn {
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            border: none;
            color: white;
            border-radius: 50px;
            padding: 16px 20px;
            font-weight: 700;
            font-size: 1.2rem;
            transition: all 0.3s;
            box-shadow: 0 10px 30px rgba(37, 211, 102, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
        }
        
        .whatsapp-btn:active {
            transform: scale(0.97);
        }
        
        /* قسم الترحيب (Hero) */
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 20px;
            border-radius: 0 0 40px 40px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);
        }
        
        .hero-section h1 {
            font-weight: 700;
            font-size: 2rem;
        }
        
        .hero-section p {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        .hero-section .badge {
            font-size: 0.9rem;
            padding: 8px 16px;
        }
        
        /* تذييل الصفحة */
        .footer-custom {
            background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%);
            color: rgba(255,255,255,0.8);
            padding: 25px 0;
            margin-top: 40px;
            border-radius: 40px 40px 0 0;
        }
        
        /* تأثيرات ظهور */
        .fade-in {
            animation: fadeIn 0.6s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* تحسينات للشاشات الصغيرة جداً */
        @media (max-width: 576px) {
            .hero-section h1 {
                font-size: 1.6rem;
            }
            
            .product-card .card-img-top {
                height: 160px;
            }
            
            .product-card .card-title {
                font-size: 0.9rem;
            }
            
            .product-card .price {
                font-size: 1rem;
            }
            
            .whatsapp-btn {
                font-size: 1rem;
                padding: 14px 16px;
            }
            
            .navbar-custom .navbar-brand {
                font-size: 1.1rem;
            }
            
            .container {
                padding-left: 12px;
                padding-right: 12px;
            }
        }
    </style>
</head>

       
<body>
    <!-- شريط التنقل -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('website.home') }}">
                <i class="bi bi-shop"></i> متجري
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="تبديل التنقل">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('website.home') }}">
                            <i class="bi bi-house-door"></i> الرئيسية
                        </a>
                    </li>
                    
                    @php
                        $categories = App\Models\Category::withCount('products')->get();
                    @endphp
                    @if($categories->isNotEmpty())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-grid"></i> الأقسام
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                            @foreach($categories as $cat)
                            <li>
                                <a class="dropdown-item" href="{{ route('website.category', $cat->slug) }}">
                                    {{ $cat->name }}
                                    <span class="category-badge">{{ $cat->products_count }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- المحتوى -->
    <main class="fade-in">
        @yield('content')
    </main>

    <!-- التذييل -->
    <footer class="footer-custom">
        <div class="container text-center">
            <p class="mb-0">
                <i class="bi bi-heart-fill text-danger"></i> 
                جميع الحقوق محفوظة &copy; 2026
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- جعل البطاقات قابلة للنقر بالكامل على الموبايل -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // جعل البطاقة بأكملها قابلة للنقر (بدلاً من زر التفاصيل فقط)
            document.querySelectorAll('.product-card').forEach(function(card) {
                const link = card.querySelector('a.btn-details');
                if (link) {
                    card.addEventListener('click', function(e) {
                        // إذا كان النقر على زر أو رابط آخر، لا نتعارض معه
                        if (e.target.closest('a') || e.target.closest('.btn')) return;
                        window.location.href = link.href;
                    });
                }
            });
        });
    </script>
    <!-- Swiper JS (في نهاية الصفحة قبل </body>) -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- الأكواد المخصصة -->
@yield('scripts')
</body>
</html>