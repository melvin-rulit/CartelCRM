<?php

namespace App\Messages;

use Carbon\Carbon;

class PaydayIsComing implements Message
{
    private Carbon $payday;
    private float $summa;

    public function __construct(Carbon $payday, float $summa)
    {
        $this->payday = $payday;
        $this->summa = $summa;
    }

    public function buildMessage(): string
    {
        return sprintf(
            'Здравствуйте, напоминаем о платеже %s по договору на сумму %s',
            $this->payday->format('d.m.Y'),
            $this->summa
        );
    }
}
