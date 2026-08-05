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
            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="font-serif text-sm uppercase tracking-[0.25em] text-amber-800">
                        Grimório RPG
                    </p>

                    <h2 class="font-serif text-3xl font-bold text-amber-950">
                        Sumário
                    </h2>

                    <p class="mt-1 text-sm text-amber-900/75">
                        Bem-vindo, {{ Auth::user()->name }}. Escolha o próximo capítulo da sua jornada.
                    </p>
                </div>

                <div
                    class="rounded-full border border-amber-800/40 bg-amber-200/60 px-4 py-2 font-serif text-sm font-semibold text-amber-950"
                >
                    Aventureiro registrado
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

            <!-- Livro aberto -->
            <div
                class="relative overflow-hidden rounded-2xl border-4 border-amber-900/60 shadow-2xl"
                style="
                    background:
                        linear-gradient(
                            90deg,
                            #ead4a5 0%,
                            #f5e7c5 47%,
                            #c9a875 50%,
                            #f5e7c5 53%,
                            #ead4a5 100%
                        );
                "
            >
                <!-- Dobra central -->
                <div
                    class="pointer-events-none absolute inset-y-0 left-1/2 w-5 -translate-x-1/2"
                    style="
                        background:
                            linear-gradient(
                                90deg,
                                transparent,
                                rgba(87, 52, 24, .22),
                                rgba(255, 255, 255, .24),
                                transparent
                            );
                    "
                ></div>

                <div class="relative grid grid-cols-1 gap-0 lg:grid-cols-2">

                    <!-- Página esquerda -->
                    <section class="border-b border-amber-900/20 p-7 lg:border-b-0 lg:border-r">
                        <div class="mb-6 text-center">
                            <h3 class="font-serif text-2xl font-bold text-amber-950">
                                Personagens
                            </h3>

                            <div class="mx-auto mt-3 h-px w-32 bg-amber-800/50"></div>
                        </div>

                        <nav class="space-y-3">
                            <a
                                href="{{ route('characters.index') }}"
                                class="group flex items-center justify-between rounded-lg border border-amber-800/30 bg-amber-50/50 px-4 py-4 transition hover:border-amber-800/60 hover:bg-amber-100"
                            >
                                <div>
                                    <p class="font-serif text-lg font-bold text-amber-950">
                                        Minhas fichas
                                    </p>

                                    <p class="mt-1 text-sm text-amber-900/70">
                                        Consulte os personagens já registrados.
                                    </p>
                                </div>

                                <span class="ml-4 font-serif text-xl text-amber-800 transition group-hover:translate-x-1">
                                    01
                                </span>
                            </a>

                            <a
                                href="{{ route('characters.create') }}"
                                class="group flex items-center justify-between rounded-lg border border-amber-800/30 bg-amber-50/50 px-4 py-4 transition hover:border-amber-800/60 hover:bg-amber-100"
                            >
                                <div>
                                    <p class="font-serif text-lg font-bold text-amber-950">
                                        Criar personagem
                                    </p>

                                    <p class="mt-1 text-sm text-amber-900/70">
                                        Inicie uma nova ficha de aventureiro.
                                    </p>
                                </div>

                                <span class="ml-4 font-serif text-xl text-amber-800 transition group-hover:translate-x-1">
                                    02
                                </span>
                            </a>
                        </nav>

                        <div class="mt-8 rounded-xl border border-amber-800/30 bg-amber-100/50 p-5">
                            <p class="font-serif text-sm font-bold uppercase tracking-wide text-amber-900">
                                Registro do jogador
                            </p>

                            <p class="mt-2 text-sm text-amber-950">
                                Nome: {{ Auth::user()->name }}
                            </p>

                            <p class="mt-1 text-sm text-amber-950">
                                E-mail: {{ Auth::user()->email }}
                            </p>
                        </div>
                    </section>

                    <!-- Página direita -->
                    <section class="p-7">
                        <div class="mb-6 text-center">
                            <h3 class="font-serif text-2xl font-bold text-amber-950">
                                Conta e navegação
                            </h3>

                            <div class="mx-auto mt-3 h-px w-32 bg-amber-800/50"></div>
                        </div>

                        <nav class="space-y-3">
                            <a
                                href="{{ route('profile.edit') }}"
                                class="group flex items-center justify-between rounded-lg border border-amber-800/30 bg-amber-50/50 px-4 py-4 transition hover:border-amber-800/60 hover:bg-amber-100"
                            >
                                <div>
                                    <p class="font-serif text-lg font-bold text-amber-950">
                                        Perfil do aventureiro
                                    </p>

                                    <p class="mt-1 text-sm text-amber-900/70">
                                        Atualize seus dados, e-mail ou senha.
                                    </p>
                                </div>

                                <span class="ml-4 font-serif text-xl text-amber-800 transition group-hover:translate-x-1">
                                    03
                                </span>
                            </a>

                            <a
                                href="{{ route('session-notes.index') }}"
                                class="group flex items-center justify-between rounded-lg border border-amber-800/30 bg-amber-50/50 px-4 py-4 transition hover:border-amber-800/60 hover:bg-amber-100"
                            >
                                <div>
                                    <p class="font-serif text-lg font-bold text-amber-950">
                                        Diário de sessão
                                    </p>

                                    <p class="mt-1 text-sm text-amber-900/70">
                                        Registre e consulte as memórias de cada aventura.
                                    </p>
                                </div>

                                <span class="ml-4 font-serif text-xl text-amber-800 transition group-hover:translate-x-1">
                                    04
                                </span>
                            </a>

                        </nav>

                        <blockquote class="mt-8 border-l-4 border-amber-800/50 pl-4 font-serif italic text-amber-950/75">
                            “Toda grande aventura começa com uma página ainda não escrita.”
                        </blockquote>
                    </section>
                </div>

                <!-- Rodapé do livro -->
                <div class="border-t border-amber-900/25 px-6 py-3 text-center">
                    <p class="font-serif text-xs uppercase tracking-[0.25em] text-amber-900/65">
                        Grimório RPG • Sumário do aventureiro
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
