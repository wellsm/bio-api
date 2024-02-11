<?php

declare(strict_types=1);

namespace App\Model;

/**
 * @property string $id 
 * @property string $type 
 * @property int $interactable_id 
 * @property string $interactable_type 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 */
class Interaction extends Model
{
    protected array $fillable = [
        'id',
        'interactable_id',
        'interactable_type',
    ];

    protected array $casts = [
        'interactable_id' => 'integer',
        'created_at'      => 'datetime',
        'updated_at'      => 'datetime'
    ];
}
