<?php

namespace App\Filament\Admin\Resources\PropertyTypes\Pages;

use App\Filament\Admin\Resources\PropertyTypes\PropertyTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePropertyType extends CreateRecord
{
    protected static string $resource = PropertyTypeResource::class;
}
