<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif text-3xl font-bold text-purple-950 dark:text-amber-200">
            Grimório de {{ $character->name }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-b from-[#b08a5a] to-[#6b4423] py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-5 rounded-lg border border-green-800/30 bg-green-100 p-4 text-green-900 shadow">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4 flex gap-2">
                @if ($character->canEdit(auth()->user()))
                <a href="{{ route('characters.spells.create', $character) }}"
                   class="rounded-lg border border-amber-500/70 bg-gradient-to-r from-purple-950 via-purple-800 to-indigo-950 px-4 py-2 font-serif font-bold text-amber-200 shadow hover:from-purple-900 hover:to-indigo-900">
                    Nova Magia
                </a>
                @endif

                <a href="{{ route('characters.show', $character) }}"
                   class="rounded-lg border border-stone-600 bg-stone-300 px-4 py-2 font-serif font-bold text-stone-900 hover:bg-stone-400">
                    Voltar à ficha
                </a>
            </div>

            <div class="rounded-2xl border-4 border-purple-950/70 bg-amber-100/90 p-6 text-amber-950 shadow-2xl">

                @forelse($spells as $spell)
                    <div class="mb-3 flex justify-between gap-4 rounded-xl border border-purple-900/30 bg-purple-50/40 p-4 shadow-sm">

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

                        @if ($character->canEdit(auth()->user()))
                        <div class="flex gap-2">
                            <a href="{{ route('characters.spells.edit', [$character, $spell]) }}"
                               class="font-bold text-amber-800 hover:underline">
                                Editar
                            </a>

                            <form action="{{ route('characters.spells.destroy', [$character, $spell]) }}"
                                  method="POST"
                                  onsubmit="return confirm('Deseja remover esta magia?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="font-bold text-red-800 hover:underline">
                                    Excluir
                                </button>
                            </form>
                        </div>
                        @endif

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
