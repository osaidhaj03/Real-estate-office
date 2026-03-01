<?php

namespace App\Filament\Admin\Resources\Listings\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ListingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('property.title')
                    ->label('العقار'),
                TextEntry::make('listing_type')
                    ->label('النوع')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'sale' => 'بيع',
                        'rent' => 'إيجار',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'sale' => 'success',
                        'rent' => 'info',
                    }),
                TextEntry::make('price')
                    ->label('السعر المطلوب')
                    ->money('SAR'),
                TextEntry::make('broker.name')
                    ->label('السمسار')
                    ->placeholder('-'),
                TextEntry::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'active' => 'نشط',
                        'suspended' => 'معلّق',
                        'expired' => 'منتهي',
                        'sold' => 'تم البيع',
                        'rented' => 'تم التأجير',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'suspended' => 'warning',
                        'expired' => 'danger',
                        'sold' => 'gray',
                        'rented' => 'info',
                    }),
                TextEntry::make('start_date')
                    ->label('تاريخ البدء')
                    ->date('Y-m-d')
                    ->placeholder('-'),
                TextEntry::make('end_date')
                    ->label('تاريخ الانتهاء')
                    ->date('Y-m-d')
                    ->placeholder('-'),
                TextEntry::make('notes')
                    ->label('ملاحظات')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
