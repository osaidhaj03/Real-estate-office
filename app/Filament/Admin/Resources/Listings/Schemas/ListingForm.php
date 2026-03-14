<?php

namespace App\Filament\Admin\Resources\Listings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;

class ListingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('العقار الأساسي')
                        ->description('تحديد العقار ومصدره')
                        ->icon('heroicon-o-home-modern')
                        ->schema([
                            Section::make('معلومات العقار')
                                ->schema([
                                    Select::make('property_id')
                                        ->relationship('property', 'title')
                                        ->label('العقار المرتبط')
                                        ->required()
                                        ->searchable()
                                        ->preload()
                                        ->prefixIcon('heroicon-m-home'),
                                    
                                    Select::make('source')
                                        ->options([
                                            'owner' => 'من المالك مباشرة',
                                            'broker' => 'عن طريق وسيط عقاري',
                                        ])
                                        ->label('مصدر العرض')
                                        ->default('owner')
                                        ->required()
                                        ->live()
                                        ->native(false)
                                        ->prefixIcon('heroicon-m-link'),

                                    Select::make('broker_id')
                                        ->relationship('broker', 'name')
                                        ->label('الوسيط العقاري')
                                        ->searchable()
                                        ->preload()
                                        ->prefixIcon('heroicon-m-user-circle')
                                        ->visible(fn (\Filament\Schemas\Components\Utilities\Get $get) => $get('source') === 'broker')
                                        ->required(fn (\Filament\Schemas\Components\Utilities\Get $get) => $get('source') === 'broker'),
                                ])->columns(2),
                        ]),

                    Step::make('التسعير والشروط')
                        ->description('الماليات حسب نوع العرض')
                        ->icon('heroicon-o-currency-dollar')
                        ->schema([
                            Select::make('listing_type')
                                ->options([
                                    'sale' => 'للبيع',
                                    'rent' => 'للإيجار',
                                ])
                                ->label('نوع العرض')
                                ->required()
                                ->live()
                                ->native(false)
                                ->prefixIcon('heroicon-m-tag')
                                ->columnSpanFull(),

                            Section::make('تفاصيل البيع')
                                ->visible(fn (\Filament\Schemas\Components\Utilities\Get $get) => $get('listing_type') === 'sale')
                                ->schema([
                                    TextInput::make('asking_price')
                                        ->label('السعر المطلوب للإعلان')
                                        ->numeric()
                                        ->required()
                                        ->prefixIcon('heroicon-m-banknotes')
                                        ->suffix('ريال'),
                                    
                                    TextInput::make('minimum_price')
                                        ->label('الحد الأدنى للبيع (للإدارة فقط)')
                                        ->numeric()
                                        ->prefixIcon('heroicon-m-lock-closed')
                                        ->suffix('ريال')
                                        ->helperText('لا يظهر هذا السعر للعملاء، وهو لمساعدة موظفيك في التفاوض.'),
                                ])->columns(2),

                            Section::make('تفاصيل الإيجار')
                                ->visible(fn (\Filament\Schemas\Components\Utilities\Get $get) => $get('listing_type') === 'rent')
                                ->schema([
                                    TextInput::make('rent_price')
                                        ->label('قيمة الإيجار')
                                        ->numeric()
                                        ->required()
                                        ->prefixIcon('heroicon-m-banknotes')
                                        ->suffix('ريال'),
                                    
                                    Select::make('rent_cycle')
                                        ->options([
                                            'monthly' => 'شهري',
                                            'quarterly' => 'ربع سنوي (٣ أشهر)',
                                            'semi_annually' => 'نصف سنوي (٦ أشهر)',
                                            'annually' => 'سنوي',
                                        ])
                                        ->label('دورة الإيجار')
                                        ->required()
                                        ->native(false),

                                    TextInput::make('security_deposit')
                                        ->label('مبلغ التأمين (إن وجد)')
                                        ->numeric()
                                        ->prefixIcon('heroicon-m-shield-check')
                                        ->suffix('ريال')
                                        ->default(null),
                                ])->columns(3),

                            Section::make('شروط إضافية')
                                ->schema([
                                    Toggle::make('is_negotiable')
                                        ->label('السعر قابل للتفاوض')
                                        ->default(false),
                                    Toggle::make('accepts_installments')
                                        ->label('يقبل الدفع بالتقسيط/دفعات')
                                        ->default(false),
                                ])->columns(2),
                        ]),

                    Step::make('الحالة والتاريخ')
                        ->description('حالة العرض والمدة')
                        ->icon('heroicon-o-calendar-days')
                        ->schema([
                            Section::make('الحالة')
                                ->schema([
                                    Select::make('status')
                                        ->options([
                                            'active' => 'نشط',
                                            'suspended' => 'معلّق / مخفي',
                                            'sold' => 'تم البيع',
                                            'rented' => 'تم التأجير',
                                            'expired' => 'منتهي الصلاحية / ملغى',
                                        ])
                                        ->label('حالة العرض')
                                        ->default('active')
                                        ->required()
                                        ->native(false)
                                        ->prefixIcon('heroicon-m-arrow-path'),
                                    
                                    DatePicker::make('start_date')
                                        ->label('تاريخ بداية العرض')
                                        ->default(now()),

                                    DatePicker::make('end_date')
                                        ->label('تاريخ انتهاء العرض (إن وجد)'),
                                ])->columns(3),

                            Textarea::make('notes')
                                ->label('ملاحظات إدارية')
                                ->rows(4)
                                ->default(null)
                                ->columnSpanFull(),
                        ]),
                ])->columnSpanFull()
            ]);
    }
}
