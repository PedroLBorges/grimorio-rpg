<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharacterSpell extends Model
{
    protected $fillable = [
        'character_id',
        'name',
        'level',
        'school',
        'casting_time',
        'range',
        'duration',
        'components',
        'description',
    ];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}
