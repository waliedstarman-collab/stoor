

<?php $__env->startSection('title', 'الرئيسية - متجرنا'); ?>

<?php $__env->startSection('content'); ?>
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
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
        <div class="col-6 col-md-3 mb-3 fade-in" style="animation-delay: <?php echo e($loop->iteration * 0.05); ?>s">
            <div class="card product-card">
                <!-- عرض الصورة باستخدام first_image_url المُجهّز في الـ Controller -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->first_image_url): ?>
                    <div class="overflow-hidden">
                        <img src="<?php echo e($product->first_image_url); ?>" class="card-img-top" alt="<?php echo e($product->name); ?>" loading="lazy">
                    </div>
                <?php else: ?>
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                        <i class="bi bi-image" style="font-size: 3.5rem; color: #ccc;"></i>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div class="card-body d-flex flex-column">
                    <h6 class="card-title"><?php echo e($product->name); ?></h6>
                    <small class="text-muted">
                        <i class="bi bi-upc-scan"></i> <?php echo e($product->code); ?>

                    </small>
                    <div class="mt-2">
                        <span class="price"><?php echo e(number_format($product->price, 2)); ?> ر.س</span>
                    </div>
                    <div class="mt-3">
                        <a href="<?php echo e(route('website.product', $product->id)); ?>" class="btn btn-details">
                            <i class="bi bi-eye"></i> تفاصيل
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        <div class="col-12 text-center py-5">
            <i class="bi bi-box-seam" style="font-size: 4rem; color: #ccc;"></i>
            <p class="text-muted mt-3">لا توجد منتجات حالياً</p>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('website.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pc\Herd\store\resources\views/website/index.blade.php ENDPATH**/ ?>