<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-home';
    protected static ?string $title = 'لوحة التحكم';
    protected static ?string $navigationLabel = 'الرئيسية';
    protected static ?int $navigationSort = -2;

    public function getWidgets(): array
    {
        return [
            // يمكنك إضافة الأدوات (Widgets) هنا
        ];
    }
}