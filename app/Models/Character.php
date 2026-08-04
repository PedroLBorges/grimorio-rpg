<?php

namespace App\Models;

use App\Models\CharacterItem;
use Illuminate\Database\Eloquent\Model;
use App\Models\CharacterWeapon;
use App\Models\CharacterSpell;
use App\Models\CharacterFeature;
use App\Models\CharacterLanguageProficiency;
use App\Models\CharacterAppearance;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Character extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'photo_path',
        'race',
        'class',
        'level',
        'backstory',
        'strength',
        'dexterity',
        'constitution',
        'intelligence',
        'wisdom',
        'charisma',
        'hp_max',
        'hp_current',
        'acrobatics',
        'animal_handling',
        'arcana',
        'athletics',
        'performance',
        'deception',
        'stealth',
        'history',
        'intimidation',
        'insight',
        'investigation',
        'medicine',
        'nature',
        'perception',
        'persuasion',
        'sleight_of_hand',
        'religion',
        'survival',
        'acrobatics_proficient',
        'animal_handling_proficient',
        'arcana_proficient',
        'athletics_proficient',
        'performance_proficient',
        'deception_proficient',
        'stealth_proficient',
        'history_proficient',
        'intimidation_proficient',
        'insight_proficient',
        'investigation_proficient',
        'medicine_proficient',
        'nature_proficient',
        'perception_proficient',
        'persuasion_proficient',
        'sleight_of_hand_proficient',
        'religion_proficient',
        'survival_proficient',
        'strength_save_proficient',
        'dexterity_save_proficient',
        'constitution_save_proficient',
        'intelligence_save_proficient',
        'wisdom_save_proficient',
        'charisma_save_proficient',
        'armor_class',
        'has_inspiration',
        'languages_and_proficiencies',
        'player_name',
        'background',
        'alignment',
        'experience',
        'speed',
        'cp',
        'sp',
        'ep',
        'gp',
        'pp',
        'personality_traits',
        'ideals',
        'bonds',
        'flaws',
    ];

    public function getAbilityModifier(int $score): int
    {
        return (int) floor(($score - 10) / 2);
    }

    public function getProficiencyBonus(): int
    {
        return match (true) {
            $this->level >= 17 => 6,
            $this->level >= 13 => 5,
            $this->level >= 9 => 4,
            $this->level >= 5 => 3,
            default => 2,
        };
    }

    public function getSkillValue(string $skill): int
    {
        $map = [
            'acrobatics' => 'dexterity',
            'animal_handling' => 'wisdom',
            'arcana' => 'intelligence',
            'athletics' => 'strength',
            'performance' => 'charisma',
            'deception' => 'charisma',
            'stealth' => 'dexterity',
            'history' => 'intelligence',
            'intimidation' => 'charisma',
            'insight' => 'wisdom',
            'investigation' => 'intelligence',
            'medicine' => 'wisdom',
            'nature' => 'intelligence',
            'perception' => 'wisdom',
            'persuasion' => 'charisma',
            'sleight_of_hand' => 'dexterity',
            'religion' => 'intelligence',
            'survival' => 'wisdom',
        ];

        $ability = $map[$skill] ?? null;

        if (!$ability) {
            return 0;
        }

        $modifier = $this->getAbilityModifier($this->{$ability});
        $proficientField = $skill . '_proficient';

        if ($this->{$proficientField}) {
            $modifier += $this->getProficiencyBonus();
        }

        return $modifier;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CharacterItem::class);
    }

    protected $casts = [
        'acrobatics_proficient' => 'boolean',
        'animal_handling_proficient' => 'boolean',
        'arcana_proficient' => 'boolean',
        'athletics_proficient' => 'boolean',
        'performance_proficient' => 'boolean',
        'deception_proficient' => 'boolean',
        'stealth_proficient' => 'boolean',
        'history_proficient' => 'boolean',
        'intimidation_proficient' => 'boolean',
        'insight_proficient' => 'boolean',
        'investigation_proficient' => 'boolean',
        'medicine_proficient' => 'boolean',
        'nature_proficient' => 'boolean',
        'perception_proficient' => 'boolean',
        'persuasion_proficient' => 'boolean',
        'sleight_of_hand_proficient' => 'boolean',
        'religion_proficient' => 'boolean',
        'survival_proficient' => 'boolean',
        'strength_save_proficient' => 'boolean',
        'dexterity_save_proficient' => 'boolean',
        'constitution_save_proficient' => 'boolean',
        'intelligence_save_proficient' => 'boolean',
        'wisdom_save_proficient' => 'boolean',
        'charisma_save_proficient' => 'boolean',
        'has_inspiration' => 'boolean',
    ];

    public function getSavingThrowValue(string $ability): int
    {
        $modifier = $this->getAbilityModifier($this->{$ability});
        $proficientField = $ability . '_save_proficient';

        if ($this->{$proficientField}) {
            $modifier += $this->getProficiencyBonus();
        }

        return $modifier;
    }

    public function getPassiveWisdom(): int
    {
        return 10 + $this->getSkillValue('perception');
    }

    public function getInitiative(): int
    {
        return $this->getAbilityModifier($this->dexterity);
    }

    public function getSpeedInMeters(): string
    {
        $feet = match ($this->race) {
            'Anão' => 25,
            'Halfling' => 25,
            'Gnomo' => 25,
            'Humano' => 30,
            'Elfo' => 30,
            'Draconato' => 30,
            'Meio-Elfo' => 30,
            'Meio-Orc' => 30,
            'Tiefling' => 30,
            default => 30,
        };

        $meters = $feet * 0.3;

        return number_format($meters, 1, ',', '.') . ' m';
    }

    public function weapons()
    {
        return $this->hasMany(CharacterWeapon::class);
    }

    public function spells()
    {
        return $this->hasMany(CharacterSpell::class);
    }

    public function features()
    {
        return $this->hasMany(CharacterFeature::class);
    }

    public function languageProficiencies()
    {
        return $this->hasMany(CharacterLanguageProficiency::class);
    }

    public function appearance()
    {
        return $this->hasOne(CharacterAppearance::class);
    }

    public function shares(): HasMany
    {
        return $this->hasMany(CharacterShare::class);
    }

    public function sharedUsers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'character_shares'
        )
            ->withPivot('permission')
            ->withTimestamps();
    }

    public function isOwner(?User $user): bool
    {
        return $user !== null && $this->user_id === $user->id;
    }

    public function shareFor(?User $user): ?CharacterShare
    {
        if ($user === null) {
            return null;
        }

        return $this->shares()
            ->where('user_id', $user->id)
            ->first();
    }

    public function isSharedWith(?User $user): bool
    {
        return $this->shareFor($user) !== null;
    }

    public function canView(?User $user): bool
    {
        if ($this->isOwner($user)) {
            return true;
        }

        return $this->isSharedWith($user);
    }

    public function canEdit(?User $user): bool
    {
        if ($this->isOwner($user)) {
            return true;
        }

        return $this->shareFor($user)?->permission === 'edit';
    }

    public function canManageShares(?User $user): bool
    {
        return $this->isOwner($user);
    }

}
