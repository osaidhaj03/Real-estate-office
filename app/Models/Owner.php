<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Owner extends Model
{
    protected $fillable = [
        'name', 'phone', 'phone2', 'email', 'id_number',
        'nationality', 'owner_type', 'company_name', 'address', 'notes',
    ];

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }
}
