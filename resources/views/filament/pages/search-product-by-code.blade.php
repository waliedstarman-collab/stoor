<x-filament-panels::page>
    <div class="space-y-6">
        <!-- نموذج البحث -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm">
            <div class="flex flex-col md:flex-row gap-4 items-end">
                <div class="flex-1">
                    <label for="code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        أدخل كود المنتج
                    </label>
                    <input 
                        type="text" 
                        id="code" 
                        wire:model="code" 
                        placeholder="مثال: PRD-001"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-4 py-2 focus:ring-2 focus:ring-primary-500"
                        wire:keydown.enter="search"
                    >
                </div>
                <div>
                    <button 
                        wire:click="search" 
                        class="w-full md:w-auto px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition"
                    >
                        <i class="bi bi-search"></i> بحث
                    </button>
                </div>
            </div>
        </div>

        <!-- النتائج -->
        @if($searched)
            @if($foundProduct)
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-success-200">
                    <h3 class="text-xl font-bold text-success-600 mb-4">
                        ✅ تم العثور على المنتج
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p><strong>اسم المنتج:</strong> {{ $foundProduct->name }}</p>
                            <p><strong>الكود:</strong> <span class="badge bg-secondary">{{ $foundProduct->code }}</span></p>
                            <p><strong>القسم:</strong> {{ $foundProduct->category->name ?? 'غير محدد' }}</p>
                        </div>
                        <div>
                            <p><strong>سعر البيع:</strong> <span class="text-success fw-bold">{{ number_format($foundProduct->price, 2) }} ر.س</span></p>
                            <p><strong>سعر الشراء:</strong> <span class="text-info">{{ $foundProduct->purchase_price ? number_format($foundProduct->purchase_price, 2) . ' ر.س' : 'غير محدد' }}</span></p>
                        </div>
                    </div>

                    @if($foundProduct->supplier)
                        <hr class="my-3">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p><strong>المورد:</strong> {{ $foundProduct->supplier->name }}</p>
                                <p><strong>رمز المورد:</strong> <span class="badge bg-primary">{{ $foundProduct->supplier->code }}</span></p>
                            </div>
                            <div>
                                <p><strong>عنوان المورد:</strong> {{ $foundProduct->supplier->address ?? 'غير متوفر' }}</p>
                                <p><strong>هاتف المورد:</strong> {{ $foundProduct->supplier->phone ?? 'غير متوفر' }}</p>
                            </div>
                        </div>
                    @else
                        <p class="text-muted mt-2"><i class="bi bi-info-circle"></i> هذا المنتج غير مرتبط بمورد</p>
                    @endif

                    <div class="mt-4 flex flex-wrap gap-2">
                        <a href="{{ route('website.product', $foundProduct->id) }}" target="_blank" class="btn btn-outline-primary">
                            <i class="bi bi-eye"></i> عرض المنتج في المتجر
                        </a>
                        <a href="{{ route('filament.admin.resources.products.edit', $foundProduct->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> تعديل المنتج
                        </a>
                    </div>
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-danger-200">
                    <div class="text-center py-4">
                        <i class="bi bi-exclamation-triangle text-danger" style="font-size: 3rem;"></i>
                        <h4 class="text-danger mt-2">لم يتم العثور على منتج بالكود "{{ $code }}"</h4>
                        <p class="text-muted">تأكد من صحة الكود وحاول مرة أخرى.</p>
                    </div>
                </div>
            @endif
        @endif
    </div>
</x-filament-panels::page>