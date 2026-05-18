<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\CharacterItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharacterItemController extends Controller
{
    public function index(Character $character)
    {
        $this->authorizeCharacter($character);

        $items = $character->items()->latest()->get();

        return view('character_items.index', compact('character', 'items'));
    }

    public function create(Character $character)
    {
        $this->authorizeCharacter($character);

        return view('character_items.create', compact('character'));
    }

    public function store(Request $request, Character $character)
    {
        $this->authorizeCharacter($character);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $character->items()->create($validated);

        return redirect()
            ->route('characters.items.index', $character)
            ->with('success', 'Item adicionado com sucesso!');
    }

    public function edit(Character $character, CharacterItem $item)
    {
        $this->authorizeCharacter($character);
        $this->authorizeItem($character, $item);

        return view('character_items.edit', compact('character', 'item'));
    }

    public function update(Request $request, Character $character, CharacterItem $item)
    {
        $this->authorizeCharacter($character);
        $this->authorizeItem($character, $item);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $item->update($validated);

        return redirect()
            ->route('characters.items.index', $character)
            ->with('success', 'Item atualizado com sucesso!');
    }

    public function destroy(Character $character, CharacterItem $item)
    {
        $this->authorizeCharacter($character);
        $this->authorizeItem($character, $item);

        $item->delete();

        return redirect()
            ->route('characters.items.index', $character)
            ->with('success', 'Item removido com sucesso!');
    }

    private function authorizeCharacter(Character $character): void
    {
        abort_if($character->user_id !== Auth::id(), 403);
    }

    private function authorizeItem(Character $character, CharacterItem $item): void
    {
        abort_if($item->character_id !== $character->id, 404);
    }
}
