<?php

namespace App\Messages;


use Carbon\Carbon;

class OverduePayment implements Message
{
    private Carbon $payday;

    public function __construct(Carbon $payday)
    {
        $this->payday = $payday;
    }

    public function buildMessage(): string
    {
        return sprintf('Здравствуйте, вы пропустили платеж %s, срочно погасите задолженность', $this->payday->format('d.m.Y'));
    }
}
