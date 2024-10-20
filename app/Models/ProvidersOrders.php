<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvidersOrders extends Model
{
    use HasFactory;

    public function provider()
    {
        return $this->hasOne(Providers::class, 'id', 'provider_id');
    }

//    public function provider()
//    {
//        return $this->belongsTo(Provider::class);
//    }
}
