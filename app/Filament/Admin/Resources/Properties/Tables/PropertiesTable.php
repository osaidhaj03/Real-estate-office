<?php

namespace App\Filament\Admin\Resources\Properties\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PropertiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('اسم/عنوان العقار')
                    ->searchable(),
                TextColumn::make('propertyType.name')
                    ->label('نوع العقار')
                    ->searchable(),
                TextColumn::make('owner.name')
                    ->label('المالك')
                    ->searchable(),
                TextColumn::make('status')
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
                TextColumn::make('price')
                    ->label('السعر')
                    ->money('SAR')
                    ->sortable(),
                TextColumn::make('area')
                    ->label('المساحة')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('location')
                    ->label('المنطقة/الحي')
                    ->searchable(),
                TextColumn::make('bedrooms')
                    ->label('غرف النوم')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('bathrooms')
                    ->label('الحمامات')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('floor')
                    ->label('الطابق')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('building_age')
                    ->label('عمر البناء')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('furnished')
                    ->label('مفروش')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('direction')
                    ->label('الاتجاه')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('land_type')
                    ->label('نوع الأرض')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): ?string => match ($state) {
                        'residential' => 'سكني',
                        'commercial' => 'تجاري',
                        'agricultural' => 'زراعي',
                        default => $state,
                    })
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('plan_number')
                    ->label('المخطط')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('plot_number')
                    ->label('القطعة')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('street_width')
                    ->label('عرض الشارع')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('تاريخ الإضافة')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('تاريخ التعديل')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
