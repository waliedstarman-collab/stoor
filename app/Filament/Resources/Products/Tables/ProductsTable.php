<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('الصورة')
                    ->circular()
                    ->size(40),

                TextColumn::make('name')
                    ->label('الاسم')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('code')
                    ->label('الكود')
                    ->searchable(),

                TextColumn::make('category.name')
                    ->label('القسم')
                    ->sortable(),

                TextColumn::make('price')
                    ->label('السعر')
                    ->money('USD')
                    ->sortable(),

                IconColumn::make('is_available')
                    ->label('متوفر')
                    ->boolean(),
            ]);
    }
}