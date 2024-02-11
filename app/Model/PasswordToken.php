<?php

declare(strict_types=1);

namespace App\Model;

use Carbon\Carbon;
use Core\Entities\PasswordTokenEntity;
use Core\Entities\UserEntity;
use DateTime;

/**
 * @property int $id
 * @property string $user_id
 * @property string $token
 * @property Carbon $expires_at
 */
class PasswordToken extends Model implements PasswordTokenEntity
{
    public const CREATED_AT = null;
    public const UPDATED_AT = null;

    protected array $fillable = [
        'user_id',
        'token',
        'expires_at',
    ];

    protected array $casts = [
        'id'         => 'integer',
        'expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): UserEntity
    {
        return $this->getAttribute('user');
    }

    public function getToken(): string
    {
        return $this->attributes['token'];
    }

    public function setToken(string $token): self
    {
        $this->attributes['token'] = $token;

        return $this;
    }

    public function getExpiresAt(): DateTime
    {
        return $this->attributes['expires_at'];
    }

    public function setExpiresAt(DateTime $expiresAt): self
    {
        $this->attributes['expires_at'] = $expiresAt;

        return $this;
    }
}
