<?php

declare(strict_types=1);

namespace App\Model;

use Core\Entities\ProfileEntity;
use Core\Entities\UserEntity;
use DateTime;
use Hyperf\Database\Model\Relations\BelongsTo;

/**
 * @property int $id 
 * @property int $user_id 
 * @property string $name 
 * @property string $username 
 * @property string $avatar 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 */
class Profile extends Model implements ProfileEntity
{
    protected array $fillable = [
        'name',
        'username',
        'avatar',
    ];

    protected array $casts = [
        'id'         => 'integer',
        'user_id'    => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getUser(): UserEntity
    {
        return $this->getAttribute('user');
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function setName(string $name): self
    {
        $this->attributes['name'] = $name;

        return $this;
    }

    public function getUsername(): string
    {
        return $this->attributes['username'];
    }

    public function setUsername(string $username): self
    {
        $this->attributes['username'] = $username;

        return $this;
    }

    public function getAvatar(): string
    {
        return $this->attributes['avatar'];
    }

    public function setAvatar(string $avatar): self
    {
        $this->attributes['avatar'] = $avatar;

        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->attributes['updated_at'];
    }
}
