<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Grimório de {{ $character->name }}
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
                <a href="{{ route('characters.spells.create', $character) }}"
                   class="rounded bg-purple-600 px-4 py-2 text-white hover:bg-purple-700">
                    Nova Magia
                </a>

                <a href="{{ route('characters.show', $character) }}"
                   class="rounded bg-gray-300 px-4 py-2 text-gray-800 hover:bg-gray-400">
                    Voltar à ficha
                </a>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @forelse($spells as $spell)
                    <div class="border-b py-4 flex justify-between gap-4">

                        <div>
                            <h3 class="text-lg font-bold">{{ $spell->name }}</h3>

                            <p class="text-sm text-gray-700">
                                <strong>Nível:</strong> {{ $spell->level ?: '—' }} |
                                <strong>Escola:</strong> {{ $spell->school ?: '—' }}
                            </p>

                            <p class="text-sm text-gray-700">
                                <strong>Conjuração:</strong> {{ $spell->casting_time ?: '—' }}
                            </p>

                            <p class="text-sm text-gray-700">
                                <strong>Alcance:</strong> {{ $spell->range ?: '—' }} |
                                <strong>Duração:</strong> {{ $spell->duration ?: '—' }}
                            </p>

                            <p class="text-sm text-gray-700">
                                <strong>Componentes:</strong> {{ $spell->components ?: '—' }}
                            </p>

                            @if($spell->description)
                                <p class="text-sm text-gray-600 mt-2">
                                    {{ $spell->description }}
                                </p>
                            @endif
                        </div>

                        <div class="flex gap-2">
                            <a href="{{ route('characters.spells.edit', [$character, $spell]) }}"
                               class="text-yellow-600 hover:underline">
                                Editar
                            </a>

                            <form action="{{ route('characters.spells.destroy', [$character, $spell]) }}"
                                  method="POST"
                                  onsubmit="return confirm('Deseja remover esta magia?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="text-red-600 hover:underline">
                                    Excluir
                                </button>
                            </form>
                        </div>

                    </div>
                @empty
                    <p class="text-gray-600">
                        Este personagem ainda não possui magias cadastradas.
                    </p>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
