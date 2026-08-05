<?php

use App\Models\Character;
use App\Models\User;
use App\Services\CharacterPhotoService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(fn () => Storage::fake('public'));

it('stores photos with a generated safe path and can remove them', function () {
    $photos = app(CharacterPhotoService::class);
    $path = $photos->store(UploadedFile::fake()->create('my portrait.jpg', 100, 'image/jpeg'));

    expect($path)->toStartWith('character-photos/')
        ->and($path)->not->toContain('my portrait');
    Storage::disk('public')->assertExists($path);

    $photos->delete($path);
    Storage::disk('public')->assertMissing($path);
});

it('removes the portrait after the owner deletes a character', function () {
    $owner = User::factory()->create();
    $path = 'character-photos/portrait.jpg';
    Storage::disk('public')->put($path, 'image');
    $character = Character::create(['user_id' => $owner->id, 'name' => 'Hero', 'photo_path' => $path]);

    $this->actingAs($owner)->delete(route('characters.destroy', $character))->assertRedirect();

    Storage::disk('public')->assertMissing($path);
});

it('uses the placeholder when the stored portrait is missing', function () {
    $owner = User::factory()->create();
    $character = Character::create([
        'user_id' => $owner->id,
        'name' => 'Hero',
        'photo_path' => 'character-photos/missing.jpg',
    ]);

    $this->actingAs($owner)
        ->get(route('characters.show', $character))
        ->assertOk()
        ->assertSee('Sem retrato')
        ->assertDontSee('storage/character-photos/missing.jpg');
});
