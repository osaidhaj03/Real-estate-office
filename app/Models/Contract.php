<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contract extends Model
{
    protected $fillable = [
        'contract_number', 'listing_id', 'property_id', 'owner_id', 'client_id', 'broker_id',
        'contract_type', 'contract_value', 'commission_amount', 'broker_commission',
        'start_date', 'end_date', 'payment_method', 'status', 'notes',
    ];

    protected $casts = [
        'contract_value' => 'decimal:2',
        'commission_amount' => 'decimal:2',
        'broker_commission' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function broker(): BelongsTo
    {
        return $this->belongsTo(Broker::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function finances(): HasMany
    {
        return $this->hasMany(Finance::class);
    }
}
