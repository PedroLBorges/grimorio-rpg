<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\CharacterFeature;
use Illuminate\Http\Request;

class CharacterFeatureController extends Controller
{
    public function index(Request $request, Character $character)
    {
        abort_unless($character->canView($request->user()), 403);

        $features = $character->features()->latest()->get();

        return view('character_features.index', compact('character', 'features'));
    }

    public function create(Request $request, Character $character)
    {
        abort_unless($character->canEdit($request->user()), 403);

        return view('character_features.create', compact('character'));
    }

    public function store(Request $request, Character $character)
    {
        abort_unless($character->canEdit($request->user()), 403);

        $validated = $request->validate([
            'type' => 'required|in:Habilidade,Característica',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $character->features()->create($validated);

        return redirect()
            ->route('characters.features.index', $character)
            ->with('success', 'Registro adicionado com sucesso!');
    }

    public function edit(Request $request, Character $character, CharacterFeature $feature)
    {
        abort_unless($character->canEdit($request->user()), 403);
        $this->authorizeFeature($character, $feature);

        return view('character_features.edit', compact('character', 'feature'));
    }

    public function update(Request $request, Character $character, CharacterFeature $feature)
    {
        abort_unless($character->canEdit($request->user()), 403);
        $this->authorizeFeature($character, $feature);

        $validated = $request->validate([
            'type' => 'required|in:Habilidade,Característica',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $feature->update($validated);

        return redirect()
            ->route('characters.features.index', $character)
            ->with('success', 'Registro atualizado com sucesso!');
    }

    public function destroy(Request $request, Character $character, CharacterFeature $feature)
    {
        abort_unless($character->canEdit($request->user()), 403);
        $this->authorizeFeature($character, $feature);

        $feature->delete();

        return redirect()
            ->route('characters.features.index', $character)
            ->with('success', 'Registro removido com sucesso!');
    }

    private function authorizeFeature(Character $character, CharacterFeature $feature): void
    {
        abort_if($feature->character_id !== $character->id, 404);
    }
}
