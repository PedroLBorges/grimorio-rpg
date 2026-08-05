<?php

use App\Models\Character;
use App\Models\User;

beforeEach(function () {
    $this->owner = User::factory()->create();
    $this->editor = User::factory()->create();
    $this->viewer = User::factory()->create();
    $this->stranger = User::factory()->create();

    $this->character = Character::create([
        'user_id' => $this->owner->id,
        'name' => 'Aventureiro de Teste',
        'race' => 'Humano',
        'class' => 'Guerreiro',
        'level' => 1,
    ]);

    $this->character->shares()->create([
        'user_id' => $this->editor->id,
        'permission' => 'edit',
    ]);

    $this->character->shares()->create([
        'user_id' => $this->viewer->id,
        'permission' => 'view',
    ]);
});

function characterModuleRoutes(Character $character, string $action): array
{
    return collect([
        'items',
        'weapons',
        'spells',
        'features',
        'language-proficiencies',
    ])->map(
        fn (string $module) => route("characters.{$module}.{$action}", $character)
    )->all();
}

it('allows the owner and editor to view and edit character modules', function () {
    foreach ([$this->owner, $this->editor] as $user) {
        foreach (characterModuleRoutes($this->character, 'index') as $url) {
            $this->actingAs($user)->get($url)->assertOk();
        }

        foreach (characterModuleRoutes($this->character, 'create') as $url) {
            $this->actingAs($user)->get($url)->assertOk();
        }
    }
});

it('allows the viewer to consult modules but blocks editing actions', function () {
    foreach (characterModuleRoutes($this->character, 'index') as $url) {
        $this->actingAs($this->viewer)->get($url)->assertOk();
    }

    foreach (characterModuleRoutes($this->character, 'create') as $url) {
        $this->actingAs($this->viewer)->get($url)->assertForbidden();
    }

    $this->actingAs($this->viewer)
        ->get(route('characters.appearance.show', $this->character))
        ->assertOk()
        ->assertDontSee(route('characters.appearance.edit', $this->character));
});

it('blocks users without a share from all character modules', function () {
    foreach (characterModuleRoutes($this->character, 'index') as $url) {
        $this->actingAs($this->stranger)->get($url)->assertForbidden();
    }

    foreach (characterModuleRoutes($this->character, 'create') as $url) {
        $this->actingAs($this->stranger)->get($url)->assertForbidden();
    }
});

it('keeps character deletion and share management exclusive to the owner', function () {
    expect($this->character->isOwner($this->owner))->toBeTrue()
        ->and($this->character->canManageShares($this->owner))->toBeTrue()
        ->and($this->character->canManageShares($this->editor))->toBeFalse()
        ->and($this->character->canManageShares($this->viewer))->toBeFalse();

    $this->actingAs($this->editor)
        ->delete(route('characters.destroy', $this->character))
        ->assertForbidden();

    $this->actingAs($this->viewer)
        ->get(route('characters.sharing.show', $this->character))
        ->assertForbidden();
});

it('transfers ownership while preserving other shares and removing the old owner access', function () {
    $otherViewer = User::factory()->create();
    $this->character->shares()->create([
        'user_id' => $otherViewer->id,
        'permission' => 'view',
    ]);

    $this->actingAs($this->owner)->post(
        route('characters.sharing.store', $this->character),
        ['email' => $this->editor->email, 'permission' => 'transfer']
    )->assertRedirect(route('characters.index'));

    $this->character->refresh();
    expect($this->character->isOwner($this->editor))->toBeTrue()
        ->and($this->character->canView($this->owner))->toBeFalse()
        ->and($this->character->canView($otherViewer))->toBeTrue();
});

it('blocks non owners from transferring ownership', function () {
    $recipient = User::factory()->create();
    $this->actingAs($this->editor)->post(
        route('characters.sharing.store', $this->character),
        ['email' => $recipient->email, 'permission' => 'transfer']
    )->assertForbidden();

    expect($this->character->fresh()->isOwner($this->owner))->toBeTrue();
});
