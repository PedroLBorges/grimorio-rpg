<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharacterItem extends Model
{
    protected $fillable = [
        'character_id',
        'name',
        'type',
        'quantity',
        'description',
    ];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }
    }
