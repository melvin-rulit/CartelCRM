<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counterparties extends Model
{
    use HasFactory;

    public function getFullName(): string
    {
        return sprintf('%s %s %s',  $this->first_name, $this->middle_name, $this->last_name);
    }
}
