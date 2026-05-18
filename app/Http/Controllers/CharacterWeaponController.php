<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\CharacterWeapon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharacterWeaponController extends Controller
{
    public function index(Character $character)
    {
        $this->authorizeCharacter($character);

        $weapons = $character->weapons()->latest()->get();

        return view('character_weapons.index', compact('character', 'weapons'));
    }

    public function create(Character $character)
    {
        $this->authorizeCharacter($character);

        return view('character_weapons.create', compact('character'));
    }

    public function store(Request $request, Character $character)
    {
        $this->authorizeCharacter($character);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'ability' => 'required|in:strength,dexterity',
            'proficient' => 'nullable|boolean',
            'damage_dice' => 'nullable|string|max:50',
            'damage_type' => 'nullable|string|max:100',
            'range' => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);

        $validated['proficient'] = $request->has('proficient');
        $validated['attack_bonus'] = $this->calculateAttackBonus($character, $validated['ability'], $validated['proficient']);

        $character->weapons()->create($validated);

        return redirect()
            ->route('characters.weapons.index', $character)
            ->with('success', 'Arma adicionada com sucesso!');
    }

    public function edit(Character $character, CharacterWeapon $weapon)
    {
        $this->authorizeCharacter($character);
        $this->authorizeWeapon($character, $weapon);

        return view('character_weapons.edit', compact('character', 'weapon'));
    }

    public function update(Request $request, Character $character, CharacterWeapon $weapon)
    {
        $this->authorizeCharacter($character);
        $this->authorizeWeapon($character, $weapon);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'ability' => 'required|in:strength,dexterity',
            'proficient' => 'nullable|boolean',
            'damage_dice' => 'nullable|string|max:50',
            'damage_type' => 'nullable|string|max:100',
            'range' => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);

        $validated['proficient'] = $request->has('proficient');
        $validated['attack_bonus'] = $this->calculateAttackBonus($character, $validated['ability'], $validated['proficient']);

        $weapon->update($validated);

        return redirect()
            ->route('characters.weapons.index', $character)
            ->with('success', 'Arma atualizada com sucesso!');
    }

    public function destroy(Character $character, CharacterWeapon $weapon)
    {
        $this->authorizeCharacter($character);
        $this->authorizeWeapon($character, $weapon);

        $weapon->delete();

        return redirect()
            ->route('characters.weapons.index', $character)
            ->with('success', 'Arma removida com sucesso!');
    }

    private function calculateAttackBonus(Character $character, string $ability, bool $proficient): int
    {
        $bonus = $character->getAbilityModifier($character->{$ability});

        if ($proficient) {
            $bonus += $character->getProficiencyBonus();
        }

        return $bonus;
    }

    private function authorizeCharacter(Character $character): void
    {
        abort_if($character->user_id !== Auth::id(), 403);
    }

    private function authorizeWeapon(Character $character, CharacterWeapon $weapon): void
    {
        abort_if($weapon->character_id !== $character->id, 404);
    }
}
