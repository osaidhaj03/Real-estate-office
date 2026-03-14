<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Broker extends Model
{
    protected $fillable = [
        'name', 'phone', 'phone2', 'id_number', 'nationality', 'address', 'notes', 'status', 'type',
    ];

    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class);
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }
}
