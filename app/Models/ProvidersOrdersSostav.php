<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvidersOrdersSostav extends Model
{
    use HasFactory;

    protected $fillable = [
      'provider_order_id',
      'brand',
      'model',
      'state',
      'params_model',
      'color',
      'city',
      'series_number',
      'prise',
      'prise_pay',
    ];
}
