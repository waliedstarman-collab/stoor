@extends('website.layout')

@section('title', $category->name . ' - متجرنا')

@section('content')
<div class="container">
    <div class="row mb-4 fade-in">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('website.home') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item active">{{ $category->name }}</li>
                </ol>
            </nav>
            <h2 class="fw-bold">
                <i class="bi bi-folder"></i> {{ $category->name }}
            </h2>
            @if($category->description)
            <p class="text-muted">{{ $category->description }}</p>
            @endif
        </div>
    </div>

    <div class="row">
        @forelse($products as $product)
        <div class="col-md-3 col-6 mb-4 fade-in" style="animation-delay: {{ $loop->iteration * 0.1 }}s">
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
                    <div class="mt-3 d-grid">
                        <a href="{{ route('website.product', $product->id) }}" class="btn btn-details">
                            <i class="bi bi-eye"></i> تفاصيل
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="bi bi-folder-x" style="font-size: 4rem; color: #ccc;"></i>
            <p class="text-muted mt-3">لا توجد منتجات في هذا القسم</p>
        </div>
        @endforelse
    </div>

    @if($products->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection