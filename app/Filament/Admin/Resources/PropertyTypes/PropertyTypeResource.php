<?php

namespace App\Filament\Admin\Resources\PropertyTypes;

use App\Filament\Admin\Resources\PropertyTypes\Pages\CreatePropertyType;
use App\Filament\Admin\Resources\PropertyTypes\Pages\EditPropertyType;
use App\Filament\Admin\Resources\PropertyTypes\Pages\ListPropertyTypes;
use App\Filament\Admin\Resources\PropertyTypes\Schemas\PropertyTypeForm;
use App\Filament\Admin\Resources\PropertyTypes\Tables\PropertyTypesTable;
use App\Models\PropertyType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PropertyTypeResource extends Resource
{
    protected static ?string $model = PropertyType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHomeModern;

    protected static string|\UnitEnum|null $navigationGroup = 'العقارات';

    protected static ?string $modelLabel = 'نوع عقار';

    protected static ?string $pluralModelLabel = 'أنواع العقارات';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return PropertyTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PropertyTypesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPropertyTypes::route('/'),
            'create' => CreatePropertyType::route('/create'),
            'edit' => EditPropertyType::route('/{record}/edit'),
        ];
    }
}
