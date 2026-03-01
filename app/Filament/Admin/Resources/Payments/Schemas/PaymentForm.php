<?php

namespace App\Filament\Admin\Resources\Payments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('contract_id')
                    ->label('العقد المرتبط')
                    ->relationship('contract', 'contract_number')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('amount')
                    ->label('قيمة الدفعة')
                    ->required()
                    ->numeric(),
                DatePicker::make('payment_date')
                    ->label('تاريخ الدفع الفعلي'),
                DatePicker::make('due_date')
                    ->label('تاريخ الاستحقاق'),
                Select::make('payment_method')
                    ->label('طريقة الدفع')
                    ->options([
                        'cash' => 'كاش (نقدي)', 
                        'transfer' => 'حوالة بنكية', 
                        'cheque' => 'شيك'
                    ])
                    ->default('cash')
                    ->required(),
                Select::make('status')
                    ->label('حالة الدفعة')
                    ->options([
                        'paid' => 'مدفوعة', 
                        'pending' => 'قيد الانتظار', 
                        'overdue' => 'متأخرة'
                    ])
                    ->default('pending')
                    ->required(),
                TextInput::make('receipt_number')
                    ->label('رقم الإيصال')
                    ->default(null),
                Textarea::make('notes')
                    ->label('ملاحظات إضافية')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
