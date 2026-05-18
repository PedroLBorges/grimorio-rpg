<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Inventário de {{ $character->name }}
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
                <a href="{{ route('characters.items.create', $character) }}"
                   class="inline-block rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                    Novo Item
                </a>

                <a href="{{ route('characters.show', $character) }}"
                   class="inline-block rounded bg-gray-300 px-4 py-2 text-gray-800 hover:bg-gray-400">
                    Voltar à ficha
                </a>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @forelse($items as $item)
                    <div class="border-b py-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-bold">{{ $item->name }}</h3>
                            <p class="text-sm text-gray-600">
                                Tipo: {{ $item->type ?? '—' }} |
                                Quantidade: {{ $item->quantity }}
                            </p>

                            @if($item->description)
                                <p class="text-sm text-gray-700 mt-1">{{ $item->description }}</p>
                            @endif
                        </div>

                        <div class="flex gap-2">
                            <a href="{{ route('characters.items.edit', [$character, $item]) }}"
                               class="text-yellow-600 hover:underline">
                                Editar
                            </a>

                            <form action="{{ route('characters.items.destroy', [$character, $item]) }}"
                                  method="POST"
                                  onsubmit="return confirm('Deseja remover este item?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">
                                    Excluir
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600">Este personagem ainda não possui itens no inventário.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
