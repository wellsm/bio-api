<?php

declare(strict_types=1);

namespace App\Model;

use Core\Entities\ProfileEntity;
use Core\Entities\SocialMediaEntity;
use DateTime;
use Hyperf\Database\Model\Relations\BelongsTo;

/**
 * @property int $id 
 * @property int $profile_id 
 * @property string $icon 
 * @property string $name 
 * @property string $url 
 * @property string $text_color 
 * @property string $background 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 */
class SocialMedia extends Model implements SocialMediaEntity
{
    protected ?string $table = 'social_medias';

    protected array $fillable = [
        'profile_id',
        'icon',
        'name',
        'url',
        'text_color',
        'background',
        'order',
        'active',
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

    public function setProfile(ProfileEntity $profile): self
    {
        $this->attributes['profile_id'] = $profile->getId();

        return $this;
    }

    public function getIcon(): string
    {
        return $this->attributes['icon'];
    }

    public function setIcon(string $icon): self
    {
        $this->attributes['icon'] = $icon;

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

    public function getUrl(): string
    {
        return $this->attributes['url'];
    }

    public function setUrl(string $url): self
    {
        $this->attributes['url'] = $url;

        return $this;
    }

    public function getTextColor(): string
    {
        return $this->attributes['text_color'];
    }

    public function setTextColor(string $textColor): self
    {
        $this->attributes['text_color'] = $textColor;

        return $this;
    }

    public function getBackground(): string
    {
        return $this->attributes['background'];
    }

    public function setBackground(string $background): self
    {
        $this->attributes['background'] = $background;

        return $this;
    }

    public function getOrder(): int
    {
        return $this->attributes['order'];
    }

    public function setOrder(int $order): self
    {
        $this->attributes['order'] = $order;

        return $this;
    }

    public function isActive(): bool
    {
        return (bool) $this->attributes['active'];
    }

    public function setActive(bool $active): self
    {
        $this->attributes['active'] = $active;

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
