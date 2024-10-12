<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    public $timestamps = [];
    public $casts = [
        'amount' => 'float',
        'percent' => 'float',
    ];

    public function investor()
    {
        return $this->hasOne(User::class, 'id', 'investor_id')
            ->orWhereNotNull('deleted_at');
    }
}
