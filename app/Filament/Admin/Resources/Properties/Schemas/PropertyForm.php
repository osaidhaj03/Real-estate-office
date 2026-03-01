<?php

namespace App\Filament\Admin\Resources\Properties\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;

class PropertyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Tabs::make('تفاصيل العقار الأساسية والفرعية')
                    ->tabs([
                        \Filament\Schemas\Components\Tabs\Tab::make('المعلومات الأساسية')
                            ->schema([
                                Select::make('property_type_id')
                                    ->relationship('propertyType', 'name')
                                    ->label('نوع العقار')
                                    ->required()
                                    ->live(), // لتمكين التفاعل الديناميكي
                                Select::make('owner_id')
                                    ->relationship('owner', 'name')
                                    ->label('المالك')
                                    ->required()
                                    ->searchable()
                                    ->preload(),
                                TextInput::make('title')
                                    ->label('اسم/عنوان العقار')
                                    ->required(),
                                Select::make('status')
                                    ->options(['available' => 'متاح', 'reserved' => 'محجوز', 'sold' => 'مباع', 'rented' => 'مؤجر'])
                                    ->default('available')
                                    ->label('الحالة')
                                    ->required(),
                                TextInput::make('price')
                                    ->numeric()
                                    ->label('السعر')
                                    ->default(null),
                                TextInput::make('area')
                                    ->numeric()
                                    ->label('المساحة (م²)')
                                    ->default(null),
                                TextInput::make('location')
                                    ->label('المنطقة/الحي')
                                    ->default(null),
                                Textarea::make('address')
                                    ->label('العنوان التفصيلي')
                                    ->default(null)
                                    ->columnSpanFull(),
                                Textarea::make('description')
                                    ->label('الوصف')
                                    ->default(null)
                                    ->columnSpanFull(),
                                Textarea::make('notes')
                                    ->label('ملاحظات')
                                    ->default(null)
                                    ->columnSpanFull(),
                            ])->columns(2),

                        \Filament\Schemas\Components\Tabs\Tab::make('تفاصيل المبنى')
                            ->visible(fn (\Filament\Schemas\Components\Utilities\Get $get) => $get('property_type_id') && \App\Models\PropertyType::find($get('property_type_id'))?->name !== 'أرض')
                            ->schema([
                                TextInput::make('bedrooms')
                                    ->label('غرف النوم')
                                    ->numeric()
                                    ->default(null),
                                TextInput::make('bathrooms')
                                    ->label('دورات المياه')
                                    ->numeric()
                                    ->default(null),
                                TextInput::make('living_rooms')
                                    ->label('غرف الجلوس / الصالات')
                                    ->numeric()
                                    ->default(null),
                                TextInput::make('built_year')
                                    ->label('سنة البناء')
                                    ->numeric()
                                    ->default(null),
                                TextInput::make('floors')
                                    ->label('عدد الطوابق')
                                    ->numeric()
                                    ->default(null),
                                Toggle::make('has_parking')
                                    ->label('يوجد موقف سيارات')
                                    ->default(false),
                            ])->columns(2),

                        \Filament\Schemas\Components\Tabs\Tab::make('تفاصيل الأرض')
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
                                    ->default(null),
                                TextInput::make('plan_number')
                                    ->label('رقم المخطط')
                                    ->default(null),
                                TextInput::make('plot_number')
                                    ->label('رقم القطعة')
                                    ->default(null),
                                TextInput::make('street_width')
                                    ->label('عرض الشارع (متر)')
                                    ->numeric()
                                    ->default(null),
                            ])->columns(2),
                    ])->columnSpanFull(),
            ]);
    }
}
