<?php

namespace App\Filament\Admin\Resources\PropertyTypes\Pages;

use App\Filament\Admin\Resources\PropertyTypes\PropertyTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPropertyTypes extends ListRecords
{
    protected static string $resource = PropertyTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
