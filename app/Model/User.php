<?php

declare(strict_types=1);

namespace App\Model;

use Carbon\Carbon;
use Core\Entities\UserEntity;
use Core\ValueObject\EmailValueObject;
use Core\ValueObject\HashedPasswordValueObject;
use Core\ValueObject\PasswordValueObject;
use Hyperf\Database\Model\Relations\BelongsToMany;
use DateTime;
use Hyperf\Database\Model\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class User extends Model implements UserEntity
{
    protected array $fillable = [
        'name',
        'email',
        'password',
        'token',
    ];

    protected array $hidden = [
        'password',
        'token',
    ];

    protected array $casts = [
        'id'         => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function profiles(): HasMany
    {
        return $this->hasMany(Profile::class);
    }

    public function getId(): int
    {
        return $this->attributes['id'];
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

    public function getEmail(): EmailValueObject
    {
        return new EmailValueObject($this->attributes['email']);
    }

    public function setEmail(EmailValueObject $email): self
    {
        $this->attributes['email'] = (string) $email;

        return $this;
    }

    public function getPassword(): ?HashedPasswordValueObject
    {
        if (empty($this->attributes['password'])) {
            return null;
        }

        return new HashedPasswordValueObject($this->attributes['password']);
    }

    public function setPassword(PasswordValueObject $password): self
    {
        $this->attributes['password'] = (string) $password->hashed();

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

    public function getEmailAttribute(): string
    {
        return (string) $this->getEmail();
    }

    public function setEmailAttribute(EmailValueObject $email): void
    {
        $this->setEmail($email);
    }

    public function getPasswordAttribute(): ?HashedPasswordValueObject
    {
        return $this->getPassword();
    }

    public function setPasswordAttribute(PasswordValueObject $password): void
    {
        $this->setPassword($password);
    }
}
