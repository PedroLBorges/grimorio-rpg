<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharacterAppearanceController extends Controller
{
    public function show(Character $character)
    {
        $this->authorizeCharacter($character);

        $appearance = $character->appearance;

        return view('character_appearance.show', compact('character', 'appearance'));
    }

    public function edit(Character $character)
    {
        $this->authorizeCharacter($character);

        $appearance = $character->appearance;

        return view('character_appearance.edit', compact('character', 'appearance'));
    }

    public function update(Request $request, Character $character)
    {
        $this->authorizeCharacter($character);

        $validated = $request->validate([
            'height' => 'nullable|string|max:50',
            'weight' => 'nullable|string|max:50',
            'eyes' => 'nullable|string|max:100',
            'hair' => 'nullable|string|max:100',
            'skin' => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);

        $character->appearance()->updateOrCreate(
            ['character_id' => $character->id],
            $validated
        );

        return redirect()
            ->route('characters.appearance.show', $character)
            ->with('success', 'Descrição física atualizada!');
    }

    private function authorizeCharacter(Character $character): void
    {
        abort_if($character->user_id !== Auth::id(), 403);
    }
}
