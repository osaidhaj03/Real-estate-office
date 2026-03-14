<?php

namespace App\Filament\Admin\Resources\Clients\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('المعلومات الشخصية')
                    ->description('البيانات الأساسية للعميل')
                    ->icon('heroicon-o-user')
                    ->collapsible()
                    ->schema([
                        
                        TextInput::make('name')
                            ->label('الاسم الكامل (أو اسم الشركة)')
                            ->required()
                            ->maxLength(255)
                            ->prefixIcon('heroicon-m-user')
                            ->columnSpanFull(),

                        TextInput::make('company_name')
                            ->label('اسم الشركة')
                            ->hidden(fn (\Filament\Schemas\Components\Utilities\Get $get): bool => $get('client_type') !== 'company')
                            ->maxLength(255)
                            ->prefixIcon('heroicon-m-building-office')
                            ->default(null),
                            
                        TextInput::make('id_number')
                            ->label('رقم الهوية / الإقامة')
                            ->numeric()
                            ->maxLength(20)
                            ->prefixIcon('heroicon-m-identification')
                            ->default(null),

                        Select::make('nationality')
                            ->label('الجنسية')
                            ->options([
                                'فلسطيني' => 'فلسطيني',
                                'أردني' => 'أردني',
                                'سعودي' => 'سعودي',
                                'مصري' => 'مصري',
                                'إماراتي' => 'إماراتي',
                                'قطري' => 'قطري',
                                'كويتي' => 'كويتي',
                                'بحريني' => 'بحريني',
                                'عُماني' => 'عُماني',
                                'لبناني' => 'لبناني',
                                'سوري' => 'سوري',
                                'عراقي' => 'عراقي',
                                'يمني' => 'يمني',
                                'سوداني' => 'سوداني',
                                'ليبي' => 'ليبي',
                                'تونسي' => 'تونسي',
                                'جزائري' => 'جزائري',
                                'مغربي' => 'مغربي',
                                'موريتاني' => 'موريتاني',
                                'صومالي' => 'صومالي',
                                'جيبوتي' => 'جيبوتي',
                                'تركي' => 'تركي',
                                'أمريكي' => 'أمريكي',
                                'بريطاني' => 'بريطاني',
                                'كندي' => 'كندي',
                                'أسترالي' => 'أسترالي',
                                'أخرى' => 'أخرى',
                            ])
                            ->searchable()
                            ->prefixIcon('heroicon-m-flag')
                            ->default(null),
                            Select::make('client_type')
                            ->label('نوع العميل')
                            ->options([
                                'individual' => 'فرد',
                                'company' => 'شركة',
                            ])
                            ->default('individual')
                            ->reactive()
                            ->required()
                            ->native(false)
                            ->prefixIcon('heroicon-m-building-office-2'),
                            
                    ])->columns(3)->columnSpanFull(),

                Section::make('معلومات التواصل')
                    ->description('أرقام الهواتف والبريد الإلكتروني والعنوان')
                    ->icon('heroicon-o-phone')
                    ->collapsible()
                    ->schema([
                        TextInput::make('phone')
                            ->label('رقم الهاتف الأساسي')
                            ->tel()
                            ->required()
                            ->maxLength(255)
                            ->prefixIcon('heroicon-m-phone'),

                        TextInput::make('phone2')
                            ->label('رقم هاتف إضافي')
                            ->tel()
                            ->maxLength(255)
                            ->prefixIcon('heroicon-m-phone')
                            ->default(null),

                        TextInput::make('email')
                            ->label('البريد الإلكتروني')
                            ->email()
                            ->maxLength(255)
                            ->prefixIcon('heroicon-m-envelope')
                            ->default(null),

                        Textarea::make('address')
                            ->label('العنوان')
                            ->rows(1)
                            ->default(null)
                            ->columnSpanFull(),
                    ])->columns(3)->columnSpanFull(),

                Section::make('الملاحظات')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        Textarea::make('notes')
                            ->label('ملاحظات إضافية')
                            ->rows(5)
                            ->default(null),
                    ])->columnSpanFull(),
            ]);
    }
}
