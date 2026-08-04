<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="font-serif text-2xl font-bold text-amber-950">
            Retorne à sua jornada
        </h2>

        <p class="mt-1 text-sm text-amber-900/70">
            Entre para consultar seus personagens e aventuras.
        </p>
    </div>

    <x-auth-session-status
        class="mb-4 rounded-lg border border-green-700/30 bg-green-100 p-3 text-sm text-green-800"
        :status="session('status')"
    />

    <form
        method="POST"
        action="{{ route('login') }}"
        class="space-y-5"
        id="login-form"
    >
        @csrf

        <div>
            <label for="email" class="block font-serif text-sm font-bold text-amber-950">
                E-mail do aventureiro
            </label>

            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="seu@email.com"
                class="mt-1 block w-full rounded-lg border-amber-800/50 bg-amber-50/80 text-amber-950 shadow-inner placeholder:text-amber-800/40 focus:border-purple-700 focus:ring-purple-700"
            >

            @error('email')
                <p class="mt-1 text-sm text-red-800">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block font-serif text-sm font-bold text-amber-950">
                Palavra secreta
            </label>

            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Digite sua senha"
                class="mt-1 block w-full rounded-lg border-amber-800/50 bg-amber-50/80 text-amber-950 shadow-inner placeholder:text-amber-800/40 focus:border-purple-700 focus:ring-purple-700"
            >

            @error('password')
                <p class="mt-1 text-sm text-red-800">{{ $message }}</p>
            @enderror
        </div>

        <label class="flex cursor-pointer items-center gap-2 text-sm text-amber-950">
            <input
                id="remember_me"
                type="checkbox"
                name="remember"
                class="rounded border-amber-700 bg-amber-50 text-purple-800 shadow-sm focus:ring-purple-700"
            >

            <span>Lembrar meu acesso</span>
        </label>

        <button
            type="submit"
            id="login-button"
            class="w-full rounded-lg border border-amber-400/70 bg-gradient-to-r from-purple-950 via-purple-800 to-indigo-950 px-5 py-3 font-serif font-bold tracking-wide text-amber-200 shadow-lg transition hover:from-purple-900 hover:via-purple-700 hover:to-indigo-900 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2"
        >
            Entrar no Grimório
        </button>

        <div class="space-y-2 border-t border-amber-800/25 pt-4 text-center text-sm">
            @if (Route::has('password.request'))
                <a
                    href="{{ route('password.request') }}"
                    class="block font-semibold text-purple-900 hover:text-purple-700 hover:underline"
                >
                    Esqueceu sua palavra secreta?
                </a>
            @endif

            @if (Route::has('register'))
                <p class="text-amber-950/70">
                    Ainda não possui uma conta?
                </p>

                <a
                    href="{{ route('register') }}"
                    class="inline-block font-serif font-bold text-purple-950 hover:text-purple-700 hover:underline"
                >
                    Cadastrar novo aventureiro
                </a>
            @endif
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('login-form');
            const button = document.getElementById('login-button');

            form?.addEventListener('submit', () => {
                button.disabled = true;
                button.textContent = 'Abrindo o Grimório...';
                button.classList.add('cursor-wait', 'opacity-80');
            });
        });
    </script>
</x-guest-layout>
