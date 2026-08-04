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
                        Grimório RPG
                    </p>

                    <h2 class="font-serif text-3xl font-bold text-amber-950">
                        Personagens Registrados
                    </h2>

                    <p class="mt-1 text-sm text-amber-900/75">
                        Consulte as fichas preservadas nas páginas do seu grimório.
                    </p>
                </div>

                <a
                    href="{{ route('characters.create') }}"
                    class="rounded-lg border border-amber-500/70 bg-gradient-to-r from-purple-950 via-purple-800 to-indigo-950 px-5 py-3 text-center font-serif font-bold text-amber-200 shadow-lg transition hover:from-purple-900 hover:via-purple-700 hover:to-indigo-900"
                >
                    Registrar personagem
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
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-5 rounded-lg border border-green-800/30 bg-green-100 p-4 text-green-900 shadow">
                    {{ session('success') }}
                </div>
            @endif

            <div
                class="relative overflow-hidden rounded-2xl border-4 border-amber-900/60 p-6 shadow-2xl sm:p-8"
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
                <div class="mb-7 text-center">
                    <p class="font-serif text-xs uppercase tracking-[0.3em] text-amber-800">
                        Índice de aventureiros
                    </p>

                    <h3 class="mt-1 font-serif text-2xl font-bold text-amber-950">
                        Fichas do Grimório
                    </h3>

                    <div class="mx-auto mt-3 h-px w-40 bg-amber-800/50"></div>
                </div>

                @forelse ($characters as $character)
                    <article
                        class="group mb-4 rounded-xl border border-amber-900/30 bg-amber-50/55 p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-amber-900/60 hover:bg-amber-100/75 hover:shadow-md"
                    >
                        <div class="flex flex-col gap-5 md:flex-row md:items-center md:justify-between">
                            <div class="min-w-0">
                                <div class="flex flex-wrap items-center gap-3">
                                    <h4 class="font-serif text-2xl font-bold text-amber-950">
                                        {{ $character->name }}
                                    </h4>

                                    <span
                                        class="rounded-full border border-amber-800/30 bg-amber-200/70 px-3 py-1 text-xs font-bold uppercase tracking-wide text-amber-950"
                                    >
                                        Nível {{ $character->level }}
                                    </span>
                                </div>

                                <div class="mt-3 grid grid-cols-1 gap-x-6 gap-y-2 text-sm text-amber-950 sm:grid-cols-2 lg:grid-cols-4">
                                    <p>
                                        <span class="font-serif font-bold text-amber-900">Classe:</span>
                                        {{ $character->class }}
                                    </p>

                                    <p>
                                        <span class="font-serif font-bold text-amber-900">Raça:</span>
                                        {{ $character->race }}
                                    </p>

                                    <p>
                                        <span class="font-serif font-bold text-amber-900">Antecedente:</span>
                                        {{ $character->background ?: '—' }}
                                    </p>

                                    <p>
                                        <span class="font-serif font-bold text-amber-900">Tendência:</span>
                                        {{ $character->alignment ?: '—' }}
                                    </p>
                                </div>

                                <p class="mt-3 line-clamp-2 text-sm italic text-amber-900/70">
                                    {{ $character->backstory ?: 'Nenhuma história registrada para este personagem.' }}
                                </p>
                            </div>

                            <div class="flex shrink-0 flex-wrap gap-2">
                                <a
                                    href="{{ route('characters.show', $character) }}"
                                    class="rounded-lg border border-amber-900 bg-gradient-to-r from-amber-800 to-amber-950 px-4 py-2 font-serif font-bold text-yellow-200 shadow transition hover:from-amber-700 hover:to-amber-900"
                                >
                                    Abrir ficha
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('characters.destroy', $character) }}"
                                    onsubmit="return confirm('Deseja realmente remover esta ficha do grimório?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="rounded-lg border border-red-900/50 bg-red-950 px-4 py-2 font-serif font-bold text-red-100 shadow transition hover:bg-red-900"
                                    >
                                        Remover
                                    </button>
                                </form>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="rounded-xl border border-dashed border-amber-900/40 bg-amber-50/50 p-10 text-center">
                        <p class="font-serif text-2xl font-bold text-amber-950">
                            Nenhum personagem registrado
                        </p>

                        <p class="mx-auto mt-2 max-w-lg text-sm text-amber-900/70">
                            As páginas deste capítulo ainda estão vazias. Registre seu primeiro aventureiro para começar uma nova jornada.
                        </p>

                        <a
                            href="{{ route('characters.create') }}"
                            class="mt-5 inline-block rounded-lg border border-amber-500/70 bg-gradient-to-r from-purple-950 via-purple-800 to-indigo-950 px-5 py-3 font-serif font-bold text-amber-200 shadow-lg transition hover:from-purple-900 hover:via-purple-700 hover:to-indigo-900"
                        >
                            Criar primeiro personagem
                        </a>
                    </div>
                @endforelse

                <div class="mt-7 flex flex-col gap-3 border-t border-amber-900/25 pt-5 sm:flex-row sm:items-center sm:justify-between">
                    <p class="font-serif text-sm italic text-amber-900/65">
                        Cada ficha representa uma história ainda em construção.
                    </p>

                    <a
                        href="{{ route('dashboard') }}"
                        class="font-serif text-sm font-bold text-purple-950 hover:text-purple-700 hover:underline"
                    >
                        Voltar ao sumário
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
