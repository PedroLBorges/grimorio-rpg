<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\CharacterSpell;
use Illuminate\Http\Request;

class CharacterSpellController extends Controller
{
    public function index(Request $request, Character $character)
    {
        abort_unless($character->canView($request->user()), 403);

        $spells = $character->spells()->latest()->get();

        return view('character_spells.index', compact('character', 'spells'));
    }

    public function create(Request $request, Character $character)
    {
        abort_unless($character->canEdit($request->user()), 403);

        return view('character_spells.create', compact('character'));
    }

    public function store(Request $request, Character $character)
    {
        abort_unless($character->canEdit($request->user()), 403);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'nullable|string|max:50',
            'school' => 'nullable|string|max:100',
            'casting_time' => 'nullable|string|max:100',
            'range' => 'nullable|string|max:100',
            'duration' => 'nullable|string|max:100',
            'components' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        $character->spells()->create($validated);

        return redirect()
            ->route('characters.spells.index', $character)
            ->with('success', 'Magia adicionada com sucesso!');
    }

    public function edit(Request $request, Character $character, CharacterSpell $spell)
    {
        abort_unless($character->canEdit($request->user()), 403);
        $this->authorizeSpell($character, $spell);

        return view('character_spells.edit', compact('character', 'spell'));
    }

    public function update(Request $request, Character $character, CharacterSpell $spell)
    {
        abort_unless($character->canEdit($request->user()), 403);
        $this->authorizeSpell($character, $spell);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'nullable|string|max:50',
            'school' => 'nullable|string|max:100',
            'casting_time' => 'nullable|string|max:100',
            'range' => 'nullable|string|max:100',
            'duration' => 'nullable|string|max:100',
            'components' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        $spell->update($validated);

        return redirect()
            ->route('characters.spells.index', $character)
            ->with('success', 'Magia atualizada com sucesso!');
    }

    public function destroy(Request $request, Character $character, CharacterSpell $spell)
    {
        abort_unless($character->canEdit($request->user()), 403);
        $this->authorizeSpell($character, $spell);

        $spell->delete();

        return redirect()
            ->route('characters.spells.index', $character)
            ->with('success', 'Magia removida com sucesso!');
    }

    private function authorizeSpell(Character $character, CharacterSpell $spell): void
    {
        abort_if($spell->character_id !== $character->id, 404);
    }
}
