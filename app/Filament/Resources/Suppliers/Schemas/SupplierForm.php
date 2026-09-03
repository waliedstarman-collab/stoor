<?php

namespace App\Filament\Resources\Suppliers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SupplierForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('اسم المورد')
                    ->required()
                    ->maxLength(255),

                TextInput::make('code')
                    ->label('الرمز (حرف أو حرفين كابيتال)')
                    ->required()
                    ->maxLength(2)
                    ->unique(ignoreRecord: true)
                    ->helperText('مثال: A, AM, ST')
                    ->rule('regex:/^[A-Z]+$/'),

                TextInput::make('address')
                    ->label('العنوان')
                    ->maxLength(255)
                    ->nullable(),

                TextInput::make('phone')
                    ->label('رقم الهاتف')
                    ->maxLength(20)
                    ->nullable(),

                Textarea::make('notes')
                    ->label('ملاحظات')
                    ->nullable()
                    ->rows(3),
            ]);
    }
}