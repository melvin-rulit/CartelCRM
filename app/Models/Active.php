<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Active extends Model
{
    use SoftDeletes;

    protected $casts = [
        'document_date' => 'date'
    ];

    public function branch()
    {
        return $this->hasOne(Branch::class, 'id', 'branch_id')->orWhereNotNull('deleted_at');
    }

    public function investor()
    {
        return $this->hasOne(User::class, 'id', 'investor_id')->orWhereNotNull('deleted_at');
    }

    public function deal()
    {
        return $this->hasOne(Deal::class, 'active_id', 'id')->orWhereNotNull('deleted_at');;
    }

    public function getName(): string
    {
        return sprintf('%s (%s)', $this->model, $this->reg_number);
    }

    public function getColor(): string
    {
        $colors = [
            1 => 'Белый',
            2 => 'Черный',
            3 => 'Красный',
            4 => 'Серый',
            5 => 'Голубой',
            6 => 'Коричневый',
            7 => 'Зеленый',
            8 => 'Желтый',
        ];

        return $colors[$this->color_id] ?? 'Не указан';
    }

    public function getRemainAttribute()
    {
        $remain = $this->cost;

        if ($this->deal) {
            $buyoutSum = 0;
            foreach ($this->deal->payments as $payment) {
                $buyoutSum += $payment->buyout;
            }
            $remain -= $buyoutSum;
        }

        return $remain;
    }
}
