<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Payday extends Model
{
    public $timestamps = [];
    public $casts = [
        'date' => 'datetime'
    ];

    public function schedule()
    {
        return $this->hasOne(Schedule::class, 'id', 'schedule_id');
    }
}
