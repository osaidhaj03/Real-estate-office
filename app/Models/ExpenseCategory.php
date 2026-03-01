<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExpenseCategory extends Model
{
    protected $fillable = ['name', 'type'];

    public function finances(): HasMany
    {
        return $this->hasMany(Finance::class, 'category_id');
    }
}
