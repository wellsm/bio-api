<?php

declare(strict_types=1);

namespace App\Model;

use Core\Entities\CategoryEntity;
use Core\Entities\LinkEntity;
use Core\Entities\ProfileEntity;
use DateTime;
use Hyperf\Database\Model\Relations\BelongsTo;
use Hyperf\Database\Model\Relations\MorphMany;
use Hyperf\Database\Model\SoftDeletes;
use Hyperf\Stringable\Str;

/**
 * @property int $id
 * @property int $profile_id
 * @property int $category_id
 * @property string $title
 * @property string $url
 * @property string $thumbnail
 * @property int $active
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Link extends Model implements LinkEntity
{
    use SoftDeletes;

    protected array $fillable = [
        'profile_id',
        'category_id',
        'title',
        'url',
        'thumbnail',
        'active',
        'fixed',
    ];

    protected array $hidden = [
        'profile_id',
        'category_id',
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function interactions(): MorphMany
    {
        return $this->morphMany(Interaction::class, 'interactable');
    }
    
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getProfile(): ProfileEntity
    {
        return $this->getAttribute('profile');
    }

    public function getCategory(): ?CategoryEntity
    {
        return $this->getAttribute('category');
    }

    public function getTitle(): string
    {
        return $this->attributes['title'];
    }

    public function setTitle(string $title): self
    {
        $this->attributes['title'] = $title;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->attributes['url'];
    }

    public function setUrl(string $url): self
    {
        $this->attributes['url'] = $url;

        return $this;
    }

    public function getFilename(): string
    {
        return Str::beforeLast(Str::afterLast($this->attributes['thumbnail'], '/'), '.');
    }

    public function getThumbnail(): string
    {
        return $this->attributes['thumbnail'];
    }

    public function setThumbnail(string $thumbnail): self
    {
        $this->attributes['thumbnail'] = $thumbnail;

        return $this;
    }

    public function isActive(): bool
    {
        return $this->attributes['active'];
    }

    public function setActive(bool $active): self
    {
        $this->attributes['active'] = $active;

        return $this;
    }

    public function isFixed(): bool
    {
        return $this->attributes['fixed'] ?? false;
    }

    public function setFixed(bool $fixed): self
    {
        $this->attributes['fixed'] = $fixed;

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
