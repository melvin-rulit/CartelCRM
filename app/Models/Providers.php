<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Providers extends Model
{
    use HasFactory;

    public function getFullName(): string
    {
        return sprintf('%s %s %s',  $this->first_name, $this->middle_name, $this->last_name);
    }

    public function getFullNameWithContacts(): string
    {
        return sprintf('%s %s %s ( telegram: %s  Телефон: %s )',  $this->first_name, $this->middle_name, $this->last_name, $this->telegram_login, $this->phone);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(ProvidersOrders::class, 'provider_id');
    }
}
