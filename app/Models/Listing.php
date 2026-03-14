<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Listing extends Model
{
    protected $fillable = [
        'property_id', 'listing_type', 'broker_id', 'source',
        'asking_price', 'minimum_price', 
        'rent_price', 'rent_cycle', 'security_deposit',
        'is_negotiable', 'accepts_installments',
        'status', 'start_date', 'end_date', 'notes',
    ];

    protected $casts = [
        'asking_price' => 'decimal:2',
        'minimum_price' => 'decimal:2',
        'rent_price' => 'decimal:2',
        'security_deposit' => 'decimal:2',
        'is_negotiable' => 'boolean',
        'accepts_installments' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function broker(): BelongsTo
    {
        return $this->belongsTo(Broker::class);
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }
}
