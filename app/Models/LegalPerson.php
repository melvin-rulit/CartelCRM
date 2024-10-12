<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalPerson extends Model
{
    use HasFactory;

    protected $table = 'legal_persons';

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public function deals()
    {
        return $this->hasMany(Deal::class, 'legal_person_id', 'id');
    }
}
