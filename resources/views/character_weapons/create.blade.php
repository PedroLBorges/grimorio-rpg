<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif text-3xl font-bold text-amber-950 dark:text-amber-200">
            Nova Arma - {{ $character->name }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-b from-[#b08a5a] to-[#6b4423] py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-2xl border-4 border-amber-900/60 bg-amber-100/90 p-6 text-amber-950 shadow-2xl sm:p-8 [&_label]:font-serif [&_label]:font-bold [&_input]:border-amber-800/40 [&_input]:bg-amber-50/70 [&_input]:focus:border-purple-800 [&_input]:focus:ring-purple-800 [&_select]:border-amber-800/40 [&_select]:bg-amber-50/70 [&_textarea]:border-amber-800/40 [&_textarea]:bg-amber-50/70">
                <form method="POST" action="{{ route('characters.weapons.store', $character) }}" class="space-y-4">
                    @csrf

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
                        <label class="block font-medium">Nome da arma</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full rounded border-gray-300" required>
                    </div>

                    <div>
                        <label class="block font-medium">Atributo usado no ataque</label>
                        <select name="ability" class="w-full rounded border-gray-300" required>
                            <option value="strength" {{ old('ability') === 'strength' ? 'selected' : '' }}>
                                Força
                            </option>
                            <option value="dexterity" {{ old('ability') === 'dexterity' ? 'selected' : '' }}>
                                Destreza
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="flex items-center gap-3 rounded border p-3">
                            <input type="checkbox" name="proficient" value="1" {{ old('proficient') ? 'checked' : '' }}>
                            <span>O personagem possui proficiência com esta arma</span>
                        </label>
                    </div>

                    <div>
                        <label class="block font-medium">Dado de dano</label>
                        <input type="text" name="damage_dice" value="{{ old('damage_dice') }}"
                               placeholder="Ex: 1d8, 2d6"
                               class="w-full rounded border-gray-300">
                    </div>

                    <div>
                        <label class="block font-medium">Tipo de dano</label>
                        <input type="text" name="damage_type" value="{{ old('damage_type') }}"
                               placeholder="Ex: cortante, perfurante, contundente"
                               class="w-full rounded border-gray-300">
                    </div>

                    <div>
                        <label class="block font-medium">Alcance</label>
                        <input type="text" name="range" value="{{ old('range') }}"
                               placeholder="Ex: 1,5m ou 18/72m"
                               class="w-full rounded border-gray-300">
                    </div>

                    <div>
                        <label class="block font-medium">Descrição / propriedades</label>
                        <textarea name="description" rows="4"
                                  class="w-full rounded border-gray-300"
                                  placeholder="Ex: leve, versátil, duas mãos, arremesso...">{{ old('description') }}</textarea>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                                class="rounded-lg border border-amber-500/70 bg-gradient-to-r from-amber-900 to-yellow-900 px-5 py-2 font-serif font-bold text-yellow-200 shadow hover:from-amber-800 hover:to-yellow-800">
                            Salvar
                        </button>

                        <a href="{{ route('characters.weapons.index', $character) }}"
                           class="rounded-lg border border-stone-600 bg-stone-300 px-5 py-2 font-serif font-bold text-stone-900 hover:bg-stone-400">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
