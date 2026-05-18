<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Aparência - {{ $character->name }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 rounded bg-green-100 p-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-4">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <p><strong>Altura:</strong> {{ $appearance->height ?? '—' }}</p>
                    <p><strong>Peso:</strong> {{ $appearance->weight ?? '—' }}</p>
                    <p><strong>Olhos:</strong> {{ $appearance->eyes ?? '—' }}</p>
                    <p><strong>Cabelo:</strong> {{ $appearance->hair ?? '—' }}</p>
                    <p><strong>Pele:</strong> {{ $appearance->skin ?? '—' }}</p>
                </div>

                <div>
                    <p><strong>Descrição física:</strong></p>
                    <p class="text-gray-700 whitespace-pre-line mt-1">
                        {{ $appearance->description ?? 'Nenhuma descrição cadastrada.' }}
                    </p>
                </div>

                <div class="flex gap-2 pt-4">
                    <a href="{{ route('characters.appearance.edit', $character) }}"
                       class="rounded bg-amber-700 px-4 py-2 text-white hover:bg-amber-800">
                        Editar Aparência
                    </a>

                    <a href="{{ route('characters.show', $character) }}"
                       class="rounded bg-gray-300 px-4 py-2 text-gray-800 hover:bg-gray-400">
                        Voltar à ficha
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
