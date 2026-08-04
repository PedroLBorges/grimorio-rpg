<x-app-layout>
    <x-slot name="header">
        <div
            class="rounded-xl border border-amber-700/40 p-5 shadow-md"
            style="
                background-image:
                    linear-gradient(
                        rgba(255, 248, 220, .90),
                        rgba(232, 207, 164, .94)
                    );
            "
        >
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="font-serif text-sm uppercase tracking-[0.25em] text-amber-800">
                        Capítulo da aparência
                    </p>

                    <h2 class="font-serif text-3xl font-bold text-amber-950">
                        Editar aparência de {{ $character->name }}
                    </h2>

                    <p class="mt-1 text-sm text-amber-900/75">
                        Registre detalhes que tornam este aventureiro único.
                    </p>
                </div>

                <a
                    href="{{ route('characters.appearance.show', $character) }}"
                    class="rounded-lg border border-amber-800 bg-amber-700 px-4 py-2 text-center font-serif text-sm font-bold text-white shadow transition hover:bg-amber-800"
                >
                    Voltar à aparência
                </a>
            </div>
        </div>
    </x-slot>

    <div
        class="min-h-screen py-10"
        style="
            background-color: #8b6a43;
            background-image:
                radial-gradient(circle at 15% 20%, rgba(80, 43, 20, .20), transparent 24%),
                radial-gradient(circle at 85% 12%, rgba(92, 51, 23, .18), transparent 22%),
                radial-gradient(circle at 35% 85%, rgba(70, 39, 18, .16), transparent 28%),
                linear-gradient(
                    rgba(176, 138, 90, .95),
                    rgba(139, 102, 62, .96)
                );
        "
    >
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div
                class="rounded-2xl border-4 border-amber-900/60 p-6 shadow-2xl sm:p-8"
                style="
                    background-color: #ead4a5;
                    background-image:
                        radial-gradient(circle at 12% 18%, rgba(120, 53, 15, .10), transparent 19%),
                        radial-gradient(circle at 87% 77%, rgba(92, 51, 23, .12), transparent 22%),
                        linear-gradient(
                            rgba(255, 248, 220, .92),
                            rgba(232, 207, 164, .95)
                        );
                "
            >
                <form
                    method="POST"
                    action="{{ route('characters.appearance.update', $character) }}"
                    class="space-y-7"
                >
                    @csrf
                    @method('PUT')

                    @if ($errors->any())
                        <div class="rounded-xl border border-red-800/40 bg-red-100 p-4 text-red-900 shadow">
                            <strong class="font-serif text-lg">
                                Há erros no registro:
                            </strong>

                            <ul class="mt-2 list-inside list-disc text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 gap-8 lg:grid-cols-[260px_1fr]">
                        <aside>
                            <div class="rounded-xl border border-amber-800/30 bg-amber-50/45 p-4 shadow-sm">
                                @if ($character->photo_path)
                                    <img
                                        src="{{ asset('storage/' . $character->photo_path) }}"
                                        alt="Retrato de {{ $character->name }}"
                                        class="mx-auto h-80 w-full rounded-xl border-4 border-amber-900/55 object-cover shadow-xl"
                                    >
                                @else
                                    <div
                                        class="flex h-80 items-center justify-center rounded-xl border-4 border-dashed border-amber-900/35 bg-amber-100/40 p-5 text-center"
                                    >
                                        <p class="font-serif text-sm text-amber-900/65">
                                            O retrato pode ser adicionado pela edição principal da ficha.
                                        </p>
                                    </div>
                                @endif

                                <p class="mt-4 text-center font-serif text-xl font-bold text-amber-950">
                                    {{ $character->name }}
                                </p>

                                <a
                                    href="{{ route('characters.edit', $character) }}"
                                    class="mt-4 block w-full rounded-lg border border-purple-900 bg-purple-900 px-4 py-2 text-center font-serif text-sm font-bold text-amber-200 shadow transition hover:bg-purple-800"
                                >
                                    Alterar retrato
                                </a>
                            </div>
                        </aside>

                        <main class="space-y-6">
                            <section class="rounded-xl border border-amber-800/30 bg-amber-50/45 p-5 shadow-sm">
                                <header class="mb-5">
                                    <p class="font-serif text-xs uppercase tracking-[0.3em] text-amber-800">
                                        Características
                                    </p>

                                    <h3 class="font-serif text-2xl font-bold text-amber-950">
                                        Detalhes físicos
                                    </h3>

                                    <div class="mt-3 h-px bg-amber-800/30"></div>
                                </header>

                                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                                    <div>
                                        <label
                                            for="height"
                                            class="block font-serif text-sm font-bold text-amber-950"
                                        >
                                            Altura
                                        </label>

                                        <input
                                            id="height"
                                            type="text"
                                            name="height"
                                            value="{{ old('height', $appearance->height ?? '') }}"
                                            placeholder="Ex.: 1,80 m"
                                            class="mt-1 w-full rounded-lg border-amber-800/40 bg-amber-50/80 text-amber-950 shadow-inner placeholder:text-amber-800/40 focus:border-purple-800 focus:ring-purple-800"
                                        >
                                    </div>

                                    <div>
                                        <label
                                            for="weight"
                                            class="block font-serif text-sm font-bold text-amber-950"
                                        >
                                            Peso
                                        </label>

                                        <input
                                            id="weight"
                                            type="text"
                                            name="weight"
                                            value="{{ old('weight', $appearance->weight ?? '') }}"
                                            placeholder="Ex.: 75 kg"
                                            class="mt-1 w-full rounded-lg border-amber-800/40 bg-amber-50/80 text-amber-950 shadow-inner placeholder:text-amber-800/40 focus:border-purple-800 focus:ring-purple-800"
                                        >
                                    </div>

                                    <div>
                                        <label
                                            for="eyes"
                                            class="block font-serif text-sm font-bold text-amber-950"
                                        >
                                            Olhos
                                        </label>

                                        <input
                                            id="eyes"
                                            type="text"
                                            name="eyes"
                                            value="{{ old('eyes', $appearance->eyes ?? '') }}"
                                            placeholder="Ex.: verdes"
                                            class="mt-1 w-full rounded-lg border-amber-800/40 bg-amber-50/80 text-amber-950 shadow-inner placeholder:text-amber-800/40 focus:border-purple-800 focus:ring-purple-800"
                                        >
                                    </div>

                                    <div>
                                        <label
                                            for="hair"
                                            class="block font-serif text-sm font-bold text-amber-950"
                                        >
                                            Cabelo
                                        </label>

                                        <input
                                            id="hair"
                                            type="text"
                                            name="hair"
                                            value="{{ old('hair', $appearance->hair ?? '') }}"
                                            placeholder="Ex.: castanho escuro"
                                            class="mt-1 w-full rounded-lg border-amber-800/40 bg-amber-50/80 text-amber-950 shadow-inner placeholder:text-amber-800/40 focus:border-purple-800 focus:ring-purple-800"
                                        >
                                    </div>

                                    <div class="md:col-span-2">
                                        <label
                                            for="skin"
                                            class="block font-serif text-sm font-bold text-amber-950"
                                        >
                                            Pele
                                        </label>

                                        <input
                                            id="skin"
                                            type="text"
                                            name="skin"
                                            value="{{ old('skin', $appearance->skin ?? '') }}"
                                            placeholder="Ex.: clara, bronzeada, oliva..."
                                            class="mt-1 w-full rounded-lg border-amber-800/40 bg-amber-50/80 text-amber-950 shadow-inner placeholder:text-amber-800/40 focus:border-purple-800 focus:ring-purple-800"
                                        >
                                    </div>
                                </div>
                            </section>

                            <section class="rounded-xl border border-amber-800/30 bg-amber-50/45 p-5 shadow-sm">
                                <label
                                    for="description"
                                    class="block font-serif text-xl font-bold text-amber-950"
                                >
                                    Descrição física
                                </label>

                                <p class="mt-1 text-sm text-amber-900/65">
                                    Descreva marcas, cicatrizes, postura, roupas e aparência geral.
                                </p>

                                <textarea
                                    id="description"
                                    name="description"
                                    rows="8"
                                    placeholder="Registre aqui os detalhes físicos do personagem..."
                                    class="mt-4 w-full rounded-lg border-amber-800/40 bg-amber-50/80 text-amber-950 shadow-inner placeholder:text-amber-800/40 focus:border-purple-800 focus:ring-purple-800"
                                >{{ old('description', $appearance->description ?? '') }}</textarea>
                            </section>
                        </main>
                    </div>

                    <div class="flex flex-col-reverse gap-3 border-t border-amber-900/30 pt-6 sm:flex-row sm:justify-end">
                        <a
                            href="{{ route('characters.appearance.show', $character) }}"
                            class="rounded-lg border border-stone-600 bg-stone-300 px-5 py-3 text-center font-serif font-bold text-stone-900 shadow transition hover:bg-stone-400"
                        >
                            Cancelar
                        </a>

                        <button
                            type="submit"
                            class="rounded-lg border border-amber-500/70 bg-gradient-to-r from-purple-950 via-purple-800 to-indigo-950 px-6 py-3 font-serif font-bold text-amber-200 shadow-lg transition hover:from-purple-900 hover:via-purple-700 hover:to-indigo-900"
                        >
                            Salvar aparência
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
