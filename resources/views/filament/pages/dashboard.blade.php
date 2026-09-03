<x-filament-panels::page>
    @if($this->hasWidgets())
        <div class="space-y-6">
            @foreach($this->getWidgets() as $widget)
                @livewire($widget)
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <div class="text-6xl mb-4">📊</div>
            <h2 class="text-2xl font-bold text-gray-700 dark:text-gray-300 mb-2">مرحباً بك في لوحة التحكم</h2>
            <p class="text-gray-500 dark:text-gray-400">يمكنك إضافة الأدوات (Widgets) لعرض إحصائيات مفيدة هنا</p>
            <div class="mt-4">
                <a href="{{ route('filament.admin.resources.products.index') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg">
                    <i class="bi bi-box-seam"></i> إدارة المنتجات
                </a>
            </div>
        </div>
    @endif
</x-filament-panels::page>