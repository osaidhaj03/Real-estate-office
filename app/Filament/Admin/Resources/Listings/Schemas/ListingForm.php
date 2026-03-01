<?php

namespace App\Filament\Admin\Resources\Listings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ListingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('property_id')
                    ->relationship('property', 'title')
                    ->label('العقار')
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('listing_type')
                    ->options(['sale' => 'بيع', 'rent' => 'إيجار'])
                    ->label('النوع')
                    ->required(),
                TextInput::make('price')
                    ->label('السعر المطلوب')
                    ->required()
                    ->numeric()
                    ->suffix('SAR'),
                Select::make('broker_id')
                    ->relationship('broker', 'name')
                    ->label('السمسار (اختياري)')
                    ->searchable()
                    ->preload()
                    ->default(null),
                Select::make('status')
                    ->options([
                        'active' => 'نشط',
                        'suspended' => 'معلّق',
                        'expired' => 'منتهي',
                        'sold' => 'تم البيع',
                        'rented' => 'تم التأجير',
                    ])
                    ->label('الحالة')
                    ->default('active')
                    ->required(),
                DatePicker::make('start_date')
                    ->label('تاريخ البدء'),
                DatePicker::make('end_date')
                    ->label('تاريخ الانتهاء'),
                Textarea::make('notes')
                    ->label('ملاحظات')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
