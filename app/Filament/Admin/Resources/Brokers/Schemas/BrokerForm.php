<?php

namespace App\Filament\Admin\Resources\Brokers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class BrokerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('الاسم الكامل')
                    ->required(),
                TextInput::make('phone')
                    ->label('رقم الهاتف الأساسي')
                    ->tel()
                    ->required(),
                TextInput::make('phone2')
                    ->label('رقم هاتف إضافي')
                    ->tel()
                    ->default(null),
                TextInput::make('id_number')
                    ->label('رقم الهوية / الإقامة')
                    ->default(null),
                Select::make('status')
                    ->label('حالة الوسيط')
                    ->options([
                        'active' => 'نشط', 
                        'inactive' => 'غير نشط'
                    ])
                    ->default('active')
                    ->required(),
                Textarea::make('address')
                    ->label('العنوان')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('notes')
                    ->label('ملاحظات إضافية')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
