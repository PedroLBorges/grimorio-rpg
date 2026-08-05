<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\CharacterItemController;
use App\Http\Controllers\CharacterWeaponController;
use App\Http\Controllers\CharacterSpellController;
use App\Http\Controllers\CharacterFeatureController;
use App\Http\Controllers\CharacterLanguageProficiencyController;
use App\Http\Controllers\CharacterAppearanceController;
use App\Http\Controllers\CharacterSharingController;
use App\Http\Controllers\SessionNoteController;

Route::middleware(['auth'])->group(function () {
    Route::resource('characters', CharacterController::class);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('session-notes', SessionNoteController::class)
        ->parameters(['session-notes' => 'sessionNote'])
        ->except('show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/characters/{character}/items', [CharacterItemController::class, 'index'])->name('characters.items.index');
    Route::get('/characters/{character}/items/create', [CharacterItemController::class, 'create'])->name('characters.items.create');
    Route::post('/characters/{character}/items', [CharacterItemController::class, 'store'])->name('characters.items.store');
    Route::get('/characters/{character}/items/{item}/edit', [CharacterItemController::class, 'edit'])->name('characters.items.edit');
    Route::put('/characters/{character}/items/{item}', [CharacterItemController::class, 'update'])->name('characters.items.update');
    Route::delete('/characters/{character}/items/{item}', [CharacterItemController::class, 'destroy'])->name('characters.items.destroy');
    Route::patch('/characters/{character}/damage', [CharacterController::class, 'damage'])->name('characters.damage');
    Route::patch('/characters/{character}/heal', [CharacterController::class, 'heal'])->name('characters.heal');
    Route::patch('/characters/{character}/toggle-inspiration', [CharacterController::class, 'toggleInspiration'])
        ->name('characters.toggleInspiration');
    Route::get('/characters/{character}/weapons', [CharacterWeaponController::class, 'index'])->name('characters.weapons.index');
    Route::get('/characters/{character}/weapons/create', [CharacterWeaponController::class, 'create'])->name('characters.weapons.create');
    Route::post('/characters/{character}/weapons', [CharacterWeaponController::class, 'store'])->name('characters.weapons.store');
    Route::get('/characters/{character}/weapons/{weapon}/edit', [CharacterWeaponController::class, 'edit'])->name('characters.weapons.edit');
    Route::put('/characters/{character}/weapons/{weapon}', [CharacterWeaponController::class, 'update'])->name('characters.weapons.update');
    Route::delete('/characters/{character}/weapons/{weapon}', [CharacterWeaponController::class, 'destroy'])->name('characters.weapons.destroy');
    Route::get('/characters/{character}/spells', [CharacterSpellController::class, 'index'])->name('characters.spells.index');
    Route::get('/characters/{character}/spells/create', [CharacterSpellController::class, 'create'])->name('characters.spells.create');
    Route::post('/characters/{character}/spells', [CharacterSpellController::class, 'store'])->name('characters.spells.store');
    Route::get('/characters/{character}/spells/{spell}/edit', [CharacterSpellController::class, 'edit'])->name('characters.spells.edit');
    Route::put('/characters/{character}/spells/{spell}', [CharacterSpellController::class, 'update'])->name('characters.spells.update');
    Route::delete('/characters/{character}/spells/{spell}', [CharacterSpellController::class, 'destroy'])->name('characters.spells.destroy');
    Route::get('/characters/{character}/features', [CharacterFeatureController::class, 'index'])->name('characters.features.index');
    Route::get('/characters/{character}/features/create', [CharacterFeatureController::class, 'create'])->name('characters.features.create');
    Route::post('/characters/{character}/features', [CharacterFeatureController::class, 'store'])->name('characters.features.store');
    Route::get('/characters/{character}/features/{feature}/edit', [CharacterFeatureController::class, 'edit'])->name('characters.features.edit');
    Route::put('/characters/{character}/features/{feature}', [CharacterFeatureController::class, 'update'])->name('characters.features.update');
    Route::delete('/characters/{character}/features/{feature}', [CharacterFeatureController::class, 'destroy'])->name('characters.features.destroy');
    Route::patch('/characters/{character}/coins', [CharacterController::class, 'updateCoins'])
        ->name('characters.updateCoins');
    Route::get('/characters/{character}/language-proficiencies', [CharacterLanguageProficiencyController::class, 'index'])->name('characters.language-proficiencies.index');
    Route::get('/characters/{character}/language-proficiencies/create', [CharacterLanguageProficiencyController::class, 'create'])->name('characters.language-proficiencies.create');
    Route::post('/characters/{character}/language-proficiencies', [CharacterLanguageProficiencyController::class, 'store'])->name('characters.language-proficiencies.store');
    Route::get('/characters/{character}/language-proficiencies/{languageProficiency}/edit', [CharacterLanguageProficiencyController::class, 'edit'])->name('characters.language-proficiencies.edit');
    Route::put('/characters/{character}/language-proficiencies/{languageProficiency}', [CharacterLanguageProficiencyController::class, 'update'])->name('characters.language-proficiencies.update');
    Route::delete('/characters/{character}/language-proficiencies/{languageProficiency}', [CharacterLanguageProficiencyController::class, 'destroy'])->name('characters.language-proficiencies.destroy');
    Route::get('/characters/{character}/appearance', [CharacterAppearanceController::class, 'show'])
        ->name('characters.appearance.show');
    Route::get('/characters/{character}/appearance/edit', [CharacterAppearanceController::class, 'edit'])
        ->name('characters.appearance.edit');
    Route::put('/characters/{character}/appearance', [CharacterAppearanceController::class, 'update'])
        ->name('characters.appearance.update');
    Route::prefix('characters/{character}/sharing')
        ->name('characters.sharing.')
        ->group(function () {
            Route::get(
                '/',
                [CharacterSharingController::class, 'show']
            )->name('show');

            Route::post(
                '/',
                [CharacterSharingController::class, 'store']
            )->name('store');

            Route::put(
                '/{share}',
                [CharacterSharingController::class, 'update']
            )->name('update');

            Route::delete(
                '/{share}',
                [CharacterSharingController::class, 'destroy']
            )->name('destroy');
        });

});

require __DIR__.'/auth.php';
