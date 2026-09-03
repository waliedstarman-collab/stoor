@extends('website.layout')

@section('title', $product->name . ' - متجرنا')

@section('content')
<div class="container">
    <div class="row fade-in">
        <div class="col-12 mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="{{ route('website.home') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('website.category', $product->category->slug) }}">{{ $product->category->name }}</a></li>
                    <li class="breadcrumb-item active">{{ $product->name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row g-4">
        <!-- قسم الصور -->
        <div class="col-12 col-md-6">
            <div class="position-relative">
                <!-- المعرض الرئيسي (Swiper) -->
                <div class="swiper productSwiper" style="border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                    <div class="swiper-wrapper">
                        @forelse($imageUrls as $url)
                        <div class="swiper-slide">
                            <img src="{{ $url }}" class="w-100" style="height: 400px; object-fit: contain; background: #f8f9fa; cursor: zoom-in;" alt="{{ $product->name }}" loading="lazy">
                        </div>
                        @empty
                        <div class="swiper-slide">
                            <div class="d-flex align-items-center justify-content-center" style="height: 400px; background: #f8f9fa;">
                                <i class="bi bi-image" style="font-size: 4rem; color: #ccc;"></i>
                            </div>
                        </div>
                        @endforelse
                    </div>
                    <!-- أزرار التنقل -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <!-- مؤشر التقدم (النقاط) -->
                    <div class="swiper-pagination"></div>
                </div>

                <!-- الصور المصغرة (Thumbnail Swiper) -->
                @if(count($imageUrls) > 1)
                <div class="swiper thumbnailSwiper mt-3" style="border-radius: 12px; overflow: hidden; padding: 5px 0;">
                    <div class="swiper-wrapper">
                        @foreach($imageUrls as $url)
                        <div class="swiper-slide" style="width: 80px; cursor: pointer;">
                            <img src="{{ $url }}" class="w-100" style="height: 70px; object-fit: cover; border-radius: 8px; border: 2px solid transparent; transition: border 0.3s;" alt="صورة مصغرة">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
        
        <!-- معلومات المنتج -->
        <div class="col-12 col-md-6">
            <div class="card border-0 shadow-lg p-3 p-md-4" style="border-radius: 16px;">
                <div class="d-flex flex-wrap justify-content-between align-items-start">
                    <h4 class="fw-bold">{{ $product->name }}</h4>
                    <span class="badge bg-success p-2">
                        <i class="bi bi-check-circle"></i> متوفر
                    </span>
                </div>
                
                <div class="mt-2">
                    <a href="{{ route('website.category', $product->category->slug) }}" class="text-decoration-none small">
                        <i class="bi bi-folder"></i> {{ $product->category->name }}
                    </a>
                </div>
                
                <div class="mt-2">
                    <span class="badge bg-secondary">
                        <i class="bi bi-upc-scan"></i> الكود: {{ $product->code }}
                    </span>
                </div>
                
                <div class="mt-3">
                    <span class="price" style="font-size: 1.8rem;">
                        {{ number_format($product->price, 2) }} ر.س
                    </span>
                </div>
                
                <hr>
                
                @if($product->description)
                <div class="mt-2">
                    <h6 class="fw-bold"><i class="bi bi-info-circle"></i> الوصف</h6>
                    <div class="text-muted small">{!! $product->description !!}</div>
                </div>
                <hr>
                @endif
                
                @php
                    $phoneNumber = '22222730661';
                    $message = "مرحباً، أريد طلب المنتج: " . $product->name . " - الكود: " . $product->code . " - السعر: " . number_format($product->price, 2) . " ر.س";
                    $whatsappUrl = "https://wa.me/" . $phoneNumber . "?text=" . urlencode($message);
                @endphp
                
                <a href="{{ $whatsappUrl }}" target="_blank" class="whatsapp-btn">
                    <i class="bi bi-whatsapp" style="font-size: 1.5rem;"></i>
                    طلب عبر واتساب
                </a>
                
                <p class="text-muted small mt-2 text-center mb-0">
                    <i class="bi bi-info-circle"></i> سيتم فتح محادثة واتساب مع رسالة جاهزة
                </p>
                
                <a href="{{ route('website.home') }}" class="btn btn-outline-secondary mt-3">
                    <i class="bi bi-arrow-right"></i> العودة للرئيسية
                </a>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript لتشغيل Swiper -->
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // تهيئة المعرض الرئيسي
    const productSwiper = new Swiper('.productSwiper', {
        loop: true,  // ⭐ التكرار الدائري (عند الوصول للآخر يعود للأول)
        slidesPerView: 1,
        centeredSlides: true,
        spaceBetween: 0,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        // تفعيل وضع ملء الشاشة عند النقر على الصورة
        on: {
            click: function(swiper, e) {
                const slide = swiper.slides[swiper.activeIndex];
                const img = slide.querySelector('img');
                if (img && img.requestFullscreen) {
                    img.requestFullscreen().catch(err => {
                        // بعض المتصفحات تمنع الطلب التلقائي
                        console.warn('تعذر تفعيل وضع ملء الشاشة', err);
                    });
                }
            }
        }
    });

    // تهيئة الصور المصغرة (Thumbnails)
    @if(count($imageUrls) > 1)
    const thumbnailSwiper = new Swiper('.thumbnailSwiper', {
        slidesPerView: 'auto',
        spaceBetween: 10,
        centeredSlides: false,
        breakpoints: {
            0: { slidesPerView: 3 },
            576: { slidesPerView: 4 },
            768: { slidesPerView: 5 },
        },
        // عند النقر على صورة مصغرة، ننتقل إلى الصورة المقابلة في المعرض الرئيسي
        on: {
            click: function(swiper, e) {
                const index = swiper.clickedIndex;
                if (index !== undefined && index !== -1) {
                    productSwiper.slideTo(index);
                }
            }
        }
    });

    // مزامنة المعرض الرئيسي مع الصور المصغرة (عند التمرير)
    productSwiper.on('slideChange', function() {
        const activeIndex = productSwiper.realIndex;
        if (thumbnailSwiper) {
            thumbnailSwiper.slideTo(activeIndex);
        }
        // تحديث border للصورة المصغرة النشطة
        document.querySelectorAll('.thumbnailSwiper .swiper-slide').forEach((slide, index) => {
            const img = slide.querySelector('img');
            if (img) {
                if (index === activeIndex) {
                    img.style.border = '3px solid #667eea';
                } else {
                    img.style.border = '2px solid transparent';
                }
            }
        });
    });

    // تعيين الصورة المصغرة الأولى كنشطة
    setTimeout(() => {
        const firstThumb = document.querySelector('.thumbnailSwiper .swiper-slide img');
        if (firstThumb) firstThumb.style.border = '3px solid #667eea';
    }, 100);
    @endif

    // إضافة خاصية التنقل بالسحب (Drag) في وضع ملء الشاشة
    // عند تفعيل ملء الشاشة، نضيف مستمعي أحداث للتنقل باللمس
    document.addEventListener('fullscreenchange', function() {
        const isFullscreen = document.fullscreenElement !== null;
        if (isFullscreen) {
            // في وضع ملء الشاشة، نمنع التمرير التلقائي ونجعل التنقل يدوياً
            productSwiper.autoplay.stop();
        } else {
            productSwiper.autoplay.start();
        }
    });
});
</script>
@endsection
@endsection