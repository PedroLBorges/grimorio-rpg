<x-app-layout>
    <x-slot name="header">
        <div class="rounded-xl border border-amber-700/40 bg-amber-100 p-4 shadow-md" style="background-image:linear-gradient(rgba(255,248,220,.88),rgba(245,222,179,.9))">
            <h2 class="font-serif text-2xl font-bold text-amber-950">Idiomas e proficiências - {{ $character->name }}</h2>
        </div>
    </x-slot>
    <div class="min-h-screen bg-gradient-to-b from-[#b08a5a] to-[#6b4423] py-8">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            @if(session('success'))<div class="mb-5 rounded-lg border border-green-800/30 bg-green-100 p-4 text-green-900 shadow">{{ session('success') }}</div>@endif
            <div class="mb-4 flex flex-wrap gap-2">
                @if ($character->canEdit(auth()->user()))
                    <a href="{{ route('characters.language-proficiencies.create', $character) }}" class="rounded-lg border border-amber-900 bg-gradient-to-r from-amber-800 to-amber-950 px-4 py-2 font-semibold text-yellow-200 shadow">Novo registro</a>
                @endif
                <a href="{{ route('characters.show', $character) }}" class="rounded-lg border border-stone-600 bg-stone-300 px-4 py-2 font-semibold text-stone-900">Voltar à ficha</a>
            </div>
            <div class="rounded-2xl border-4 border-amber-900/60 bg-amber-100/90 p-6 text-amber-950 shadow-2xl">
                @forelse($records as $record)
                    <article class="mb-3 flex justify-between gap-4 rounded-lg border-l-4 border-amber-800 bg-amber-50/60 p-4 shadow-sm">
                        <div><h3 class="font-serif text-lg font-bold">{{ $record->name }}</h3><p class="text-sm text-amber-900/75"><strong>Tipo:</strong> {{ $record->type }}</p>@if($record->description)<p class="mt-2 whitespace-pre-line text-sm text-amber-950/75">{{ $record->description }}</p>@endif</div>
                        @if ($character->canEdit(auth()->user()))
                            <div class="flex gap-2"><a href="{{ route('characters.language-proficiencies.edit', [$character, $record]) }}" class="font-semibold text-amber-800 hover:underline">Editar</a><form action="{{ route('characters.language-proficiencies.destroy', [$character, $record]) }}" method="POST" onsubmit="return confirm('Deseja remover este registro?')">@csrf @method('DELETE')<button type="submit" class="font-semibold text-red-800 hover:underline">Excluir</button></form></div>
                        @endif
                    </article>
                @empty
                    <div class="rounded-xl border border-dashed border-amber-800/35 bg-amber-50/40 p-8 text-center"><p class="font-serif text-xl font-bold">Nenhum idioma ou proficiência cadastrado.</p></div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
