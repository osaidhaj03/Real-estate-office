<?php

namespace App\Filament\Admin\Resources\PropertyTypes\Pages;

use App\Filament\Admin\Resources\PropertyTypes\PropertyTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPropertyType extends EditRecord
{
    protected static string $resource = PropertyTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
