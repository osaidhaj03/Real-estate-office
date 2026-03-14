<?php

namespace App\Filament\Admin\Resources\Properties\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;

class PropertyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('البيانات الأساسية')
                        ->description('النوع، المالك، والسعر')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('معلومات رئيسية')
                                ->schema([
                                    Select::make('property_type_id')
                                        ->relationship('propertyType', 'name')
                                        ->label('نوع العقار')
                                        ->required()
                                        ->searchable()
                                        ->preload()
                                        ->createOptionForm([
                                            TextInput::make('name')
                                                ->label('اسم النوع (مثال: شقة، فيلا، أرض)')
                                                ->required()
                                                ->maxLength(255)
                                                ->prefixIcon('heroicon-m-home'),
                                            Textarea::make('description')
                                                ->label('وصف إضافي')
                                                ->rows(3)
                                                ->maxLength(65535),
                                        ])
                                        ->live(),
                                    Select::make('owner_id')
                                        ->relationship('owner', 'name')
                                        ->label('المالك')
                                        ->required()
                                        ->searchable()
                                        ->preload()
                                        ->prefixIcon('heroicon-m-user')
                                        ->createOptionForm([
                                            TextInput::make('name')
                                                ->label('الاسم الكامل (أو اسم الشركة)')
                                                ->required()
                                                ->maxLength(255)
                                                ->prefixIcon('heroicon-m-user'),
                                            TextInput::make('phone')
                                                ->label('رقم الهاتف الأساسي')
                                                ->tel()
                                                ->required()
                                                ->maxLength(255)
                                                ->prefixIcon('heroicon-m-phone'),
                                            Select::make('owner_type')
                                                ->label('نوع المالك')
                                                ->options([
                                                    'individual' => 'فرد',
                                                    'company' => 'شركة',
                                                ])
                                                ->default('individual')
                                                ->required()
                                                ->native(false)
                                                ->prefixIcon('heroicon-m-building-office-2'),
                                        ]),
                                ])->columns(2),

                            TextInput::make('title')
                                ->label('اسم/عنوان الإعلان للعقار')
                                ->required()
                                ->maxLength(255)
                                ->prefixIcon('heroicon-m-document-text')
                                ->columnSpanFull(),

                            Section::make('المساحة والملكية')
                                ->schema([
                                    TextInput::make('area')
                                        ->numeric()
                                        ->label('المساحة (م²)')
                                        ->prefixIcon('heroicon-m-arrows-pointing-out')
                                        ->default(null),
                                    Toggle::make('is_mortgaged')
                                        ->label('العقار مرهون؟')
                                        ->default(false)
                                        ->inline(false),
                                ])->columns(2),
                        ]),

                    Step::make('تفاصيل العقار')
                        ->description('المواصفات والخصائص')
                        ->icon('heroicon-o-building-office-2')
                        ->schema([
                            Section::make('تفاصيل المبنى')
                                ->description('تملأ فقط في حال كان العقار عبارة عن مبنى شقة، فيلا الخ')
                                ->visible(fn (\Filament\Schemas\Components\Utilities\Get $get) => $get('property_type_id') && \App\Models\PropertyType::find($get('property_type_id'))?->name !== 'أرض')
                                ->schema([
                                    TextInput::make('bedrooms')
                                        ->label('غرف النوم')
                                        ->numeric()
                                        ->prefixIcon('heroicon-m-moon')
                                        ->default(null),
                                    TextInput::make('bathrooms')
                                        ->label('دورات المياه')
                                        ->numeric()
                                        ->prefixIcon('heroicon-m-sparkles')
                                        ->default(null),
                                    TextInput::make('living_rooms')
                                        ->label('غرف الجلوس / الصالات')
                                        ->numeric()
                                        ->prefixIcon('heroicon-m-tv')
                                        ->default(null),
                                    TextInput::make('floor')
                                        ->label('الطابق')
                                        ->numeric()
                                        ->default(null),
                                    TextInput::make('building_age')
                                        ->label('عمر المبنى (سنوات)')
                                        ->numeric()
                                        ->default(null),
                                    Select::make('direction')
                                        ->label('الواجهة')
                                        ->options([
                                            'شمالي' => 'شمالي',
                                            'جنوبي' => 'جنوبي',
                                            'شرقي' => 'شرقي',
                                            'غربي' => 'غربي',
                                        ])
                                        ->default(null),
                                    Toggle::make('furnished')
                                        ->label('مفروش')
                                        ->default(false),
                                    Toggle::make('has_parking')
                                        ->label('يوجد موقف سيارات')
                                        ->default(false),
                                ])->columns(3),

                            Section::make('تفاصيل الأرض')
                                ->description('تملأ فقط في حال كان العقار أرض')
                                ->visible(fn (\Filament\Schemas\Components\Utilities\Get $get) => $get('property_type_id') && \App\Models\PropertyType::find($get('property_type_id'))?->name === 'أرض')
                                ->schema([
                                    Select::make('land_type')
                                        ->label('نوع الأرض')
                                        ->options([
                                            'residential' => 'سكني',
                                            'commercial' => 'تجاري',
                                            'agricultural' => 'زراعي',
                                            'industrial' => 'صناعي',
                                        ])
                                        ->native(false)
                                        ->default(null),
                                    TextInput::make('plan_number')
                                        ->label('رقم المخطط')
                                        ->prefixIcon('heroicon-m-map')
                                        ->default(null),
                                    TextInput::make('plot_number')
                                        ->label('رقم القطعة')
                                        ->prefixIcon('heroicon-m-square-3-stack-3d')
                                        ->default(null),
                                    TextInput::make('street_width')
                                        ->label('عرض الشارع (متر)')
                                        ->numeric()
                                        ->prefixIcon('heroicon-m-arrows-right-left')
                                        ->default(null),
                                ])->columns(2),
                        ]),

                    Step::make('العنوان والمزيد')
                        ->description('الموقع الجغرافي والوصف')
                        ->icon('heroicon-o-map-pin')
                        ->schema([
                            TextInput::make('location')
                                ->label('المنطقة / الحي')
                                ->prefixIcon('heroicon-m-map-pin')
                                ->default(null),
                            Textarea::make('address')
                                ->label('العنوان التفصيلي')
                                ->rows(2)
                                ->default(null)
                                ->columnSpanFull(),
                            Textarea::make('description')
                                ->label('وصف العقار للإعلان')
                                ->rows(4)
                                ->default(null)
                                ->columnSpanFull(),
                            Textarea::make('notes')
                                ->label('ملاحظات إدارية (لا تظهر للعملاء)')
                                ->rows(3)
                                ->default(null)
                                ->columnSpanFull(),
                        ]),
                ])->columnSpanFull()
            ]);
    }
}
