<?php

namespace App\Models;

use App\Enum\RolesEnum;
use App\Models\NotUse\Branch;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/** @property string $name */
/** @property string $email */
/** @property string $password */
/** @property int $role_id */
/** @property int branch_id */
/** @property ?string $first_name */
/** @property ?string $middle_name */
/** @property ?string $last_name */
/** @property ?Carbon $birthday */
/** @property ?string $passport_series */
/** @property ?string $passport_number */
/** @property ?string $passport_notes */
/** @property ?string $registration_address */
/** @property ?string $phone_number */
/** @property ?string $comment */

/** @method find(int $id) */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    public const ROLE_ADMIN = 1;
    public const ROLE_MANAGER = 2;
    public const ROLE_INVESTOR = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'birthday',
        'email',
        'password',
        'passport_series',
        'passport_give',
        'passport_number',
        'passport_issuedBy',
        'passport_issuedByDate',
        'registration_address',
        'live_adress',
        'phone_number',
        'telegram',
        'password_see',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthday'          => 'date',
        'enabled'           => 'boolean'
    ];

    public static function getRoleName(int $userId)
    {
        $user = User::find($userId);
        if ($user) {
            // Получаем первую роль пользователя
            return $user->getRoleNames()->first();

            // Если роль существует, возвращаем её русское название
//            if ($role && array_key_exists(strtolower($role), RolesEnum::labels())) {
//                return RolesEnum::labels()[strtolower($role)];
//            }
        }
    }

//    public static function getRoleName(int $id): string
//    {
//        return match ($id) {
//            1 => 'Администратор',
//            2 => 'Менеджер',
//            3 => 'Инвестор',
//            default => 'Не задана',
//        };
//    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function isAdmin(): bool
    {
        return $this->role_id === self::ROLE_ADMIN;
    }

//    public function isManager(): bool
//    {
//        return $this->role_id === self::ROLE_MANAGER;
//    }
//
//    public function isInvestor(): bool
//    {
//        return $this->role_id === self::ROLE_INVESTOR;
//    }

    public function getBranchId(): ?int
    {
        return $this->branch_id;
    }

    public function getFullName(): string
    {
        return sprintf('%s %s %s',  $this->first_name, $this->middle_name, $this->last_name);
    }
}
