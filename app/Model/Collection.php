<?php

declare(strict_types=1);

namespace App\Model;

use Core\Entities\CollectionEntity;
use Core\Entities\ProfileEntity;
use DateTime;
use Hyperf\Collection\Collection as HyperfCollection;
use Hyperf\Database\Model\Relations\BelongsTo;
use Hyperf\Database\Model\Relations\BelongsToMany;
use Hyperf\Database\Model\SoftDeletes;
use Ramsey\Uuid\Uuid;

/**
 * @property int $id
 * @property int $profile_id
 * @property string $name
 * @property string $description
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Collection extends Model implements CollectionEntity
{
    use SoftDeletes;

    protected array $fillable = [
        'profile_id',
        'name',
        'description',
    ];

    protected array $casts = [
        'id'          => 'integer',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime'
    ];

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function links(): BelongsToMany
    {
        return $this->belongsToMany(Link::class);
    }
    
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getProfile(): ProfileEntity
    {
        return $this->getAttribute('profile');
    }

    public function setProfile(ProfileEntity $profile): self
    {
        $this->attributes['profile_id'] = $profile->getId();

        return $this;
    }

    public function getLinks(): HyperfCollection
    {
        return $this->getAttribute('links');
    }

    public function getHash(): string
    {
        return $this->attributes['hash'];
    }

    public function addHash(): self
    {
        $this->attributes['hash'] = Uuid::uuid4()->toString();

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->attributes['description'] ?? null;
    }

    public function setDescription(?string $description = null): self
    {
        $this->attributes['description'] = $description;

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

    public function getDeletedAt(): DateTime
    {
        return $this->attributes['deleted_at'];
    }
}
