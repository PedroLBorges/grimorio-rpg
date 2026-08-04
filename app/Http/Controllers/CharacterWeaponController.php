<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\CharacterWeapon;
use Illuminate\Http\Request;

class CharacterWeaponController extends Controller
{
    public function index(Request $request, Character $character)
    {
        abort_unless($character->canView($request->user()), 403);

        $weapons = $character->weapons()->latest()->get();

        return view('character_weapons.index', compact('character', 'weapons'));
    }

    public function create(Request $request, Character $character)
    {
        abort_unless($character->canEdit($request->user()), 403);

        return view('character_weapons.create', compact('character'));
    }

    public function store(Request $request, Character $character)
    {
        abort_unless($character->canEdit($request->user()), 403);

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

    public function edit(Request $request, Character $character, CharacterWeapon $weapon)
    {
        abort_unless($character->canEdit($request->user()), 403);
        $this->authorizeWeapon($character, $weapon);

        return view('character_weapons.edit', compact('character', 'weapon'));
    }

    public function update(Request $request, Character $character, CharacterWeapon $weapon)
    {
        abort_unless($character->canEdit($request->user()), 403);
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

    public function destroy(Request $request, Character $character, CharacterWeapon $weapon)
    {
        abort_unless($character->canEdit($request->user()), 403);
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

    private function authorizeWeapon(Character $character, CharacterWeapon $weapon): void
    {
        abort_if($weapon->character_id !== $character->id, 404);
    }
}
