<?php

namespace App\Filament\Admin\Resources\ExpenseCategories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ExpenseCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('اسم الفئة')
                    ->required(),
                Select::make('type')
                    ->label('نوع الفئة')
                    ->options([
                        'income' => 'إيراد', 
                        'expense' => 'مصروف'
                    ])
                    ->required(),
            ]);
    }
}
