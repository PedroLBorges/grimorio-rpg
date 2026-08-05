<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <meta name="csrf-token" content="{{ csrf_token() }}">

            <title>Grimório-RPG</title>

            <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

            @vite(['resources/css/app.css', 'resources/js/app.js'])
        </head>

        <body class="font-sans antialiased">
            <main
                class="relative flex min-h-screen items-center justify-center overflow-hidden px-4 py-10"
                style="
                    background-color: #120b18;
                    background-image:
                        radial-gradient(circle at 50% 25%, rgba(111, 59, 168, 0.25), transparent 28%),
                        radial-gradient(circle at 15% 80%, rgba(66, 32, 88, 0.30), transparent 30%),
                        radial-gradient(circle at 85% 75%, rgba(33, 43, 88, 0.25), transparent 30%),
                        linear-gradient(145deg, #0d0911 0%, #181021 45%, #09070d 100%);
                "
            >
                <!-- Brilho mágico decorativo -->
                <div
                    class="pointer-events-none absolute h-96 w-96 rounded-full opacity-20 blur-3xl"
                    style="background: #7c3aed;"
                ></div>

                <!-- Estrutura principal do grimório -->
                <div class="relative z-10 w-full max-w-md">
                    <!-- Fecho superior decorativo -->
                    <div class="mx-auto h-3 w-28 rounded-t-lg border-x border-t border-amber-400/60 bg-amber-700 shadow-lg"></div>

                    <div
                        class="relative overflow-hidden rounded-2xl border-4 border-amber-700/70 px-6 py-8 shadow-2xl sm:px-9"
                        style="
                            background:
                                radial-gradient(circle at 20% 15%, rgba(255,255,255,0.08), transparent 22%),
                                radial-gradient(circle at 80% 85%, rgba(0,0,0,0.28), transparent 30%),
                                linear-gradient(145deg, #24102f 0%, #44205e 48%, #271238 100%);
                            box-shadow:
                                0 22px 60px rgba(0,0,0,.65),
                                inset 0 0 35px rgba(0,0,0,.35),
                                inset 0 0 0 2px rgba(229,192,95,.20);
                        "
                    >
                        <!-- Ornamentos dos cantos -->
                        <span class="absolute left-3 top-2 font-serif text-2xl text-amber-300">✦</span>
                        <span class="absolute right-3 top-2 font-serif text-2xl text-amber-300">✦</span>
                        <span class="absolute bottom-2 left-3 font-serif text-2xl text-amber-300">✦</span>
                        <span class="absolute bottom-2 right-3 font-serif text-2xl text-amber-300">✦</span>

                        <!-- Título do sistema -->
                        <div class="mb-6 text-center">

                            <img
                                src="{{ asset('images/grimorio-logo.png') }}"
                                alt="Grimório RPG"
                                class="h-24 w-24 object-contain drop-shadow-2xl"
                            >

                            <a href="/" class="inline-block">
                                <h1
                                    class="font-serif text-3xl font-bold uppercase tracking-[0.16em] text-amber-200"
                                    style="text-shadow: 0 0 12px rgba(245, 197, 90, .35);"
                                >
                                    Grimório RPG
                                </h1>
                            </a>

                            <p class="mt-2 font-serif text-sm italic text-purple-100/80">
                                Suas lendas permanecem registradas.
                            </p>
                        </div>

                        <!-- Página interna -->
                        <div
                            class="rounded-xl border border-amber-700/50 p-6 shadow-inner"
                            style="
                                background-color: #f3e5c5;
                                background-image:
                                    radial-gradient(circle at 15% 20%, rgba(120,53,15,.10), transparent 20%),
                                    radial-gradient(circle at 85% 80%, rgba(92,51,23,.10), transparent 22%),
                                    linear-gradient(rgba(255,248,220,.92), rgba(232,207,164,.94));
                            "
                        >
                            {{ $slot }}
                        </div>
                    </div>

                    <!-- Fecho inferior decorativo -->
                    <div class="mx-auto h-3 w-28 rounded-b-lg border-x border-b border-amber-400/60 bg-amber-700 shadow-lg"></div>

                    <p class="mt-5 text-center text-xs text-purple-200/60">
                        Grimório RPG
                    </p>
                </div>
            </main>
        </body>
    </html>
