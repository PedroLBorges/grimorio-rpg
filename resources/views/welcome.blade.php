<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Grimório-RPG</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased text-amber-100">
<main class="min-h-screen bg-[#120b18]" style="background-image:radial-gradient(circle at 50% 10%,rgba(111,59,168,.35),transparent 30%),linear-gradient(145deg,#120b18,#261133 52%,#09070d)">
    <nav class="border-b border-amber-500/30 bg-purple-950/80 shadow-xl">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4">
            <a href="/" class="flex items-center gap-3 font-serif text-lg font-bold text-amber-200"><img src="{{ asset('images/grimorio-logo.png') }}" alt="Grimório RPG" class="h-12 w-12 rounded-lg object-contain">Grimório RPG</a>
            <div class="flex gap-2">@auth<a href="{{ route('dashboard') }}" class="rounded-lg border border-amber-500/60 bg-amber-700 px-4 py-2 font-serif font-bold text-white">Abrir grimório</a>@else<a href="{{ route('login') }}" class="rounded-lg border border-amber-500/60 px-4 py-2 font-serif font-bold text-amber-200 hover:bg-purple-800">Login</a><a href="{{ route('register') }}" class="rounded-lg border border-amber-400/70 bg-amber-700 px-4 py-2 font-serif font-bold text-white">Criar conta</a>@endauth</div>
        </div>
    </nav>
    <section class="mx-auto grid max-w-7xl items-center gap-10 px-5 py-16 lg:grid-cols-2 lg:py-24">
        <div>
            <p class="font-serif text-sm font-bold uppercase tracking-[.3em] text-amber-400">Seu livro de aventuras</p>
            <h1 class="mt-4 font-serif text-5xl font-bold leading-tight text-amber-100 sm:text-6xl">Toda lenda merece ser registrada.</h1>
            <p class="mt-6 max-w-2xl text-lg leading-relaxed text-purple-100/80">O Grimório RPG é uma plataforma para criar, organizar e compartilhar fichas de RPG de mesa. Guarde atributos, vida, moedas, equipamentos, armas, magias, habilidades e a aparência de cada aventureiro em um só lugar.</p>
            <div class="mt-8 flex flex-wrap gap-3">@guest<a href="{{ route('register') }}" class="rounded-lg border border-amber-400/70 bg-gradient-to-r from-amber-800 to-amber-950 px-6 py-3 font-serif text-lg font-bold text-yellow-200 shadow-xl">Começar uma jornada</a><a href="{{ route('login') }}" class="rounded-lg border border-purple-300/30 bg-purple-900/60 px-6 py-3 font-serif text-lg font-bold text-purple-100">Continuar uma aventura</a>@else<a href="{{ route('characters.index') }}" class="rounded-lg border border-amber-400/70 bg-amber-800 px-6 py-3 font-serif text-lg font-bold text-yellow-200">Ver personagens</a>@endguest</div>
        </div>
        <div class="rounded-2xl border-4 border-amber-800/70 bg-[#ead4a5] p-7 text-amber-950 shadow-2xl" style="background-image:linear-gradient(rgba(255,248,220,.94),rgba(232,207,164,.96))">
            <p class="font-serif text-xs font-bold uppercase tracking-[.25em] text-amber-800">Capítulo inicial</p><h2 class="mt-2 font-serif text-3xl font-bold">Abra as páginas do seu grimório</h2>
            <div class="mt-5 space-y-4">
                <article class="rounded-xl border border-amber-800/30 bg-amber-50/50 p-4"><h3 class="font-serif text-lg font-bold">Crie fichas completas</h3><p class="mt-1 text-sm text-amber-900/75">Registre tudo o que define seus personagens e mantenha a ficha pronta para a próxima sessão.</p></article>
                <article class="rounded-xl border border-purple-900/25 bg-purple-50/40 p-4"><h3 class="font-serif text-lg font-bold">Compartilhe com seu grupo</h3><p class="mt-1 text-sm text-amber-900/75">Convide aliados como visualizadores ou editores sem abrir mão do controle da ficha.</p></article>
                <article class="rounded-xl border border-amber-800/30 bg-amber-50/50 p-4"><h3 class="font-serif text-lg font-bold">Construa histórias duradouras</h3><p class="mt-1 text-sm text-amber-900/75">Este é o primeiro capítulo de uma plataforma feita para campanhas, diários e aventuras compartilhadas.</p></article>
            </div>
        </div>
    </section>
    <footer class="border-t border-amber-500/20 px-5 py-6 text-center font-serif text-sm text-purple-200/60">Grimório RPG · Onde cada personagem ganha sua própria história.</footer>
</main>
</body></html>
