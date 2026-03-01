<?php

namespace App\Filament\Admin\Resources\ClientRequests\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ClientRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                 Select::make('client_id')
                    ->label('العميل صاحب الطلب')
                    ->relationship('client', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('request_type')
                    ->label('نوع الطلب')
                    ->options([
                        'buy' => 'شراء', 
                        'rent' => 'استئجار'
                    ])
                    ->required(),
                Select::make('property_type_id')
                    ->label('نوع العقار المطلوب')
                    ->relationship('propertyType', 'name')
                    ->searchable()
                    ->preload()
                    ->default(null),
                TextInput::make('min_price')
                    ->label('الحد الأدنى للسعر')
                    ->numeric()
                    ->default(null),
                TextInput::make('max_price')
                    ->label('الحد الأعلى للسعر')
                    ->numeric()
                    ->default(null),
                TextInput::make('min_area')
                    ->label('الحد الأدنى للمساحة')
                    ->numeric()
                    ->default(null),
                TextInput::make('max_area')
                    ->label('الحد الأعلى للمساحة')
                    ->numeric()
                    ->default(null),
                TextInput::make('preferred_location')
                    ->label('الموقع المفضل')
                    ->default(null),
                TextInput::make('bedrooms')
                    ->label('عدد غرف النوم المطلوبة')
                    ->numeric()
                    ->default(null),
                Select::make('status')
                    ->label('حالة الطلب')
                    ->options([
                        'new' => 'جديد',
                        'searching' => 'جاري البحث',
                        'fulfilled' => 'تمت التلبية',
                        'cancelled' => 'ملغى',
                    ])
                    ->default('new')
                    ->required(),
                Textarea::make('notes')
                    ->label('ملاحظات المشتري/المستأجر')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
