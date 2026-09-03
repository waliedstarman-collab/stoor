@extends('website.layout')

@section('title', 'الرئيسية - متجرنا')

@section('content')
<!-- قسم الترحيب -->
<div class="hero-section text-center">
    <div class="container">
        <h1>🌟 مرحباً بك في متجرنا</h1>
        <p>اكتشف أحدث المنتجات بأسعار مميزة</p>
        <div class="mt-3 d-flex flex-wrap justify-content-center gap-2">
            <span class="badge bg-light text-dark p-2">
                <i class="bi bi-tag"></i> عروض حصرية
            </span>
            <span class="badge bg-light text-dark p-2">
                <i class="bi bi-truck"></i> توصيل سريع
            </span>
            <span class="badge bg-light text-dark p-2">
                <i class="bi bi-shield-check"></i> جودة مضمونة
            </span>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mb-3">
        <div class="col-12">
            <h4 class="fw-bold">
                <i class="bi bi-stars text-warning"></i> أحدث المنتجات
            </h4>
            <hr>
        </div>
    </div>

    <div class="row g-3">
        @forelse($products as $product)
        <div class="col-6 col-md-3 mb-3 fade-in" style="animation-delay: {{ $loop->iteration * 0.05 }}s">
            <div class="card product-card">
                <!-- عرض الصورة باستخدام first_image_url المُجهّز في الـ Controller -->
                @if($product->first_image_url)
                    <div class="overflow-hidden">
                        <img src="{{ $product->first_image_url }}" class="card-img-top" alt="{{ $product->name }}" loading="lazy">
                    </div>
                @else
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                        <i class="bi bi-image" style="font-size: 3.5rem; color: #ccc;"></i>
                    </div>
                @endif

                <div class="card-body d-flex flex-column">
                    <h6 class="card-title">{{ $product->name }}</h6>
                    <small class="text-muted">
                        <i class="bi bi-upc-scan"></i> {{ $product->code }}
                    </small>
                    <div class="mt-2">
                        <span class="price">{{ number_format($product->price, 2) }} ر.س</span>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('website.product', $product->id) }}" class="btn btn-details">
                            <i class="bi bi-eye"></i> تفاصيل
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="bi bi-box-seam" style="font-size: 4rem; color: #ccc;"></i>
            <p class="text-muted mt-3">لا توجد منتجات حالياً</p>
        </div>
        @endforelse
    </div>
</div>
@endsection