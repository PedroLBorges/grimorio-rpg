<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Character;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function characters(){
    return $this->hasMany(Character::class);
    }

    public function characterShares(): HasMany
    {
        return $this->hasMany(CharacterShare::class);
    }

    public function sharedCharacters(): BelongsToMany
    {
        return $this->belongsToMany(
            Character::class,
            'character_shares'
        )
            ->withPivot('permission')
            ->withTimestamps();
    }

    public function sessionNotes(): HasMany
    {
        return $this->hasMany(SessionNote::class);
    }
}
