<?php

namespace App\Filament\Admin\Resources\ExpenseCategories;

use App\Filament\Admin\Resources\ExpenseCategories\Pages\CreateExpenseCategory;
use App\Filament\Admin\Resources\ExpenseCategories\Pages\EditExpenseCategory;
use App\Filament\Admin\Resources\ExpenseCategories\Pages\ListExpenseCategories;
use App\Filament\Admin\Resources\ExpenseCategories\Pages\ViewExpenseCategory;
use App\Filament\Admin\Resources\ExpenseCategories\Schemas\ExpenseCategoryForm;
use App\Filament\Admin\Resources\ExpenseCategories\Schemas\ExpenseCategoryInfolist;
use App\Filament\Admin\Resources\ExpenseCategories\Tables\ExpenseCategoriesTable;
use App\Models\ExpenseCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ExpenseCategoryResource extends Resource
{
    protected static ?string $model = \App\Models\ExpenseCategory::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-tag';

    protected static string|\UnitEnum|null $navigationGroup = 'المالية والعقود';

    protected static ?string $modelLabel = 'فئة مصروفات';

    protected static ?string $pluralModelLabel = 'فئات المصروفات';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ExpenseCategoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ExpenseCategoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExpenseCategoriesTable::configure($table);
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
            'index' => ListExpenseCategories::route('/'),
            'create' => CreateExpenseCategory::route('/create'),
            'view' => ViewExpenseCategory::route('/{record}'),
            'edit' => EditExpenseCategory::route('/{record}/edit'),
        ];
    }
}
