<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DealRecord extends Model
{
    public function deal()
    {
        return $this->hasOne(Deal::class, 'id', 'deal_id');
    }

    public function operation()
    {
        return $this->hasOne(Operation::class, 'id', 'operation_id');
    }
}
