<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CharacterShare extends Model
{
    protected $fillable = [
        'character_id',
        'user_id',
        'permission',
    ];

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function canEdit(): bool
    {
        return $this->permission === 'edit';
    }
}
