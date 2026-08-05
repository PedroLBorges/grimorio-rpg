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
                        Aparência de {{ $character->name }}
                    </h2>

                    <p class="mt-1 text-sm text-amber-900/75">
                        Retrato e características preservados nas páginas do grimório.
                    </p>
                </div>

                <div class="flex flex-wrap gap-2">
                    @if ($character->canEdit(auth()->user()))
                    <a
                        href="{{ route('characters.appearance.edit', $character) }}"
                        class="rounded-lg border border-amber-500/70 bg-gradient-to-r from-purple-950 via-purple-800 to-indigo-950 px-4 py-2 text-center font-serif text-sm font-bold text-amber-200 shadow transition hover:from-purple-900 hover:via-purple-700 hover:to-indigo-900"
                    >
                        Editar aparência
                    </a>
                    @endif

                    <a
                        href="{{ route('characters.show', $character) }}"
                        class="rounded-lg border border-amber-800 bg-amber-700 px-4 py-2 text-center font-serif text-sm font-bold text-white shadow transition hover:bg-amber-800"
                    >
                        Voltar à ficha
                    </a>
                </div>
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
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-5 rounded-lg border border-green-800/30 bg-green-100 p-4 text-green-900 shadow">
                    {{ session('success') }}
                </div>
            @endif

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
                <div class="grid grid-cols-1 gap-8 lg:grid-cols-[300px_1fr]">

                    <!-- Retrato -->
                    <aside>
                        <div class="rounded-xl border border-amber-800/30 bg-amber-50/45 p-4 shadow-sm">
                            @if ($hasPhoto)
                                <img
                                    src="{{ asset('storage/' . $character->photo_path) }}"
                                    alt="Retrato de {{ $character->name }}"
                                    class="mx-auto h-96 w-full rounded-xl border-4 border-amber-900/55 object-cover shadow-xl"
                                >
                            @else
                                <div
                                    class="flex h-96 items-center justify-center rounded-xl border-4 border-dashed border-amber-900/35 bg-amber-100/40 p-6 text-center"
                                >
                                    <div>
                                        <p class="font-serif text-xl font-bold text-amber-950">
                                            Sem retrato
                                        </p>

                                        <p class="mt-2 text-sm text-amber-900/65">
                                            O personagem ainda não possui uma imagem cadastrada.
                                        </p>
                                    </div>
                                </div>
                            @endif

                            <div class="mt-4 text-center">
                                <p class="font-serif text-2xl font-bold text-amber-950">
                                    {{ $character->name }}
                                </p>

                                <p class="mt-1 text-sm text-amber-900/70">
                                    {{ $character->race }} • {{ $character->class }}
                                </p>
                            </div>
                        </div>
                    </aside>

                    <!-- Informações -->
                    <main class="space-y-6">
                        <section class="rounded-xl border border-amber-800/30 bg-amber-50/45 p-5 shadow-sm">
                            <header class="mb-5">
                                <p class="font-serif text-xs uppercase tracking-[0.3em] text-amber-800">
                                    Características físicas
                                </p>

                                <h3 class="font-serif text-2xl font-bold text-amber-950">
                                    Registro do aventureiro
                                </h3>

                                <div class="mt-3 h-px bg-amber-800/30"></div>
                            </header>

                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
                                @foreach([
                                    'Altura' => $appearance->height ?? null,
                                    'Peso' => $appearance->weight ?? null,
                                    'Olhos' => $appearance->eyes ?? null,
                                    'Cabelo' => $appearance->hair ?? null,
                                    'Pele' => $appearance->skin ?? null,
                                ] as $label => $value)
                                    <div class="rounded-xl border border-amber-800/30 bg-[#d8b982] p-4 shadow-sm">
                                        <p class="text-xs font-bold uppercase tracking-wide text-amber-800">
                                            {{ $label }}
                                        </p>

                                        <p class="mt-1 font-serif text-lg font-bold text-amber-950">
                                            {{ $value ?: 'Não informado' }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </section>

                        <section class="rounded-xl border border-amber-800/30 bg-amber-50/45 p-5 shadow-sm">
                            <header>
                                <p class="font-serif text-xs uppercase tracking-[0.3em] text-amber-800">
                                    Descrição
                                </p>

                                <h3 class="mt-1 font-serif text-2xl font-bold text-amber-950">
                                    Aparência geral
                                </h3>

                                <div class="mt-3 h-px bg-amber-800/30"></div>
                            </header>

                            <div class="mt-5 rounded-xl border-l-4 border-purple-900 bg-amber-50/60 p-5">
                                <p class="whitespace-pre-line leading-relaxed text-amber-950">
                                    {{ $appearance->description ?? 'Nenhuma descrição física cadastrada.' }}
                                </p>
                            </div>
                        </section>

                        <div class="flex flex-col-reverse gap-3 border-t border-amber-900/25 pt-5 sm:flex-row sm:justify-end">
                            <a
                                href="{{ route('characters.show', $character) }}"
                                class="rounded-lg border border-stone-600 bg-stone-300 px-5 py-3 text-center font-serif font-bold text-stone-900 shadow transition hover:bg-stone-400"
                            >
                                Voltar à ficha
                            </a>

                            @if ($character->canEdit(auth()->user()))
                            <a
                                href="{{ route('characters.appearance.edit', $character) }}"
                                class="rounded-lg border border-amber-500/70 bg-gradient-to-r from-purple-950 via-purple-800 to-indigo-950 px-5 py-3 text-center font-serif font-bold text-amber-200 shadow-lg transition hover:from-purple-900 hover:via-purple-700 hover:to-indigo-900"
                            >
                                Editar aparência
                            </a>
                            @endif
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
