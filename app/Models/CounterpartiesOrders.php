<?php

namespace App\Models;

use App\Http\Resources\Counterparties\Orders\OrderResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CounterpartiesOrders extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'order_date',
        'delivery_address',
        'status',
        'manager_id',
        'counterpart_id',
    ];

    public function counterpart(): BelongsTo
    {
        return $this->belongsTo(Counterparties::class, 'counterpart_id', 'id');
    }

    public function getFullName(): string
    {
        return sprintf('%s %s %s',  $this->first_name, $this->middle_name, $this->last_name);
    }

    public function sostavs(): HasMany
    {
        return $this->hasMany(CounterpartiesOrdersSostav::class, 'counterparty_order_id ', 'id');
    }

}
