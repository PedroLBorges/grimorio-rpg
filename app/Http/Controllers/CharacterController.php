<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CharacterController extends Controller
{
    public function index()
    {
        $characters = Auth::user()
            ->characters()
            ->latest()
            ->get();

        return view('characters.index', compact('characters'));
    }

    public function create()
    {
        return view('characters.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'race' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'background' => 'required|string|max:255',
            'alignment' => 'required|string|max:255',
            'player_name' => 'nullable|string|max:255',
            'experience' => 'nullable|integer|min:0',
            'speed' => 'nullable|integer|min:0',
            'cp' => 'nullable|integer|min:0',
            'sp' => 'nullable|integer|min:0',
            'ep' => 'nullable|integer|min:0',
            'gp' => 'nullable|integer|min:0',
            'pp' => 'nullable|integer|min:0',
            'level' => 'required|integer|min:1',
            'backstory' => 'nullable|string',
            'strength' => 'required|integer|min:1|max:20',
            'dexterity' => 'required|integer|min:1|max:20',
            'constitution' => 'required|integer|min:1|max:20',
            'intelligence' => 'required|integer|min:1|max:20',
            'wisdom' => 'required|integer|min:1|max:20',
            'charisma' => 'required|integer|min:1|max:20',
            'acrobatics_proficient' => 'nullable|boolean',
            'animal_handling_proficient' => 'nullable|boolean',
            'arcana_proficient' => 'nullable|boolean',
            'athletics_proficient' => 'nullable|boolean',
            'performance_proficient' => 'nullable|boolean',
            'deception_proficient' => 'nullable|boolean',
            'stealth_proficient' => 'nullable|boolean',
            'history_proficient' => 'nullable|boolean',
            'intimidation_proficient' => 'nullable|boolean',
            'insight_proficient' => 'nullable|boolean',
            'investigation_proficient' => 'nullable|boolean',
            'medicine_proficient' => 'nullable|boolean',
            'nature_proficient' => 'nullable|boolean',
            'perception_proficient' => 'nullable|boolean',
            'persuasion_proficient' => 'nullable|boolean',
            'sleight_of_hand_proficient' => 'nullable|boolean',
            'religion_proficient' => 'nullable|boolean',
            'survival_proficient' => 'nullable|boolean',
            'strength_save_proficient' => 'nullable|boolean',
            'dexterity_save_proficient' => 'nullable|boolean',
            'constitution_save_proficient' => 'nullable|boolean',
            'intelligence_save_proficient' => 'nullable|boolean',
            'wisdom_save_proficient' => 'nullable|boolean',
            'charisma_save_proficient' => 'nullable|boolean',
            'armor_class' => 'required|integer|min:1|max:40',
            'has_inspiration' => 'nullable|boolean',
            'languages_and_proficiencies' => 'nullable|string',
            'personality_traits' => 'nullable|string',
            'ideals' => 'nullable|string',
            'bonds' => 'nullable|string',
            'flaws' => 'nullable|string',
            'hp_max' => 'required|integer|min:1',
            'hp_current' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo_path'] = $request
                ->file('photo')
                ->store('character-photos', 'public');
        }

        unset($validated['photo']);

        $validated['hp_current'] = min($validated['hp_current'], $validated['hp_max']);

        $skillProficiencies = [
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

        ];

        $savingThrowProficiencies = [
            'strength_save_proficient',
            'dexterity_save_proficient',
            'constitution_save_proficient',
            'intelligence_save_proficient',
            'wisdom_save_proficient',
            'charisma_save_proficient',
        ];

        foreach ($savingThrowProficiencies as $field) {
            $validated[$field] = $request->has($field);
        }

        foreach ($skillProficiencies as $field) {
            $validated[$field] = $request->has($field);
        }

        $validated['has_inspiration'] = $request->has('has_inspiration');
        $validated['experience'] = $validated['experience'] ?? 0;
        $validated['speed'] = $validated['speed'] ?? 30;
        $validated['cp'] = $validated['cp'] ?? 0;
        $validated['sp'] = $validated['sp'] ?? 0;
        $validated['ep'] = $validated['ep'] ?? 0;
        $validated['gp'] = $validated['gp'] ?? 0;
        $validated['pp'] = $validated['pp'] ?? 0;

        Auth::user()->characters()->create($validated);

        return redirect()
            ->route('characters.index')
            ->with('success', 'Personagem criado com sucesso!');
    }

    public function show(Character $character)
    {
        $this->authorizeCharacter($character);

        return view('characters.show', compact('character'));
    }

    public function edit(Character $character)
    {
        $this->authorizeCharacter($character);

        return view('characters.edit', compact('character'));
    }

    public function update(Request $request, Character $character)
    {
        $this->authorizeCharacter($character);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'race' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'background' => 'required|string|max:255',
            'alignment' => 'required|string|max:255',
            'player_name' => 'nullable|string|max:255',
            'experience' => 'nullable|integer|min:0',
            'speed' => 'nullable|integer|min:0',
            'cp' => 'nullable|integer|min:0',
            'sp' => 'nullable|integer|min:0',
            'ep' => 'nullable|integer|min:0',
            'gp' => 'nullable|integer|min:0',
            'pp' => 'nullable|integer|min:0',
            'level' => 'required|integer|min:1',
            'backstory' => 'nullable|string',
            'strength' => 'required|integer|min:1|max:20',
            'dexterity' => 'required|integer|min:1|max:20',
            'constitution' => 'required|integer|min:1|max:20',
            'intelligence' => 'required|integer|min:1|max:20',
            'wisdom' => 'required|integer|min:1|max:20',
            'charisma' => 'required|integer|min:1|max:20',
            'hp_max' => 'required|integer|min:1',
            'hp_current' => 'required|integer|min:0',
            'acrobatics_proficient' => 'nullable|boolean',
            'animal_handling_proficient' => 'nullable|boolean',
            'arcana_proficient' => 'nullable|boolean',
            'athletics_proficient' => 'nullable|boolean',
            'performance_proficient' => 'nullable|boolean',
            'deception_proficient' => 'nullable|boolean',
            'stealth_proficient' => 'nullable|boolean',
            'history_proficient' => 'nullable|boolean',
            'intimidation_proficient' => 'nullable|boolean',
            'insight_proficient' => 'nullable|boolean',
            'investigation_proficient' => 'nullable|boolean',
            'medicine_proficient' => 'nullable|boolean',
            'nature_proficient' => 'nullable|boolean',
            'perception_proficient' => 'nullable|boolean',
            'persuasion_proficient' => 'nullable|boolean',
            'sleight_of_hand_proficient' => 'nullable|boolean',
            'religion_proficient' => 'nullable|boolean',
            'survival_proficient' => 'nullable|boolean',
            'strength_save_proficient' => 'nullable|boolean',
            'dexterity_save_proficient' => 'nullable|boolean',
            'constitution_save_proficient' => 'nullable|boolean',
            'intelligence_save_proficient' => 'nullable|boolean',
            'wisdom_save_proficient' => 'nullable|boolean',
            'charisma_save_proficient' => 'nullable|boolean',
            'armor_class' => 'required|integer|min:1|max:40',
            'has_inspiration' => 'nullable|boolean',
            'languages_and_proficiencies' => 'nullable|string',
            'personality_traits' => 'nullable|string',
            'ideals' => 'nullable|string',
            'bonds' => 'nullable|string',
            'flaws' => 'nullable|string',
        ]);

        $skillProficiencies = [
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
        ];

        $savingThrowProficiencies = [
            'strength_save_proficient',
            'dexterity_save_proficient',
            'constitution_save_proficient',
            'intelligence_save_proficient',
            'wisdom_save_proficient',
            'charisma_save_proficient',
        ];

        foreach ($savingThrowProficiencies as $field) {
            $validated[$field] = $request->has($field);
        }

        foreach ($skillProficiencies as $field) {
            $validated[$field] = $request->has($field);
        }

        $validated['has_inspiration'] = $request->has('has_inspiration');

        if ($request->hasFile('photo')) {
            if ($character->photo_path) {
                Storage::disk('public')->delete($character->photo_path);
            }

            $validated['photo_path'] = $request
                ->file('photo')
                ->store('character-photos', 'public');
        }

        unset($validated['photo']);

        $character->update($validated);

        return redirect()
            ->route('characters.show', $character)
            ->with('success', 'Personagem atualizado com sucesso!');
    }

    public function destroy(Character $character)
    {
        $this->authorizeCharacter($character);

        $character->delete();

        return redirect()
            ->route('characters.index')
            ->with('success', 'Personagem excluído com sucesso!');
    }

    public function damage(Request $request, Character $character)
    {
        $this->authorizeCharacter($character);

        $validated = $request->validate([
            'amount' => 'required|integer|min:1',
        ]);

        $character->hp_current = max(0, $character->hp_current - $validated['amount']);
        $character->save();

        return redirect()
            ->route('characters.show', $character)
            ->with('success', 'Dano aplicado com sucesso!');
    }

    public function heal(Request $request, Character $character)
    {
        $this->authorizeCharacter($character);

        $validated = $request->validate([
            'amount' => 'required|integer|min:1',
        ]);

        $character->hp_current = min($character->hp_max, $character->hp_current + $validated['amount']);
        $character->save();

        return redirect()
            ->route('characters.show', $character)
            ->with('success', 'Vida restaurada com sucesso!');
    }

    private function authorizeCharacter(Character $character): void
    {
        abort_if($character->user_id !== Auth::id(), 403);
    }

    public function toggleInspiration(Character $character)
    {
        $this->authorizeCharacter($character);

        $character->has_inspiration = ! $character->has_inspiration;
        $character->save();

        return redirect()
            ->route('characters.show', $character)
            ->with('success', 'Inspiração atualizada com sucesso!');
    }

    public function updateCoins(Request $request, Character $character)
    {
        $this->authorizeCharacter($character);

        $validated = $request->validate([
            'cp' => 'required|integer|min:0',
            'sp' => 'required|integer|min:0',
            'ep' => 'required|integer|min:0',
            'gp' => 'required|integer|min:0',
            'pp' => 'required|integer|min:0',
        ]);

        $character->update($validated);

        return redirect()
            ->route('characters.show', $character)
            ->with('success', 'Moedas atualizadas com sucesso!');
    }

}
