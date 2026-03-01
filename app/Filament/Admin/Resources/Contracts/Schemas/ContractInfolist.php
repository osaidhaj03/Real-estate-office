<?php

namespace App\Filament\Admin\Resources\Contracts\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ContractInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('contract_number')
                    ->label('رقم العقد'),
                TextEntry::make('listing.id')
                    ->label('العرض المرتبط')
                    ->placeholder('-'),
                TextEntry::make('property.title')
                    ->label('العقار'),
                TextEntry::make('owner.name')
                    ->label('المالك'),
                TextEntry::make('client.name')
                    ->label('العميل'),
                TextEntry::make('broker.name')
                    ->label('الوسيط')
                    ->placeholder('-'),
                TextEntry::make('contract_type')
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
                TextEntry::make('contract_value')
                    ->label('قيمة العقد')
                    ->numeric(),
                TextEntry::make('commission_amount')
                    ->label('إجمالي العمولة المستحقة')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('broker_commission')
                    ->label('عمولة الوسيط المبنية على العقد')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('start_date')
                    ->label('تاريخ بداية العقد')
                    ->date(),
                TextEntry::make('end_date')
                    ->label('تاريخ نهاية العقد')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('payment_method')
                    ->label('طريقة الدفع')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'cash' => 'كاش (نقدي)', 
                        'installments' => 'أقساط', 
                        'transfer' => 'حوالة بنكية'
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'cash' => 'success',
                        'installments' => 'warning',
                        'transfer' => 'gray',
                    }),
                TextEntry::make('status')
                    ->label('حالة العقد')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'active' => 'ساري/نشط',
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
                TextEntry::make('notes')
                    ->label('ملاحظات إضافية')
                    ->placeholder('-')
                    ->columnSpanFull(),
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
