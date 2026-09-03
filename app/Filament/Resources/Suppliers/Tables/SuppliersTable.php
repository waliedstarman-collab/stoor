<?php

namespace App\Filament\Resources\Suppliers\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SuppliersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('اسم المورد')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('code')
                    ->label('الرمز')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('address')
                    ->label('العنوان')
                    ->limit(30)
                    ->searchable(),

                TextColumn::make('phone')
                    ->label('الهاتف')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('تاريخ الإضافة')
                    ->dateTime('d/m/Y')
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                // يمكنك إضافة أزرار تعديل وحذف هنا
            ])
            ->bulkActions([]);
    }
}