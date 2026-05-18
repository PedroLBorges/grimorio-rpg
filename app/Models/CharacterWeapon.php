<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharacterWeapon extends Model
{
    protected $fillable = [
        'character_id',
        'name',
        'ability',
        'proficient',
        'attack_bonus',
        'damage_dice',
        'damage_type',
        'range',
        'description',
    ];

    protected $casts = [
        'proficient' => 'boolean',
    ];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}
