<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Idiomas e Outras Proficiências - {{ $character->name }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 rounded bg-green-100 p-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4 flex gap-2">
                @if ($character->canEdit(auth()->user()))
                <a href="{{ route('characters.language-proficiencies.create', $character) }}"
                   class="rounded bg-amber-700 px-4 py-2 text-white hover:bg-amber-800">
                    Novo Registro
                </a>
                @endif

                <a href="{{ route('characters.show', $character) }}"
                   class="rounded bg-gray-300 px-4 py-2 text-gray-800 hover:bg-gray-400">
                    Voltar à ficha
                </a>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @forelse($records as $record)
                    <div class="border-b py-4 flex justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold">{{ $record->name }}</h3>

                            <p class="text-sm text-gray-700">
                                <strong>Tipo:</strong> {{ $record->type }}
                            </p>

                            @if($record->description)
                                <p class="text-sm text-gray-600 mt-2">
                                    {{ $record->description }}
                                </p>
                            @endif
                        </div>

                        @if ($character->canEdit(auth()->user()))
                        <div class="flex gap-2">
                            <a href="{{ route('characters.language-proficiencies.edit', [$character, $record]) }}"
                               class="text-yellow-600 hover:underline">
                                Editar
                            </a>

                            <form action="{{ route('characters.language-proficiencies.destroy', [$character, $record]) }}"
                                  method="POST"
                                  onsubmit="return confirm('Deseja remover este registro?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="text-red-600 hover:underline">
                                    Excluir
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-600">
                        Nenhum idioma ou proficiência cadastrada.
                    </p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
