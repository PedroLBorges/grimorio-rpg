<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif text-3xl font-bold text-amber-950 dark:text-amber-200">
            Arsenal de {{ $character->name }}
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
                <a href="{{ route('characters.weapons.create', $character) }}"
                   class="rounded-lg border border-amber-500/70 bg-gradient-to-r from-amber-900 to-yellow-900 px-4 py-2 font-serif font-bold text-yellow-200 shadow hover:from-amber-800 hover:to-yellow-800">
                    Nova Arma
                </a>
                @endif

                <a href="{{ route('characters.show', $character) }}"
                   class="rounded-lg border border-stone-600 bg-stone-300 px-4 py-2 font-serif font-bold text-stone-900 hover:bg-stone-400">
                    Voltar à ficha
                </a>
            </div>

            <div class="rounded-2xl border-4 border-amber-900/60 bg-amber-100/90 p-6 text-amber-950 shadow-2xl">
                @forelse($weapons as $weapon)
                    <div class="mb-3 flex items-start justify-between gap-4 rounded-xl border border-amber-800/30 bg-amber-50/60 p-4 shadow-sm">
                        <div>
                            <h3 class="text-lg font-bold">{{ $weapon->name }}</h3>

                            <p class="text-sm text-gray-700">
                                <strong>Bônus de Ataque:</strong>
                                {{ $weapon->attack_bonus >= 0 ? '+' . $weapon->attack_bonus : $weapon->attack_bonus }}
                            </p>

                            <p class="text-sm text-gray-700">
                                <strong>Atributo:</strong>
                                {{ $weapon->ability === 'strength' ? 'Força' : 'Destreza' }}
                                |
                                <strong>Proficiência:</strong>
                                {{ $weapon->proficient ? 'Sim' : 'Não' }}
                            </p>

                            <p class="text-sm text-gray-700">
                                <strong>Dano:</strong>
                                {{ $weapon->damage_dice ?: '—' }}
                                {{ $weapon->damage_type ? 'de ' . $weapon->damage_type : '' }}
                            </p>

                            <p class="text-sm text-gray-700">
                                <strong>Alcance:</strong> {{ $weapon->range ?: '—' }}
                            </p>

                            @if($weapon->description)
                                <p class="text-sm text-gray-600 mt-2">
                                    {{ $weapon->description }}
                                </p>
                            @endif
                        </div>

                        @if ($character->canEdit(auth()->user()))
                        <div class="flex gap-2">
                            <a href="{{ route('characters.weapons.edit', [$character, $weapon]) }}"
                               class="font-bold text-amber-800 hover:underline">
                                Editar
                            </a>

                            <form action="{{ route('characters.weapons.destroy', [$character, $weapon]) }}"
                                  method="POST"
                                  onsubmit="return confirm('Deseja remover esta arma?')">
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
                    <p class="text-gray-600">Este personagem ainda não possui armas cadastradas.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
