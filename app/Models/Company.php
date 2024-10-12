<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/** @property string name */
/** @method find(int $id) */
class Company extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->hasMany(User::class, 'company_id', 'id');
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'company_id', 'id');
    }

    public function operations()
    {
        return $this->hasMany(Operation::class, 'company_id', 'id');
    }
}
