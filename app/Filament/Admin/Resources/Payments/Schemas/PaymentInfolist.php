<?php

namespace App\Filament\Admin\Resources\Payments\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PaymentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('contract.contract_number')
                    ->label('العقد المرتبط'),
                TextEntry::make('amount')
                    ->label('المبلغ')
                    ->numeric(),
                TextEntry::make('payment_date')
                    ->label('تاريخ الدفع الفعلي')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('due_date')
                    ->label('تاريخ الاستحقاق')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('payment_method')
                    ->label('طريقة الدفع')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'cash' => 'كاش (نقدي)', 
                        'transfer' => 'حوالة بنكية', 
                        'cheque' => 'شيك'
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'cash' => 'success',
                        'transfer' => 'gray',
                        'cheque' => 'info',
                    }),
                TextEntry::make('status')
                    ->label('الوضع المالي')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'paid' => 'مدفوعة', 
                        'pending' => 'قيد الانتظار', 
                        'overdue' => 'متأخرة'
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'paid' => 'success',
                        'pending' => 'warning',
                        'overdue' => 'danger',
                    }),
                TextEntry::make('receipt_number')
                    ->label('رقم الإيصال')
                    ->placeholder('-'),
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
