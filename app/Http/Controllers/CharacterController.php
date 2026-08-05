<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Services\CharacterPhotoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\View\View;

class CharacterController extends Controller
{
    public function __construct(private readonly CharacterPhotoService $photos) {}
    /**
     * Lista os personagens próprios e os compartilhados com o usuário.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        $characters = Character::query()
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $sharedCharacters = $user->sharedCharacters()
            ->with('user')
            ->orderBy('characters.name')
            ->get();

        return view('characters.index', [
            'characters' => $characters,
            'sharedCharacters' => $sharedCharacters,
        ]);
    }

    /**
     * Exibe o formulário de criação.
     */
    public function create(): View
    {
        return view('characters.create');
    }

    /**
     * Cadastra um novo personagem.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'race' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'background' => 'required|string|max:255',
            'alignment' => 'required|string|max:255',
            'player_name' => 'nullable|string|max:255',
            'experience' => 'nullable|integer|min:0',
            'speed' => 'nullable|integer|min:0',

            'cp' => 'nullable|integer|min:0',
            'sp' => 'nullable|integer|min:0',
            'ep' => 'nullable|integer|min:0',
            'gp' => 'nullable|integer|min:0',
            'pp' => 'nullable|integer|min:0',

            'level' => 'required|integer|min:1|max:20',
            'backstory' => 'nullable|string',

            'strength' => 'required|integer|min:1|max:20',
            'dexterity' => 'required|integer|min:1|max:20',
            'constitution' => 'required|integer|min:1|max:20',
            'intelligence' => 'required|integer|min:1|max:20',
            'wisdom' => 'required|integer|min:1|max:20',
            'charisma' => 'required|integer|min:1|max:20',

            'acrobatics_proficient' => 'nullable|boolean',
            'animal_handling_proficient' => 'nullable|boolean',
            'arcana_proficient' => 'nullable|boolean',
            'athletics_proficient' => 'nullable|boolean',
            'performance_proficient' => 'nullable|boolean',
            'deception_proficient' => 'nullable|boolean',
            'stealth_proficient' => 'nullable|boolean',
            'history_proficient' => 'nullable|boolean',
            'intimidation_proficient' => 'nullable|boolean',
            'insight_proficient' => 'nullable|boolean',
            'investigation_proficient' => 'nullable|boolean',
            'medicine_proficient' => 'nullable|boolean',
            'nature_proficient' => 'nullable|boolean',
            'perception_proficient' => 'nullable|boolean',
            'persuasion_proficient' => 'nullable|boolean',
            'sleight_of_hand_proficient' => 'nullable|boolean',
            'religion_proficient' => 'nullable|boolean',
            'survival_proficient' => 'nullable|boolean',

            'strength_save_proficient' => 'nullable|boolean',
            'dexterity_save_proficient' => 'nullable|boolean',
            'constitution_save_proficient' => 'nullable|boolean',
            'intelligence_save_proficient' => 'nullable|boolean',
            'wisdom_save_proficient' => 'nullable|boolean',
            'charisma_save_proficient' => 'nullable|boolean',

            'armor_class' => 'required|integer|min:1|max:40',
            'personality_traits' => 'nullable|string',
            'ideals' => 'nullable|string',
            'bonds' => 'nullable|string',
            'flaws' => 'nullable|string',

            'hp_max' => 'required|integer|min:1',
            'hp_current' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo_path'] = $this->photos->store($request->file('photo'));
        }

        unset($validated['photo']);

        $validated['hp_current'] = min(
            $validated['hp_current'],
            $validated['hp_max']
        );

        $skillProficiencies = [
            'acrobatics_proficient',
            'animal_handling_proficient',
            'arcana_proficient',
            'athletics_proficient',
            'performance_proficient',
            'deception_proficient',
            'stealth_proficient',
            'history_proficient',
            'intimidation_proficient',
            'insight_proficient',
            'investigation_proficient',
            'medicine_proficient',
            'nature_proficient',
            'perception_proficient',
            'persuasion_proficient',
            'sleight_of_hand_proficient',
            'religion_proficient',
            'survival_proficient',
        ];

        $savingThrowProficiencies = [
            'strength_save_proficient',
            'dexterity_save_proficient',
            'constitution_save_proficient',
            'intelligence_save_proficient',
            'wisdom_save_proficient',
            'charisma_save_proficient',
        ];

        foreach ($skillProficiencies as $field) {
            $validated[$field] = $request->boolean($field);
        }

        foreach ($savingThrowProficiencies as $field) {
            $validated[$field] = $request->boolean($field);
        }

        $validated['experience'] = $validated['experience'] ?? 0;
        $validated['speed'] = $validated['speed'] ?? 30;

        $validated['cp'] = $validated['cp'] ?? 0;
        $validated['sp'] = $validated['sp'] ?? 0;
        $validated['ep'] = $validated['ep'] ?? 0;
        $validated['gp'] = $validated['gp'] ?? 0;
        $validated['pp'] = $validated['pp'] ?? 0;

        try {
            $request->user()->characters()->create($validated);
        } catch (Throwable $exception) {
            $this->photos->delete($validated['photo_path'] ?? null);
            throw $exception;
        }

        return redirect()
            ->route('characters.index')
            ->with('success', 'Personagem criado com sucesso!');
    }

    /**
     * Exibe a ficha para proprietário, editor ou visualizador.
     */
    public function show(
        Request $request,
        Character $character
    ): View {
        abort_unless(
            $character->canView($request->user()),
            403
        );

        $character->load([
            'features',
            'languageProficiencies',
            'user',
            'shares.user',
        ]);

        $hasPhoto = $this->photos->exists($character->photo_path);
        return view('characters.show', compact('character', 'hasPhoto'));
    }

