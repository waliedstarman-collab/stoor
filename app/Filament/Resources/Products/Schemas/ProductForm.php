<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->label('القسم')
                    ->relationship('category', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),

                Select::make('supplier_id')
                    ->label('المورد')
                    ->relationship('supplier', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable()
                    ->helperText('اختر المورد الذي يزودك بهذا المنتج'),

                TextInput::make('purchase_price')
                    ->label('سعر الشراء (من المورد)')
                    ->numeric()
                    ->nullable()
                    ->prefix('$')
                    ->helperText('سعر التكلفة الذي اشتريت به المنتج'),

                TextInput::make('name')
                    ->label('اسم المنتج')
                    ->required()
                    ->maxLength(255),

                TextInput::make('code')
                    ->label('الكود التعريفي')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->helperText('هذا الكود سيظهر في رسالة واتساب'),

                TextInput::make('price')
                    ->label('السعر')
                    ->required()
                    ->numeric()
                    ->prefix('$'),

                FileUpload::make('image')
                    ->label('الصور')
                    ->image()
                    ->multiple()
                    ->disk('public')
                    ->directory('products')
                    ->visibility('public')
                    ->maxSize(2048)
                    ->imageResizeTargetWidth('800')
                    ->imageResizeTargetHeight('600')
                    ->columnSpanFull()
                    ->helperText('يمكنك رفع عدة صور للمنتج (أول صورة ستكون الرئيسية)'),

                RichEditor::make('description')
                    ->label('الوصف')
                    ->columnSpanFull()
                    ->nullable(),

                Toggle::make('is_available')
                    ->label('متوفر')
                    ->default(true)
                    ->onColor('success')
                    ->offColor('danger'),
            ]);
    }
}