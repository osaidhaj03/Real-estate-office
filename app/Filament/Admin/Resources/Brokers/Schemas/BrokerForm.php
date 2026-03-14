<?php

namespace App\Filament\Admin\Resources\Brokers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BrokerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('المعلومات الشخصية')
                    ->description('البيانات الأساسية للوسيط العقاري')
                    ->icon('heroicon-o-user')
                    ->collapsible()
                    ->schema([
                        

                        TextInput::make('name')
                            ->label('الاسم الكامل (أو اسم الشركة)')
                            ->required()
                            ->maxLength(255)
                            ->prefixIcon('heroicon-m-user')
                            ->columnSpanFull(),   
                        Select::make('type')
                            ->label('نوع الوسيط')
                            ->options([
                                'individual' => 'فرد',
                                'company' => 'شركة',
                            ])
                            ->default('individual')
                            ->required()
                            ->native(false)
                            ->prefixIcon('heroicon-m-building-office-2'),
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
                    ])->columns(3)->columnSpanFull(),

                Section::make('معلومات التواصل')
                    ->description('أرقام الهواتف والعنوان الخاص بالوسيط')
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

                        Textarea::make('address')
                            ->label('العنوان')
                            ->rows(1)
                            ->default(null)
                            ->columnSpanFull(),
                    ])->columns(2)->columnSpanFull(),

                Section::make('الحالة والملاحظات')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        Select::make('status')
                            ->label('حالة الوسيط')
                            ->options([
                                'active' => 'نشط', 
                                'inactive' => 'غير نشط'
                            ])
                            ->native(false)
                            ->default('active')
                            ->required()
                            ->prefixIcon('heroicon-m-check-circle'),

                        Textarea::make('notes')
                            ->label('ملاحظات إضافية')
                            ->rows(5)
                            ->default(null),
                    ])->columnSpanFull(),
            ]);
    }
}
