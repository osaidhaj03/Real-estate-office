<?php

namespace App\Filament\Admin\Resources\Owners\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class OwnerForm
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
                TextInput::make('email')
                    ->label('البريد الإلكتروني')
                    ->email()
                    ->default(null),
                TextInput::make('id_number')
                    ->label('رقم الهوية / الإقامة')
                    ->default(null),
                TextInput::make('nationality')
                    ->label('الجنسية')
                    ->default(null),
                Select::make('owner_type')
                    ->label('نوع المالك')
                    ->options([
                        'individual' => 'فرد',
                        'company' => 'شركة'
                    ])
                    ->default('individual')
                    ->reactive()
                    ->required(),
                TextInput::make('company_name')
                    ->label('اسم الشركة')
                    ->hidden(fn (\Filament\Schemas\Components\Utilities\Get $get): bool => $get('owner_type') !== 'company')
                    ->default(null),
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
