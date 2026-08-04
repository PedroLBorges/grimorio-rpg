<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif text-3xl font-bold text-amber-950 dark:text-amber-200">
            Inventário de {{ $character->name }}
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
                <a href="{{ route('characters.items.create', $character) }}"
                   class="inline-block rounded-lg border border-amber-500/70 bg-gradient-to-r from-purple-950 via-purple-800 to-indigo-950 px-4 py-2 font-serif font-bold text-amber-200 shadow hover:from-purple-900 hover:to-indigo-900">
                    Novo Item
                </a>
                @endif

                <a href="{{ route('characters.show', $character) }}"
                   class="inline-block rounded-lg border border-stone-600 bg-stone-300 px-4 py-2 font-serif font-bold text-stone-900 hover:bg-stone-400">
                    Voltar à ficha
                </a>
            </div>

            <div class="rounded-2xl border-4 border-amber-900/60 bg-amber-100/90 p-6 text-amber-950 shadow-2xl">
                @forelse($items as $item)
                    <div class="mb-3 flex items-center justify-between gap-4 rounded-xl border border-amber-800/30 bg-amber-50/60 p-4 shadow-sm">
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

                        @if ($character->canEdit(auth()->user()))
                        <div class="flex gap-2">
                            <a href="{{ route('characters.items.edit', [$character, $item]) }}"
                               class="font-bold text-amber-800 hover:underline">
                                Editar
                            </a>

                            <form action="{{ route('characters.items.destroy', [$character, $item]) }}"
                                  method="POST"
                                  onsubmit="return confirm('Deseja remover este item?')">
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
                    <p class="text-gray-600">Este personagem ainda não possui itens no inventário.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
