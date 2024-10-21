<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProvidersOrders extends Model
{
    use HasFactory;

    public function provider(): HasOne
    {
        return $this->hasOne(Providers::class, 'id', 'provider_id');
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function getFullName(): string
    {
        return sprintf('%s %s %s',  $this->first_name, $this->middle_name, $this->last_name);
    }

    public function sostavs(): HasMany
    {
        return $this->hasMany(ProvidersOrdersSostav::class, 'provider_order_id', 'id');
    }

}
