<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    protected $fillable = [
        'property_type_id', 'owner_id', 'title', 'is_mortgaged', 'area',
        'location', 'address', 'description', 'notes',
        // حقول المباني
        'bedrooms', 'bathrooms', 'floor', 'building_age', 'furnished', 'direction',
        // حقول الأراضي
        'land_type', 'plan_number', 'plot_number', 'street_width',
    ];

    protected $casts = [
        'is_mortgaged' => 'boolean',
        'area' => 'decimal:2',
        'street_width' => 'decimal:2',
        'furnished' => 'boolean',
    ];

    public function propertyType(): BelongsTo
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }

    public function media(): HasMany
    {
        return $this->hasMany(PropertyMedia::class)->orderBy('sort_order');
    }

    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class);
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }
}
