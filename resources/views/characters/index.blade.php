<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Meus Personagens
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 rounded bg-green-100 p-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('characters.create') }}"
                   class="inline-block rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                    Novo Personagem
                </a>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @forelse($characters as $character)
                    <div class="border-b py-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-bold">{{ $character->name }}</h3>
                            <p class="text-sm text-gray-600">
                                Raça: {{ $character->race ?? '—' }} |
                                Classe: {{ $character->class ?? '—' }} |
                                Nível: {{ $character->level }}
                            </p>
                        </div>

                        <div class="flex gap-2">
                            <a href="{{ route('characters.show', $character) }}" class="text-blue-600 hover:underline">Ver</a>

                            <form action="{{ route('characters.destroy', $character) }}" method="POST" onsubmit="return confirm('Deseja excluir este personagem?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Excluir</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600">Você ainda não cadastrou nenhum personagem.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
