<?php

use App\Models\Character;
use App\Models\SessionNote;
use App\Models\User;

beforeEach(function () {
    $this->owner = User::factory()->create();
    $this->editor = User::factory()->create();
    $this->viewer = User::factory()->create();
    $this->stranger = User::factory()->create();
    $this->character = Character::create(['user_id' => $this->owner->id, 'name' => 'Hero']);
    $this->character->shares()->create(['user_id' => $this->editor->id, 'permission' => 'edit']);
    $this->character->shares()->create(['user_id' => $this->viewer->id, 'permission' => 'view']);
    $this->note = SessionNote::create([
        'character_id' => $this->character->id,
        'user_id' => $this->owner->id,
        'title' => 'A primeira sessão',
        'content' => 'O grupo chegou à cidade.',
    ]);
});

it('lets every user with character access view its notes', function () {
    foreach ([$this->owner, $this->editor, $this->viewer] as $user) {
        $this->actingAs($user)->get(route('session-notes.index'))
            ->assertOk()->assertSee('A primeira sessão');
    }
    $this->actingAs($this->stranger)->get(route('session-notes.index'))
        ->assertOk()->assertDontSee('A primeira sessão');
});

it('allows owners and editors to create and manipulate notes', function () {
    foreach ([$this->owner, $this->editor] as $user) {
        $this->actingAs($user)->post(route('session-notes.store'), [
            'character_id' => $this->character->id,
            'title' => 'Nova memória '.$user->id,
            'content' => 'Conteúdo da sessão.',
        ])->assertRedirect(route('session-notes.index'));
    }
    $this->actingAs($this->editor)->put(route('session-notes.update', $this->note), [
        'title' => 'Memória revisada', 'content' => 'Texto revisado.',
    ])->assertRedirect(route('session-notes.index'));
});

it('blocks viewers and strangers from changing notes', function () {
    foreach ([$this->viewer, $this->stranger] as $user) {
        $this->actingAs($user)->post(route('session-notes.store'), [
            'character_id' => $this->character->id,
            'title' => 'Bloqueada', 'content' => 'Sem permissão.',
        ])->assertForbidden();
        $this->actingAs($user)->delete(route('session-notes.destroy', $this->note))->assertForbidden();
    }
});

it('hides notes immediately after character access is revoked and restores them when reshared', function () {
    $this->character->shares()->where('user_id', $this->viewer->id)->delete();
    $this->actingAs($this->viewer)->get(route('session-notes.index'))->assertDontSee('A primeira sessão');
    $this->character->shares()->create(['user_id' => $this->viewer->id, 'permission' => 'view']);
    $this->actingAs($this->viewer)->get(route('session-notes.index'))->assertSee('A primeira sessão');
});
