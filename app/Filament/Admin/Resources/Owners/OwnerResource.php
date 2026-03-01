<?php

namespace App\Filament\Admin\Resources\Owners;

use App\Filament\Admin\Resources\Owners\Pages\CreateOwner;
use App\Filament\Admin\Resources\Owners\Pages\EditOwner;
use App\Filament\Admin\Resources\Owners\Pages\ListOwners;
use App\Filament\Admin\Resources\Owners\Pages\ViewOwner;
use App\Filament\Admin\Resources\Owners\Schemas\OwnerForm;
use App\Filament\Admin\Resources\Owners\Schemas\OwnerInfolist;
use App\Filament\Admin\Resources\Owners\Tables\OwnersTable;
use App\Models\Owner;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OwnerResource extends Resource
{
    protected static ?string $model = \App\Models\Owner::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';

    protected static string|\UnitEnum|null $navigationGroup = 'جهات الاتصال';

    protected static ?string $modelLabel = 'مالك';

    protected static ?string $pluralModelLabel = 'المُلَّاك';

    public static function form(Schema $schema): Schema
    {
        return OwnerForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return OwnerInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OwnersTable::configure($table);
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
            'index' => ListOwners::route('/'),
            'create' => CreateOwner::route('/create'),
            'view' => ViewOwner::route('/{record}'),
            'edit' => EditOwner::route('/{record}/edit'),
        ];
    }
}
