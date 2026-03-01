<?php

namespace App\Filament\Admin\Resources\Contracts\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ContractForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('contract_number')
                    ->label('رقم العقد')
                    ->required(),
                Select::make('listing_id')
                    ->label('العرض المرتبط (إن وجد)')
                    ->relationship('listing', 'id')
                    ->searchable()
                    ->preload()
                    ->default(null),
                Select::make('property_id')
                    ->label('العقار الأساسي')
                    ->relationship('property', 'title')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('owner_id')
                    ->label('المالك')
                    ->relationship('owner', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('client_id')
                    ->label('العميل (المشتري/المستأجر)')
                    ->relationship('client', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('broker_id')
                    ->label('الوسيط (إن وجد)')
                    ->relationship('broker', 'name')
                    ->searchable()
                    ->preload()
                    ->default(null),
                Select::make('contract_type')
                    ->label('نوع العقد')
                    ->options([
                        'sale' => 'بيع', 
                        'rent' => 'إيجار'
                    ])
                    ->required(),
                TextInput::make('contract_value')
                    ->label('قيمة العقد')
                    ->required()
                    ->numeric(),
                TextInput::make('commission_amount')
                    ->label('إجمالي العمولة المستحقة')
                    ->numeric()
                    ->default(null),
                TextInput::make('broker_commission')
                    ->label('عمولة الوسيط المبنية على العقد')
                    ->numeric()
                    ->default(null),
                DatePicker::make('start_date')
                    ->label('تاريخ بداية العقد')
                    ->required(),
                DatePicker::make('end_date')
                    ->label('تاريخ نهاية العقد'),
                Select::make('payment_method')
                    ->label('طريقة الدفع')
                    ->options([
                        'cash' => 'كاش (نقدي)', 
                        'installments' => 'أقساط', 
                        'transfer' => 'حوالة بنكية'
                    ])
                    ->default('cash')
                    ->required(),
                Select::make('status')
                    ->label('حالة العقد')
                    ->options([
                        'active' => 'ساري/نشط',
                        'expired' => 'منتهي',
                        'cancelled' => 'ملغى',
                        'suspended' => 'معلق',
                    ])
                    ->default('active')
                    ->required(),
                Textarea::make('notes')
                    ->label('ملاحظات إضافية')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
