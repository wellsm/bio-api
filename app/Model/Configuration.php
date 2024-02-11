<?php

declare(strict_types=1);

namespace App\Model;

use Core\Entities\ConfigurationEntity;
use Core\Entities\ProfileEntity;
use Hyperf\Database\Model\Relations\BelongsTo;
use DateTime;

/**
 * @property int $id 
 * @property int $profile_id 
 * @property string $key 
 * @property string $value 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 */
class Configuration extends Model implements ConfigurationEntity
{
    protected array $fillable = [
        'key',
        'value',
    ];

    protected array $casts = [
        'id'         => 'integer',
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

    public function getKey(): string
    {
        return $this->attributes['key'];
    }

    public function setKey(string $key): self
    {
        $this->attributes['key'] = $key;

        return $this;
    }

    public function getValue(): string
    {
        return $this->attributes['value'];
    }

    public function setValue(string $value): self
    {
        $this->attributes['value'] = $value;

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
