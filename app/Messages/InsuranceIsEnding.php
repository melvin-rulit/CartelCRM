<?php

namespace App\Messages;


use Carbon\Carbon;

class InsuranceIsEnding implements Message
{
    private Carbon $validUntil;
    private string $activeName;

    public function __construct(Carbon $validUntil, string $activeName)
    {
        $this->validUntil = $validUntil;
        $this->activeName = $activeName;
    }

    public function buildMessage(): string
    {
        return sprintf('Здравствуйте, срок действия ОСАГО по авто %s завершается %s. Пожалуйста, продлите полис ОСАГО', $this->activeName, $this->validUntil->format('d.m.Y'));
    }
}
