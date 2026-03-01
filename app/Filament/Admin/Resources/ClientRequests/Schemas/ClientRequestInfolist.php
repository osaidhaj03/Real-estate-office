<?php

namespace App\Filament\Admin\Resources\ClientRequests\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ClientRequestInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('client.name')
                    ->label('العميل'),
                TextEntry::make('request_type')
                    ->label('نوع الطلب')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'buy' => 'شراء', 
                        'rent' => 'استئجار'
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'buy' => 'success',
                        'rent' => 'info',
                    }),
                TextEntry::make('propertyType.name')
                    ->label('نوع العقار')
                    ->placeholder('-'),
                TextEntry::make('min_price')
                    ->label('الحد الأدنى للسعر')
                    ->money()
                    ->placeholder('-'),
                TextEntry::make('max_price')
                    ->label('الحد الأعلى للسعر')
                    ->money()
                    ->placeholder('-'),
                TextEntry::make('min_area')
                    ->label('الحد الأدنى للمساحة')
                    ->placeholder('-'),
                TextEntry::make('max_area')
                    ->label('الحد الأعلى للمساحة')
                    ->placeholder('-'),
                TextEntry::make('preferred_location')
                    ->label('الموقع المفضل')
                    ->placeholder('-'),
                TextEntry::make('bedrooms')
                    ->label('عدد غرف النوم')
                    ->placeholder('-'),
                TextEntry::make('notes')
                    ->label('ملاحظات المشتري/المستأجر')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'new' => 'جديد',
                        'searching' => 'جاري البحث',
                        'fulfilled' => 'تمت التلبية',
                        'cancelled' => 'ملغى',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'gray',
                        'searching' => 'warning',
                        'fulfilled' => 'success',
                        'cancelled' => 'danger',
                    }),
                TextEntry::make('created_at')
                    ->label('تاريخ الإضافة')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('تاريخ التعديل')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
