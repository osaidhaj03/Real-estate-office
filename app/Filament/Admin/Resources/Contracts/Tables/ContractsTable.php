<?php

namespace App\Filament\Admin\Resources\Contracts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContractsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('contract_number')
                    ->label('رقم العقد')
                    ->searchable(),
                TextColumn::make('listing.id')
                    ->label('الرقم المرجعي للعرض')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('property.title')
                    ->label('العقار')
                    ->searchable(),
                TextColumn::make('owner.name')
                    ->label('المالك')
                    ->searchable(),
                TextColumn::make('client.name')
                    ->label('العميل')
                    ->searchable(),
                TextColumn::make('broker.name')
                    ->label('الوسيط')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('contract_type')
                    ->label('نوع العقد')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'sale' => 'بيع', 
                        'rent' => 'إيجار'
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'sale' => 'success',
                        'rent' => 'info',
                    }),
                TextColumn::make('contract_value')
                    ->label('قيمة العقد')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('commission_amount')
                    ->label('إجمالي العمولة')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('broker_commission')
                    ->label('عمولة الوسيط')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('start_date')
                    ->label('بداية العقد')
                    ->date()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label('نهاية العقد')
                    ->date()
                    ->sortable(),
                TextColumn::make('payment_method')
                    ->label('طريقة الدفع')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'cash' => 'نقدي', 
                        'installments' => 'أقساط', 
                        'transfer' => 'حوالة'
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'cash' => 'success',
                        'installments' => 'warning',
                        'transfer' => 'gray',
                    })
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'active' => 'ساري',
                        'expired' => 'منتهي',
                        'cancelled' => 'ملغى',
                        'suspended' => 'معلق',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'expired' => 'warning',
                        'cancelled' => 'danger',
                        'suspended' => 'gray',
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
