<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    public $timestamps = [];

    public function paydays(): HasMany
    {
        return $this->hasMany(Payday::class, 'schedule_id', 'id');
    }
}