    /**
     * Exibe o formulário de edição para proprietário ou editor.
     */
    public function edit(
        Request $request,
        Character $character
    ): View {
        abort_unless(
            $character->canEdit($request->user()),
            403
        );

        $hasPhoto = $this->photos->exists($character->photo_path);
        return view('characters.edit', compact('character', 'hasPhoto'));
    }

    /**
     * Atualiza a ficha para proprietário ou editor.
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
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'race' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'background' => 'required|string|max:255',
            'alignment' => 'required|string|max:255',
            'player_name' => 'nullable|string|max:255',
            'experience' => 'nullable|integer|min:0',
            'speed' => 'nullable|integer|min:0',

            'cp' => 'nullable|integer|min:0',
            'sp' => 'nullable|integer|min:0',
            'ep' => 'nullable|integer|min:0',
            'gp' => 'nullable|integer|min:0',
            'pp' => 'nullable|integer|min:0',

            'level' => 'required|integer|min:1|max:20',
            'backstory' => 'nullable|string',

            'strength' => 'required|integer|min:1|max:20',
            'dexterity' => 'required|integer|min:1|max:20',
            'constitution' => 'required|integer|min:1|max:20',
            'intelligence' => 'required|integer|min:1|max:20',
            'wisdom' => 'required|integer|min:1|max:20',
            'charisma' => 'required|integer|min:1|max:20',

            'hp_max' => 'required|integer|min:1',
            'hp_current' => 'required|integer|min:0',

            'acrobatics_proficient' => 'nullable|boolean',
            'animal_handling_proficient' => 'nullable|boolean',
            'arcana_proficient' => 'nullable|boolean',
            'athletics_proficient' => 'nullable|boolean',
            'performance_proficient' => 'nullable|boolean',
            'deception_proficient' => 'nullable|boolean',
            'stealth_proficient' => 'nullable|boolean',
            'history_proficient' => 'nullable|boolean',
            'intimidation_proficient' => 'nullable|boolean',
            'insight_proficient' => 'nullable|boolean',
            'investigation_proficient' => 'nullable|boolean',
            'medicine_proficient' => 'nullable|boolean',
            'nature_proficient' => 'nullable|boolean',
            'perception_proficient' => 'nullable|boolean',
            'persuasion_proficient' => 'nullable|boolean',
            'sleight_of_hand_proficient' => 'nullable|boolean',
            'religion_proficient' => 'nullable|boolean',
            'survival_proficient' => 'nullable|boolean',

            'strength_save_proficient' => 'nullable|boolean',
            'dexterity_save_proficient' => 'nullable|boolean',
            'constitution_save_proficient' => 'nullable|boolean',
            'intelligence_save_proficient' => 'nullable|boolean',
            'wisdom_save_proficient' => 'nullable|boolean',
            'charisma_save_proficient' => 'nullable|boolean',

            'armor_class' => 'required|integer|min:1|max:40',
            'personality_traits' => 'nullable|string',
            'ideals' => 'nullable|string',
            'bonds' => 'nullable|string',
            'flaws' => 'nullable|string',
        ]);

        $skillProficiencies = [
            'acrobatics_proficient',
            'animal_handling_proficient',
            'arcana_proficient',
            'athletics_proficient',
            'performance_proficient',
            'deception_proficient',
            'stealth_proficient',
            'history_proficient',
            'intimidation_proficient',
            'insight_proficient',
            'investigation_proficient',
            'medicine_proficient',
            'nature_proficient',
            'perception_proficient',
            'persuasion_proficient',
            'sleight_of_hand_proficient',
            'religion_proficient',
            'survival_proficient',
        ];

        $savingThrowProficiencies = [
            'strength_save_proficient',
            'dexterity_save_proficient',
            'constitution_save_proficient',
            'intelligence_save_proficient',
            'wisdom_save_proficient',
            'charisma_save_proficient',
        ];

        foreach ($skillProficiencies as $field) {
            $validated[$field] = $request->boolean($field);
        }

        foreach ($savingThrowProficiencies as $field) {
            $validated[$field] = $request->boolean($field);
        }

        $validated['hp_current'] = min(
            $validated['hp_current'],
            $validated['hp_max']
        );

        $oldPhotoPath = $character->photo_path;
        $newPhotoPath = $request->hasFile('photo')
            ? $this->photos->store($request->file('photo'))
            : null;

        if ($newPhotoPath) {
            $validated['photo_path'] = $newPhotoPath;
        }

        unset($validated['photo']);

        try {
            $character->update($validated);
        } catch (Throwable $exception) {
            $this->photos->delete($newPhotoPath);
            throw $exception;
        }

        if ($newPhotoPath) {
            $this->photos->delete($oldPhotoPath);
        }

        return redirect()
            ->route('characters.show', $character)
            ->with('success', 'Personagem atualizado com sucesso!');
    }

    /**
     * Exclui o personagem. Apenas o proprietário pode executar.
     */
    public function destroy(
        Request $request,
        Character $character
    ): RedirectResponse {
        abort_unless(
            $character->isOwner($request->user()),
            403
        );

        $photoPath = $character->photo_path;
        $character->delete();
        $this->photos->delete($photoPath);

        return redirect()
            ->route('characters.index')
            ->with('success', 'Personagem excluído com sucesso!');
    }

