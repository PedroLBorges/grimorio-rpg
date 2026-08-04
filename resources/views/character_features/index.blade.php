<x-app-layout>
    <x-slot name="header">
        <div class="rounded-xl border border-amber-700/40 bg-amber-100 shadow-md p-4"
            style="background-image: linear-gradient(rgba(255,248,220,.88), rgba(245,222,179,.9));">
        <h2 class="font-serif font-bold text-2xl text-amber-950">
            Habilidades e Características - {{ $character->name }}
        </h2>
    </x-slot>

    <div class="py-8 min-h-screen"
        style="background-color: #b08a5a;
            background-image:
            radial-gradient(circle at 15% 20%, rgba(80, 43, 20, 0.20), transparent 24%),
            radial-gradient(circle at 85% 12%, rgba(92, 51, 23, 0.18), transparent 22%),
            radial-gradient(circle at 35% 85%, rgba(70, 39, 18, 0.16), transparent 28%),
            linear-gradient(rgba(176, 138, 90, 0.95), rgba(139, 102, 62, 0.96));">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 rounded bg-green-100 p-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4 flex gap-2">
                @if ($character->canEdit(auth()->user()))
                <a href="{{ route('characters.features.create', $character) }}"
                   class="rounded-lg border border-amber-900 bg-gradient-to-r from-amber-800 to-amber-950 px-4 py-2 font-semibold text-yellow-200 shadow hover:from-amber-700 hover:to-amber-900">
                    Novo Registro
                </a>
                @endif

                <a href="{{ route('characters.show', $character) }}"
                   class="rounded-lg border border-stone-600 bg-stone-300 px-4 py-2 font-semibold text-stone-900 hover:bg-stone-400">
                    Voltar à ficha
                </a>
            </div>

            <div class="rounded-xl border border-amber-700/30 bg-amber-100/85 shadow-lg p-6 text-amber-950">

                @forelse($features as $feature)
                    <div class="mb-3 rounded-lg border-l-4 border-amber-800 bg-amber-50/60 p-4 shadow-sm flex justify-between gap-4">

                        <div>
                            <h3 class="text-lg font-bold">
                                {{ $feature->name }}
                            </h3>

                            <p class="text-sm text-gray-700">
                                <strong>Tipo:</strong> {{ $feature->type }}
                            </p>

                            @if($feature->description)
                                <p class="text-sm text-gray-600 mt-2">
                                    {{ $feature->description }}
                                </p>
                            @endif
                        </div>

                        @if ($character->canEdit(auth()->user()))
                        <div class="flex gap-2">
                            <a href="{{ route('characters.features.edit', [$character, $feature]) }}"
                               class="text-amber-800 font-semibold hover:underline">
                                Editar
                            </a>

                            <form action="{{ route('characters.features.destroy', [$character, $feature]) }}"
                                  method="POST"
                                  onsubmit="return confirm('Deseja remover este registro?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="text-red-800 font-semibold hover:underline">
                                    Excluir
                                </button>
                            </form>
                        </div>
                        @endif

                    </div>
                @empty
                    <p class="text-gray-600">
                        Nenhuma habilidade ou característica cadastrada.
                    </p>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
