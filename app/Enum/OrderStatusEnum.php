<?php

namespace App\Enum;

enum OrderStatusEnum: string
{
    const ForPayment = 'for_payment';
    const PENDING = 'pending';
    const COMPLETED = 'completed';
    const CANCELED = 'canceled';

    public static function labels(): array
    {
        return [
            self::ForPayment => 'К оплате',
            self::PENDING => 'В ожидании',
            self::COMPLETED => 'Выполнен',
            self::CANCELED => 'Отменен',
        ];
    }
}
