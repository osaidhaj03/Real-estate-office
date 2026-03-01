<?php

namespace App\Filament\Admin\Resources\Brokers;

use App\Filament\Admin\Resources\Brokers\Pages\CreateBroker;
use App\Filament\Admin\Resources\Brokers\Pages\EditBroker;
use App\Filament\Admin\Resources\Brokers\Pages\ListBrokers;
use App\Filament\Admin\Resources\Brokers\Pages\ViewBroker;
use App\Filament\Admin\Resources\Brokers\Schemas\BrokerForm;
use App\Filament\Admin\Resources\Brokers\Schemas\BrokerInfolist;
use App\Filament\Admin\Resources\Brokers\Tables\BrokersTable;
use App\Models\Broker;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BrokerResource extends Resource
{
    protected static ?string $model = \App\Models\Broker::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-identification';

    protected static string|\UnitEnum|null $navigationGroup = 'العملاء والطلبات';

    protected static ?string $modelLabel = 'وسيط';

    protected static ?string $pluralModelLabel = 'الوسطاء';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return BrokerForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BrokerInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BrokersTable::configure($table);
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
            'index' => ListBrokers::route('/'),
            'create' => CreateBroker::route('/create'),
            'view' => ViewBroker::route('/{record}'),
            'edit' => EditBroker::route('/{record}/edit'),
        ];
    }
}
