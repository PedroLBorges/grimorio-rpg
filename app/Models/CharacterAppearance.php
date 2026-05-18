<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharacterAppearance extends Model
{
    protected $fillable = [
        'character_id',
        'height',
        'weight',
        'eyes',
        'hair',
        'skin',
        'description',
    ];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}
