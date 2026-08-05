<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\SessionNote;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SessionNoteController extends Controller
{
    public function index(Request $request): View
    {
        $characters = $this->accessibleCharacters($request, false)->get();
        $notes = SessionNote::query()->with(['character', 'author'])
            ->whereHas('character', fn (Builder $query) => $this->applyAccess($query, $request, false))
            ->orderByDesc('session_date')->latest()->get();

        return view('session_notes.index', compact('characters', 'notes'));
    }

    public function create(Request $request): View
    {
        $characters = $this->accessibleCharacters($request, true)->get();
        abort_if($characters->isEmpty(), 403);
        return view('session_notes.create', compact('characters'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateNote($request, true);
        $character = Character::findOrFail($validated['character_id']);
        abort_unless($character->canEdit($request->user()), 403);
        $character->sessionNotes()->create([...$validated, 'user_id' => $request->user()->id]);
        return to_route('session-notes.index')->with('success', 'Anotação registrada com sucesso.');
    }

    public function edit(Request $request, SessionNote $sessionNote): View
    {
        $sessionNote->load('character');
        abort_unless($sessionNote->canEdit($request->user()), 403);
        return view('session_notes.edit', compact('sessionNote'));
    }

    public function update(Request $request, SessionNote $sessionNote): RedirectResponse
    {
        $sessionNote->load('character');
        abort_unless($sessionNote->canEdit($request->user()), 403);
        $sessionNote->update($this->validateNote($request, false));
        return to_route('session-notes.index')->with('success', 'Anotação atualizada com sucesso.');
    }

    public function destroy(Request $request, SessionNote $sessionNote): RedirectResponse
    {
        $sessionNote->load('character');
        abort_unless($sessionNote->canEdit($request->user()), 403);
        $sessionNote->delete();
        return to_route('session-notes.index')->with('success', 'Anotação removida.');
    }

    private function validateNote(Request $request, bool $withCharacter): array
    {
        return $request->validate([
            ...($withCharacter ? ['character_id' => ['required', 'integer', 'exists:characters,id']] : []),
            'title' => ['required', 'string', 'max:255'],
            'session_date' => ['nullable', 'date'],
            'content' => ['required', 'string', 'max:50000'],
        ]);
    }

    private function accessibleCharacters(Request $request, bool $edit): Builder
    {
        return $this->applyAccess(Character::query(), $request, $edit)->orderBy('name');
    }

    private function applyAccess(Builder $query, Request $request, bool $edit): Builder
    {
        $userId = $request->user()->id;
        return $query->where(fn (Builder $access) => $access
            ->where('user_id', $userId)
            ->orWhereHas('shares', fn (Builder $shares) => $shares
                ->where('user_id', $userId)
                ->when($edit, fn (Builder $share) => $share->where('permission', 'edit'))));
    }
}
