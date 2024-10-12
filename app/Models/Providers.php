<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Providers extends Model
{
    use HasFactory;

    public function getFullName(): string
    {
        return sprintf('%s %s %s', $this->last_name, $this->first_name, $this->middle_name);
    }
}
