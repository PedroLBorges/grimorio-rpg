<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\CharacterItem;
use Illuminate\Http\Request;

class CharacterItemController extends Controller
{
    public function index(Request $request, Character $character)
    {
        abort_unless(
            $character->canView($request->user()),
            403
        );

        $items = $character->items()
            ->latest()
            ->get();

        return view('character_items.index', compact('character', 'items'));
    }

    public function create(Request $request, Character $character)
    {
        abort_unless(
            $character->canEdit($request->user()),
            403
        );

        return view('character_items.create', compact('character'));
    }

    public function store(Request $request, Character $character)
    {
        abort_unless(
            $character->canEdit($request->user()),
            403
        );

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

    public function edit(
        Request $request,
        Character $character,
        CharacterItem $item
    ) {
        abort_unless(
            $character->canEdit($request->user()),
            403
        );

        abort_unless(
            $item->character_id === $character->id,
            404
        );

        return view('character_items.edit', compact('character', 'item'));
    }

    public function update(Request $request, Character $character, CharacterItem $item)
    {
        abort_unless(
            $character->canEdit($request->user()),
            403
        );

        abort_unless(
            $item->character_id === $character->id,
            404
        );

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

    public function destroy(Request $request, Character $character, CharacterItem $item)
    {
        abort_unless(
            $character->canEdit($request->user()),
            403
        );

        abort_unless(
            $item->character_id === $character->id,
            404
        );

        $item->delete();

        return redirect()
            ->route('characters.items.index', $character)
            ->with('success', 'Item removido com sucesso!');
    }

}
