<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deal extends Model
{
    use SoftDeletes;

    public const TYPE_RENT = 'rent';
    public const TYPE_CREDIT = 'credit';

    public const KIND_WITH_PROXY = 'proxy';
    public const KIND_WITH_OWNER = 'owner';

    protected $casts = [
        'valid_until'    => 'date',
        'cost_of_rent'   => 'float',
        'cost_of_buyout' => 'float',
        'initial'        => 'float',
    ];

    public function proxy(): HasOne
    {
        return $this->hasOne(Proxy::class, 'id', 'proxy_id');
    }

    public function owner(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

    public function branch(): HasOne
    {
        return $this->hasOne(Branch::class, 'id', 'branch_id');
    }

    public function client(): HasOne
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public function active(): HasOne
    {
        return $this->hasOne(Active::class, 'id', 'active_id');
    }

    public function schedule(): HasOne
    {
        return $this->hasOne(Schedule::class, 'deal_id', 'id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'deal_id', 'id');
    }

    public function getNextPayday(): ?string
    {
        if ($schedule = $this->schedule) {
            $nextPayday = Payday::query()
                ->where('schedule_id', $schedule->id)
                ->where('date', '>=', Carbon::now()->startOfDay())
                ->orderBy('date')
                ->first();

            if ($nextPayday) {
                return $nextPayday->date->format('d.m.Y');
            }
        }

        return null;
    }

    public function getInitial(): float
    {
        return $this->initial ?? 0;
    }
}
