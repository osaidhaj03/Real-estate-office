<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    protected $fillable = [
        'name', 'phone', 'phone2', 'email', 'id_number',
        'nationality', 'client_type', 'company_name', 'address', 'notes',
    ];

    public function requests(): HasMany
    {
        return $this->hasMany(ClientRequest::class);
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }
}
