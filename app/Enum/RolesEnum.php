<?php

namespace App\Enum;

enum RolesEnum: string
{
    const ADMIN = 'admin';
    const COURIER = 'courier';
    const CASHIER = 'cashier';
    const MANAGER = 'manager';
    const GUEST = 'guest';

    public static function labels(): array
    {
        return [
            self::ADMIN => 'Администратор',
            self::COURIER => 'Курьер',
            self::CASHIER => 'Кассир',
            self::MANAGER => 'Менеджер',
            self::GUEST => 'Гость',
        ];
    }
}
