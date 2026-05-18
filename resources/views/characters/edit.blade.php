<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Personagem
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('characters.update', $character) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    @if ($errors->any())
                        <div class="mb-4 rounded bg-red-100 p-4 text-red-800">
                            <strong>Há erros no formulário:</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div>
                        <label class="block font-medium">Nome do Personagem</label>
                        <input type="text" name="name" value="{{ old('name', $character->name) }}" class="w-full rounded border-gray-300" required>
                    </div>

                    <div>
                        <label class="block font-medium">Nome do Jogador</label>
                        <input type="text" name="player_name" value="{{ old('player_name', $character->player_name) }}" class="w-full rounded border-gray-300">
                    </div>

                    <div>
                        <label class="block font-medium">Raça</label>
                        <select name="race" class="w-full rounded border-gray-300" required>
                            <option value="">Selecione</option>
                            @foreach(['Humano', 'Anão', 'Elfo', 'Halfling', 'Draconato', 'Gnomo', 'Meio-Elfo', 'Meio-Orc', 'Tiefling'] as $option)
                                <option value="{{ $option }}" {{ old('race', $character->race) === $option ? 'selected' : '' }}>{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium">Classe</label>
                        <select name="class" class="w-full rounded border-gray-300" required>
                            <option value="">Selecione</option>
                            @foreach(['Bárbaro', 'Bardo', 'Bruxo', 'Clérigo', 'Druida', 'Feiticeiro', 'Guerreiro', 'Ladino', 'Mago', 'Monge', 'Paladino', 'Patrulheiro'] as $option)
                                <option value="{{ $option }}" {{ old('class', $character->class) === $option ? 'selected' : '' }}>{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium">Antecedente</label>
                        <select name="background" class="w-full rounded border-gray-300" required>
                            <option value="">Selecione</option>
                            @foreach(['Acólito', 'Artesão de Guilda', 'Artista', 'Charlatão', 'Criminoso', 'Eremita', 'Forasteiro', 'Herói do Povo', 'Marinheiro', 'Nobre', 'Órfão', 'Sábio', 'Soldado'] as $option)
                                <option value="{{ $option }}" {{ old('background', $character->background) === $option ? 'selected' : '' }}>{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium">Tendência</label>
                        <select name="alignment" class="w-full rounded border-gray-300" required>
                            <option value="">Selecione</option>
                            @foreach(['Leal e Bom', 'Neutro e Bom', 'Caótico e Bom', 'Leal e Neutro', 'Neutro', 'Caótico e Neutro', 'Leal e Mau', 'Neutro e Mau', 'Caótico e Mau'] as $option)
                                <option value="{{ $option }}" {{ old('alignment', $character->alignment) === $option ? 'selected' : '' }}>{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium">Pontos de Experiência</label>
                        <input type="number" name="experience" value="{{ old('experience', $character->experience) }}" min="0" class="w-full rounded border-gray-300">
                    </div>

                    <div>
                        <label class="block font-medium">Nível</label>
                        <input type="number" name="level" value="{{ old('level', $character->level) }}" min="1" class="w-full rounded border-gray-300" required>
                    </div>

                    <div>
                    <h3 class="text-lg font-semibold mb-2">Atributos</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block font-medium">Força</label>
                            <input type="number" name="strength" value="{{ old('strength', $character->strength) }}" min="1" max="20" class="w-full rounded border-gray-300" required>
                        </div>

                        <div>
                            <label class="block font-medium">Destreza</label>
                            <input type="number" name="dexterity" value="{{ old('dexterity', $character->dexterity) }}" min="1" max="20" class="w-full rounded border-gray-300" required>
                        </div>

                        <div>
                            <label class="block font-medium">Constituição</label>
                            <input type="number" name="constitution" value="{{ old('constitution', $character->constitution) }}" min="1" max="20" class="w-full rounded border-gray-300" required>
                        </div>

                        <div>
                            <label class="block font-medium">Inteligência</label>
                            <input type="number" name="intelligence" value="{{ old('intelligence', $character->intelligence) }}" min="1" max="20" class="w-full rounded border-gray-300" required>
                        </div>

                        <div>
                            <label class="block font-medium">Sabedoria</label>
                            <input type="number" name="wisdom" value="{{ old('wisdom', $character->wisdom) }}" min="1" max="20" class="w-full rounded border-gray-300" required>
                        </div>

                        <div>
                            <label class="block font-medium">Carisma</label>
                            <input type="number" name="charisma" value="{{ old('charisma', $character->charisma) }}" min="1" max="20" class="w-full rounded border-gray-300" required>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-2">Pontos de Vida</h3>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium">HP Máximo</label>
                            <input type="number" name="hp_max"
                                value="{{ old('hp_max', $character->hp_max) }}"
                                min="1"
                                class="w-full rounded border-gray-300" required>
                        </div>

                        <div>
                            <label class="block font-medium">HP Atual</label>
                            <input type="number" name="hp_current"
                                value="{{ old('hp_current', $character->hp_current) }}"
                                min="0"
                                class="w-full rounded border-gray-300" required>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block font-medium">Classe de Armadura (CA)</label>
                    <input type="number" name="armor_class" value="{{ old('armor_class', $character->armor_class) }}" min="1" max="40" class="w-full rounded border-gray-300" required>
                </div>

                <div>
                    <label class="flex items-center gap-3 rounded border p-3">
                        <input type="checkbox" name="has_inspiration" value="1" {{ old('has_inspiration', $character->has_inspiration) ? 'checked' : '' }}>
                        <span>Personagem possui inspiração</span>
                    </label>
                </div>

                <div>
                    <label class="block font-medium">Idiomas e outras proficiências</label>
                    <textarea name="languages_and_proficiencies" rows="4" class="w-full rounded border-gray-300">{{ old('languages_and_proficiencies', $character->languages_and_proficiencies) }}</textarea>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-2">Perícias (D&D 5e)</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Marque apenas as perícias nas quais o personagem possui proficiência.
                        O modificador será calculado automaticamente com base no atributo relacionado e no bônus de proficiência.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                        <label class="flex items-center gap-3 rounded border p-3">
                            <input type="checkbox" name="acrobatics_proficient" value="1" {{ old('acrobatics_proficient', $character->acrobatics_proficient) ? 'checked' : '' }}>
                            <span>Acrobacia (Destreza)</span>
                        </label>

                        <label class="flex items-center gap-3 rounded border p-3">
                            <input type="checkbox" name="animal_handling_proficient" value="1" {{ old('animal_handling_proficient', $character->animal_handling_proficient) ? 'checked' : '' }}>
                            <span>Adestrar Animais (Sabedoria)</span>
                        </label>

                        <label class="flex items-center gap-3 rounded border p-3">
                            <input type="checkbox" name="arcana_proficient" value="1" {{ old('arcana_proficient', $character->arcana_proficient) ? 'checked' : '' }}>
                            <span>Arcanismo (Inteligência)</span>
                        </label>

                        <label class="flex items-center gap-3 rounded border p-3">
                            <input type="checkbox" name="athletics_proficient" value="1" {{ old('athletics_proficient', $character->athletics_proficient) ? 'checked' : '' }}>
                            <span>Atletismo (Força)</span>
                        </label>

                        <label class="flex items-center gap-3 rounded border p-3">
                            <input type="checkbox" name="performance_proficient" value="1" {{ old('performance_proficient', $character->performance_proficient) ? 'checked' : '' }}>
                            <span>Atuação (Carisma)</span>
                        </label>

                        <label class="flex items-center gap-3 rounded border p-3">
                            <input type="checkbox" name="deception_proficient" value="1" {{ old('deception_proficient', $character->deception_proficient) ? 'checked' : '' }}>
                            <span>Enganação (Carisma)</span>
                        </label>

                        <label class="flex items-center gap-3 rounded border p-3">
                            <input type="checkbox" name="stealth_proficient" value="1" {{ old('stealth_proficient', $character->stealth_proficient) ? 'checked' : '' }}>
                            <span>Furtividade (Destreza)</span>
                        </label>

                        <label class="flex items-center gap-3 rounded border p-3">
                            <input type="checkbox" name="history_proficient" value="1" {{ old('history_proficient', $character->history_proficient) ? 'checked' : '' }}>
                            <span>História (Inteligência)</span>
                        </label>

                        <label class="flex items-center gap-3 rounded border p-3">
                            <input type="checkbox" name="intimidation_proficient" value="1" {{ old('intimidation_proficient', $character->intimidation_proficient) ? 'checked' : '' }}>
                            <span>Intimidação (Carisma)</span>
                        </label>

                        <label class="flex items-center gap-3 rounded border p-3">
                            <input type="checkbox" name="insight_proficient" value="1" {{ old('insight_proficient', $character->insight_proficient) ? 'checked' : '' }}>
                            <span>Intuição (Sabedoria)</span>
                        </label>

                        <label class="flex items-center gap-3 rounded border p-3">
                            <input type="checkbox" name="investigation_proficient" value="1" {{ old('investigation_proficient', $character->investigation_proficient) ? 'checked' : '' }}>
                            <span>Investigação (Inteligência)</span>
                        </label>

                        <label class="flex items-center gap-3 rounded border p-3">
                            <input type="checkbox" name="medicine_proficient" value="1" {{ old('medicine_proficient', $character->medicine_proficient) ? 'checked' : '' }}>
                            <span>Medicina (Sabedoria)</span>
                        </label>

                        <label class="flex items-center gap-3 rounded border p-3">
                            <input type="checkbox" name="nature_proficient" value="1" {{ old('nature_proficient', $character->nature_proficient) ? 'checked' : '' }}>
                            <span>Natureza (Inteligência)</span>
                        </label>

                        <label class="flex items-center gap-3 rounded border p-3">
                            <input type="checkbox" name="perception_proficient" value="1" {{ old('perception_proficient', $character->perception_proficient) ? 'checked' : '' }}>
                            <span>Percepção (Sabedoria)</span>
                        </label>

                        <label class="flex items-center gap-3 rounded border p-3">
                            <input type="checkbox" name="persuasion_proficient" value="1" {{ old('persuasion_proficient', $character->persuasion_proficient) ? 'checked' : '' }}>
                            <span>Persuasão (Carisma)</span>
                        </label>

                        <label class="flex items-center gap-3 rounded border p-3">
                            <input type="checkbox" name="sleight_of_hand_proficient" value="1" {{ old('sleight_of_hand_proficient', $character->sleight_of_hand_proficient) ? 'checked' : '' }}>
                            <span>Prestidigitação (Destreza)</span>
                        </label>

                        <label class="flex items-center gap-3 rounded border p-3">
                            <input type="checkbox" name="religion_proficient" value="1" {{ old('religion_proficient', $character->religion_proficient) ? 'checked' : '' }}>
                            <span>Religião (Inteligência)</span>
                        </label>

                        <label class="flex items-center gap-3 rounded border p-3">
                            <input type="checkbox" name="survival_proficient" value="1" {{ old('survival_proficient', $character->survival_proficient) ? 'checked' : '' }}>
                            <span>Sobrevivência (Sabedoria)</span>
                        </label>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-2">Testes de Resistência</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Marque os testes de resistência nos quais o personagem possui proficiência.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                        <label class="flex items-center gap-3 rounded border p-3">
                            <input type="checkbox" name="strength_save_proficient" value="1" {{ old('strength_save_proficient', $character->strength_save_proficient) ? 'checked' : '' }}>
                            <span>Força</span>
                        </label>

                        <label class="flex items-center gap-3 rounded border p-3">
                            <input type="checkbox" name="dexterity_save_proficient" value="1" {{ old('dexterity_save_proficient', $character->dexterity_save_proficient) ? 'checked' : '' }}>
                            <span>Destreza</span>
                        </label>

                        <label class="flex items-center gap-3 rounded border p-3">
                            <input type="checkbox" name="constitution_save_proficient" value="1" {{ old('constitution_save_proficient', $character->constitution_save_proficient) ? 'checked' : '' }}>
                            <span>Constituição</span>
                        </label>

                        <label class="flex items-center gap-3 rounded border p-3">
                            <input type="checkbox" name="intelligence_save_proficient" value="1" {{ old('intelligence_save_proficient', $character->intelligence_save_proficient) ? 'checked' : '' }}>
                            <span>Inteligência</span>
                        </label>

                        <label class="flex items-center gap-3 rounded border p-3">
                            <input type="checkbox" name="wisdom_save_proficient" value="1" {{ old('wisdom_save_proficient', $character->wisdom_save_proficient) ? 'checked' : '' }}>
                            <span>Sabedoria</span>
                        </label>

                        <label class="flex items-center gap-3 rounded border p-3">
                            <input type="checkbox" name="charisma_save_proficient" value="1" {{ old('charisma_save_proficient', $character->charisma_save_proficient) ? 'checked' : '' }}>
                            <span>Carisma</span>
                        </label>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-2">Moedas</h3>

                    <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
                        <div>
                            <label class="block font-medium">PC</label>
                            <input type="number" name="cp" value="{{ old('cp', $character->cp) }}" min="0" class="w-full rounded border-gray-300">
                        </div>

                        <div>
                            <label class="block font-medium">PP</label>
                            <input type="number" name="sp" value="{{ old('sp', $character->sp) }}" min="0" class="w-full rounded border-gray-300">
                        </div>

                        <div>
                            <label class="block font-medium">PE</label>
                            <input type="number" name="ep" value="{{ old('ep', $character->ep) }}" min="0" class="w-full rounded border-gray-300">
                        </div>

                        <div>
                            <label class="block font-medium">PO</label>
                            <input type="number" name="gp" value="{{ old('gp', $character->gp) }}" min="0" class="w-full rounded border-gray-300">
                        </div>

                        <div>
                            <label class="block font-medium">PL</label>
                            <input type="number" name="pp" value="{{ old('pp', $character->pp) }}" min="0" class="w-full rounded border-gray-300">
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-2">Personalidade</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block font-medium">Traços de Personalidade</label>
                            <textarea name="personality_traits" rows="3" class="w-full rounded border-gray-300">{{ old('personality_traits', $character->personality_traits ?? '') }}</textarea>
                        </div>

                        <div>
                            <label class="block font-medium">Ideais</label>
                            <textarea name="ideals" rows="3" class="w-full rounded border-gray-300">{{ old('ideals', $character->ideals ?? '') }}</textarea>
                        </div>

                        <div>
                            <label class="block font-medium">Ligações</label>
                            <textarea name="bonds" rows="3" class="w-full rounded border-gray-300">{{ old('bonds', $character->bonds ?? '') }}</textarea>
                        </div>

                        <div>
                            <label class="block font-medium">Defeitos</label>
                            <textarea name="flaws" rows="3" class="w-full rounded border-gray-300">{{ old('flaws', $character->flaws ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block font-medium">História</label>
                    <textarea name="backstory" rows="5" class="w-full rounded border-gray-300">{{ old('backstory', $character->backstory) }}</textarea>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">                            Atualizar
                    </button>
                    <a href="{{ route('characters.show', $character) }}"
                        class="rounded bg-gray-300 px-4 py-2 text-gray-800 hover:bg-gray-400">
                        Cancelar
                    </a>
                </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
