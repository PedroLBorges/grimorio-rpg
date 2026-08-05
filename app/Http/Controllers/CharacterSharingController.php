<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\CharacterShare;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CharacterSharingController extends Controller
{
    /**
     * Exibe a página de gerenciamento dos compartilhamentos.
     */
    public function show(
        Request $request,
        Character $character
    ): View {
        abort_unless(
            $character->canManageShares($request->user()),
            403
        );

        $character->load([
            'shares.user' => function ($query) {
                $query->orderBy('name');
            },
        ]);

        return view('characters.sharing.show', [
            'character' => $character,
        ]);
    }

    /**
     * Compartilha o personagem com um usuário cadastrado.
     */
    public function store(
        Request $request,
        Character $character
    ): RedirectResponse {
        abort_unless(
            $character->canManageShares($request->user()),
            403
        );

        $validated = $request->validate([
            'email' => [
                'required',
                'email',
                'exists:users,email',
            ],

            'permission' => [
                'required',
                'in:view,edit,transfer',
            ],
        ], [
            'email.required' => 'Informe o e-mail do usuário.',
            'email.email' => 'Informe um endereço de e-mail válido.',
            'email.exists' => 'Nenhum usuário cadastrado possui esse e-mail.',
            'permission.required' => 'Escolha uma permissão.',
            'permission.in' => 'A permissão selecionada é inválida.',
        ]);

        $sharedUser = User::where(
            'email',
            $validated['email']
        )->firstOrFail();

        if ($character->isOwner($sharedUser)) {
            return back()
                ->withInput()
                ->withErrors([
                    'email' => 'Você não pode compartilhar a ficha consigo mesmo.',
                ]);
        }

        if ($validated['permission'] === 'transfer') {
            $character->transferOwnershipTo($sharedUser);

            return redirect()
                ->route('characters.index')
                ->with('success', "A propriedade da ficha foi transferida para {$sharedUser->name}.");
        }

        $alreadyShared = $character->shares()
            ->where('user_id', $sharedUser->id)
            ->exists();

        if ($alreadyShared) {
            return back()
                ->withInput()
                ->withErrors([
                    'email' => 'Esta ficha já foi compartilhada com esse usuário.',
                ]);
        }

        $character->shares()->create([
            'user_id' => $sharedUser->id,
            'permission' => $validated['permission'],
        ]);

        return redirect()
            ->route('characters.sharing.show', $character)
            ->with(
                'success',
                "Ficha compartilhada com {$sharedUser->name}."
            );
    }

    /**
     * Altera a permissão de um compartilhamento existente.
     */
    public function update(
        Request $request,
        Character $character,
        CharacterShare $share
    ): RedirectResponse {
        abort_unless(
            $character->canManageShares($request->user()),
            403
        );

        $this->ensureShareBelongsToCharacter(
            $character,
            $share
        );

        $validated = $request->validate([
            'permission' => [
                'required',
                'in:view,edit',
            ],
        ], [
            'permission.required' => 'Escolha uma permissão.',
            'permission.in' => 'A permissão selecionada é inválida.',
        ]);

        $share->update([
            'permission' => $validated['permission'],
        ]);

        return redirect()
            ->route('characters.sharing.show', $character)
            ->with(
                'success',
                'Permissão atualizada com sucesso.'
            );
    }

    /**
     * Revoga o acesso de um usuário.
     */
    public function destroy(
        Request $request,
        Character $character,
        CharacterShare $share
    ): RedirectResponse {
        abort_unless(
            $character->canManageShares($request->user()),
            403
        );

        $this->ensureShareBelongsToCharacter(
            $character,
            $share
        );

        $sharedUserName = $share->user?->name
            ?? 'Usuário';

        $share->delete();

        return redirect()
            ->route('characters.sharing.show', $character)
            ->with(
                'success',
                "Acesso de {$sharedUserName} removido."
            );
    }

    /**
     * Impede manipular um compartilhamento pertencente
     * a outro personagem.
     */
    private function ensureShareBelongsToCharacter(
        Character $character,
        CharacterShare $share
    ): void {
        abort_unless(
            $share->character_id === $character->id,
            404
        );
    }
}
