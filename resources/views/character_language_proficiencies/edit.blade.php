<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Registro - {{ $character->name }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('characters.language-proficiencies.update', [$character, $languageProficiency]) }}" class="space-y-4">
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
                        <label class="block font-medium">Tipo</label>
                        <select name="type" class="w-full rounded border-gray-300" required>
                            <option value="Idioma" {{ old('type', $languageProficiency->type) === 'Idioma' ? 'selected' : '' }}>
                                Idioma
                            </option>
                            <option value="Proficiência" {{ old('type', $languageProficiency->type) === 'Proficiência' ? 'selected' : '' }}>
                                Proficiência
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium">Nome</label>
                        <input type="text" name="name" value="{{ old('name', $languageProficiency->name) }}"
                               class="w-full rounded border-gray-300" required>
                    </div>

                    <div>
                        <label class="block font-medium">Descrição</label>
                        <textarea name="description" rows="5"
                                  class="w-full rounded border-gray-300">{{ old('description', $languageProficiency->description) }}</textarea>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                                class="rounded bg-amber-700 px-4 py-2 text-white hover:bg-amber-800">
                            Atualizar
                        </button>

                        <a href="{{ route('characters.language-proficiencies.index', $character) }}"
                           class="rounded bg-gray-300 px-4 py-2 text-gray-800 hover:bg-gray-400">
                            Cancelar
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
