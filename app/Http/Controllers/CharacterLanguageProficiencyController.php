<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\CharacterLanguageProficiency;
use Illuminate\Http\Request;

class CharacterLanguageProficiencyController extends Controller
{
    public function index(Request $request, Character $character)
    {
        abort_unless($character->canView($request->user()), 403);

        $records = $character->languageProficiencies()->latest()->get();

        return view('character_language_proficiencies.index', compact('character', 'records'));
    }

    public function create(Request $request, Character $character)
    {
        abort_unless($character->canEdit($request->user()), 403);

        return view('character_language_proficiencies.create', compact('character'));
    }

    public function store(Request $request, Character $character)
    {
        abort_unless($character->canEdit($request->user()), 403);

        $validated = $request->validate([
            'type' => 'required|in:Idioma,Proficiência',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $character->languageProficiencies()->create($validated);

        return redirect()
            ->route('characters.language-proficiencies.index', $character)
            ->with('success', 'Registro adicionado com sucesso!');
    }

    public function edit(Request $request, Character $character, CharacterLanguageProficiency $languageProficiency)
    {
        abort_unless($character->canEdit($request->user()), 403);
        $this->authorizeRecord($character, $languageProficiency);

        return view('character_language_proficiencies.edit', compact('character', 'languageProficiency'));
    }

    public function update(Request $request, Character $character, CharacterLanguageProficiency $languageProficiency)
    {
        abort_unless($character->canEdit($request->user()), 403);
        $this->authorizeRecord($character, $languageProficiency);

        $validated = $request->validate([
            'type' => 'required|in:Idioma,Proficiência',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $languageProficiency->update($validated);

        return redirect()
            ->route('characters.language-proficiencies.index', $character)
            ->with('success', 'Registro atualizado com sucesso!');
    }

    public function destroy(Request $request, Character $character, CharacterLanguageProficiency $languageProficiency)
    {
        abort_unless($character->canEdit($request->user()), 403);
        $this->authorizeRecord($character, $languageProficiency);

        $languageProficiency->delete();

        return redirect()
            ->route('characters.language-proficiencies.index', $character)
            ->with('success', 'Registro removido com sucesso!');
    }

    private function authorizeRecord(Character $character, CharacterLanguageProficiency $record): void
    {
        abort_if($record->character_id !== $character->id, 404);
    }
}
