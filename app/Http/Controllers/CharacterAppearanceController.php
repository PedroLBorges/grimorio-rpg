<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CharacterAppearanceController extends Controller
{
    /**
     * Exibe a aparência para proprietário, editor ou visualizador.
     */
    public function show(
        Request $request,
        Character $character
    ): View {
        abort_unless(
            $character->canView($request->user()),
            403
        );

        $appearance = $character->appearance;

        return view(
            'character_appearance.show',
            compact('character', 'appearance')
        );
    }

    /**
     * Exibe o formulário de edição apenas para quem pode editar.
     */
    public function edit(
        Request $request,
        Character $character
    ): View {
        abort_unless(
            $character->canEdit($request->user()),
            403
        );

        $appearance = $character->appearance;

        return view(
            'character_appearance.edit',
            compact('character', 'appearance')
        );
    }

    /**
     * Atualiza a aparência apenas para proprietário ou editor.
     */
    public function update(
        Request $request,
        Character $character
    ): RedirectResponse {
        abort_unless(
            $character->canEdit($request->user()),
            403
        );

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
}
