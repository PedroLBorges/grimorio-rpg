<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Arsenal de {{ $character->name }}
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
                <a href="{{ route('characters.weapons.create', $character) }}"
                   class="rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                    Nova Arma
                </a>

                <a href="{{ route('characters.show', $character) }}"
                   class="rounded bg-gray-300 px-4 py-2 text-gray-800 hover:bg-gray-400">
                    Voltar à ficha
                </a>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @forelse($weapons as $weapon)
                    <div class="border-b py-4 flex items-start justify-between gap-4">
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

                        <div class="flex gap-2">
                            <a href="{{ route('characters.weapons.edit', [$character, $weapon]) }}"
                               class="text-yellow-600 hover:underline">
                                Editar
                            </a>

                            <form action="{{ route('characters.weapons.destroy', [$character, $weapon]) }}"
                                  method="POST"
                                  onsubmit="return confirm('Deseja remover esta arma?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="text-red-600 hover:underline">
                                    Excluir
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600">Este personagem ainda não possui armas cadastradas.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
