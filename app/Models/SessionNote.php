<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SessionNote extends Model
{
    protected $fillable = ['character_id', 'user_id', 'title', 'session_date', 'content'];

    protected $casts = ['session_date' => 'date'];

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function canView(?User $user): bool
    {
        return $this->character->canView($user);
    }

    public function canEdit(?User $user): bool
    {
        return $this->character->canEdit($user);
    }
}
