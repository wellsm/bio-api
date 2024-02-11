<?php

declare(strict_types=1);

namespace App\Model;

use Core\Entities\CategoryEntity;
use Core\Entities\ProfileEntity;
use DateTime;
use Hyperf\Database\Model\Relations\BelongsTo;

/**
 * @property int $id 
 * @property int $profile_id 
 * @property string $name 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 */
class Category extends Model implements CategoryEntity
{
    protected array $fillable = [
        'name'
    ];

    protected array $casts = [
        'id'         => 'integer',
        'profile_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getProfile(): ProfileEntity
    {
        return $this->getAttribute('profile');
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

    public function getCreatedAt(): DateTime
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->attributes['updated_at'];
    }
}
