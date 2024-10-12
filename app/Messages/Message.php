<?php

namespace App\Messages;

interface Message
{
    public function buildMessage(): string;
}
