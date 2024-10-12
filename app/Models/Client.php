<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $casts = [
        'birthday' => 'date'
    ];

    public function branch()
    {
        return $this->hasOne(Branch::class, 'id', 'branch_id');
    }

    public function files()
    {
        return $this->hasMany(File::class, 'client_id', 'id');
    }

    public function getFullName(): string
    {
        return sprintf('%s %s %s', $this->last_name, $this->first_name, $this->middle_name);
    }
}