    /**
     * Aplica dano ao personagem.
     */
    public function damage(
        Request $request,
        Character $character
    ): RedirectResponse {
        abort_unless(
            $character->canEdit($request->user()),
            403
        );

        $validated = $request->validate([
            'amount' => 'required|integer|min:1',
        ]);

        $character->hp_current = max(
            0,
            $character->hp_current - $validated['amount']
        );

        $character->save();

        return redirect()
            ->route('characters.show', $character)
            ->with('success', 'Dano aplicado com sucesso!');
    }

    /**
     * Recupera pontos de vida do personagem.
     */
    public function heal(
        Request $request,
        Character $character
    ): RedirectResponse {
        abort_unless(
            $character->canEdit($request->user()),
            403
        );

        $validated = $request->validate([
            'amount' => 'required|integer|min:1',
        ]);

        $character->hp_current = min(
            $character->hp_max,
            $character->hp_current + $validated['amount']
        );

        $character->save();

        return redirect()
            ->route('characters.show', $character)
            ->with('success', 'Vida restaurada com sucesso!');
    }

    /**
     * Alterna a inspiração do personagem.
     */
    public function toggleInspiration(
        Request $request,
        Character $character
    ): RedirectResponse {
        abort_unless(
            $character->canEdit($request->user()),
            403
        );

        $character->has_inspiration = ! $character->has_inspiration;
        $character->save();

        return redirect()
            ->route('characters.show', $character)
            ->with('success', 'Inspiração atualizada com sucesso!');
    }

    /**
     * Atualiza as moedas do personagem.
     */
    public function updateCoins(
        Request $request,
        Character $character
    ): RedirectResponse|JsonResponse {
        abort_unless(
            $character->canEdit($request->user()),
            403
        );

        $validated = $request->validate([
            'cp' => 'required|integer|min:0',
            'sp' => 'required|integer|min:0',
            'ep' => 'required|integer|min:0',
            'gp' => 'required|integer|min:0',
            'pp' => 'required|integer|min:0',
        ]);

        $character->update($validated);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'message' => 'Moedas atualizadas com sucesso!',
            ]);
        }

        return redirect()
            ->route('characters.show', $character)
            ->with('success', 'Moedas atualizadas com sucesso!');
    }
}
