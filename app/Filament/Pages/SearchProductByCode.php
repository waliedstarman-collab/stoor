<?php

namespace App\Filament\Pages;

use App\Models\Product;
use BackedEnum;
use Filament\Pages\Page;
use Livewire\Attributes\Computed;

class SearchProductByCode extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-magnifying-glass';
    protected string $view = 'filament.pages.search-product-by-code';
    protected static ?string $title = 'بحث عن منتج بالكود';
    protected static ?string $navigationLabel = 'بحث بالكود';
    protected static ?int $navigationSort = 1;

    public string $code = '';
    public ?Product $foundProduct = null;
    public bool $searched = false;

    public function search()
    {
        $this->searched = true;
        
        if (empty($this->code)) {
            $this->foundProduct = null;
            return;
        }

        $this->foundProduct = Product::with(['category', 'supplier'])
                                    ->where('code', $this->code)
                                    ->first();
    }
}