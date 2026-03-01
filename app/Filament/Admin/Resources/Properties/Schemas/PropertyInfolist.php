<?php

namespace App\Filament\Admin\Resources\Properties\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PropertyInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title')
                    ->label('اسم/عنوان العقار'),
                TextEntry::make('propertyType.name')
                    ->label('نوع العقار'),
                TextEntry::make('owner.name')
                    ->label('المالك'),
                TextEntry::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'available' => 'success',
                        'reserved' => 'warning',
                        'sold' => 'danger',
                        'rented' => 'info',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'available' => 'متاح',
                        'reserved' => 'محجوز',
                        'sold' => 'مباع',
                        'rented' => 'مؤجر',
                    }),
                TextEntry::make('price')
                    ->label('السعر')
                    ->money('SAR')
                    ->placeholder('-'),
                TextEntry::make('area')
                    ->label('المساحة')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('location')
                    ->label('المنطقة/الحي')
                    ->placeholder('-'),
                TextEntry::make('address')
                    ->label('العنوان التفصيلي')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('description')
                    ->label('الوصف')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('notes')
                    ->label('ملاحظات')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('bedrooms')
                    ->label('غرف النوم')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('bathrooms')
                    ->label('الحمامات')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('floor')
                    ->label('الطابق')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('building_age')
                    ->label('عمر البناء')
                    ->numeric()
                    ->placeholder('-'),
                IconEntry::make('furnished')
                    ->label('مفروش')
                    ->boolean(),
                TextEntry::make('direction')
                    ->label('الاتجاه')
                    ->placeholder('-'),
                TextEntry::make('land_type')
                    ->label('نوع الأرض')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): ?string => match ($state) {
                        'residential' => 'سكني',
                        'commercial' => 'تجاري',
                        'agricultural' => 'زراعي',
                        default => $state,
                    })
                    ->placeholder('-'),
                TextEntry::make('plan_number')
                    ->label('المخطط')
                    ->placeholder('-'),
                TextEntry::make('plot_number')
                    ->label('القطعة')
                    ->placeholder('-'),
                TextEntry::make('street_width')
                    ->label('عرض الشارع')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
