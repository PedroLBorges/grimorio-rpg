<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nova Arma - {{ $character->name }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
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
                                class="rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                            Salvar
                        </button>

                        <a href="{{ route('characters.weapons.index', $character) }}"
                           class="rounded bg-gray-300 px-4 py-2 text-gray-800 hover:bg-gray-400">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
