<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Operation extends Model
{
    use HasFactory;

    public const TYPE_POSITIVE = 1;
    public const TYPE_NEGATIVE = 2;

    private const TYPES_NAMES = [
        self::TYPE_POSITIVE => 'Приход',
        self::TYPE_NEGATIVE => 'Расход',
    ];

    public $timestamps = [];
    protected $casts = [
        'date' => 'datetime'
    ];

    public function active(): HasOne
    {
        return $this->hasOne(Active::class, 'id', 'active_id');
    }

    public static function getOperationName(int $operationId)
    {
        if (array_key_exists($operationId, self::TYPES_NAMES)) {
            return self::TYPES_NAMES[$operationId];
        }

        throw new \LogicException('Operation type not found');
    }
}
