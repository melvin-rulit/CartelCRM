<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CounterpartiesOrders extends Model
{
    use HasFactory;

    public function counterparties(): HasOne
    {
        return $this->hasOne(CounterpartiesOrders::class, 'id', 'counterparties_id');
    }

}
