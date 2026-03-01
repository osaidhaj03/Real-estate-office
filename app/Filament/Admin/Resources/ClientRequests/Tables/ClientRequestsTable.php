<?php

namespace App\Filament\Admin\Resources\ClientRequests\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ClientRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('client.name')
                    ->label('العميل')
                    ->searchable(),
                TextColumn::make('request_type')
                    ->label('النوع')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'buy' => 'شراء', 
                        'rent' => 'استئجار'
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'buy' => 'success',
                        'rent' => 'info',
                    }),
                TextColumn::make('propertyType.name')
                    ->label('نوع العقار')
                    ->searchable(),
                TextColumn::make('min_price')
                    ->label('أقل سعر')
                    ->money()
                    ->sortable(),
                TextColumn::make('max_price')
                    ->label('أعلى سعر')
                    ->money()
                    ->sortable(),
                TextColumn::make('min_area')
                    ->label('أقل مساحة')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('max_area')
                    ->label('أعلى مساحة')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('preferred_location')
                    ->label('الموقع')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('bedrooms')
                    ->label('الغرف')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
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
