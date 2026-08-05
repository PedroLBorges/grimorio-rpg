<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="font-serif text-2xl font-bold text-amber-950">Registre um novo aventureiro</h2>
        <p class="mt-1 text-sm text-amber-900/70">Abra seu grimório e comece a escrever uma nova lenda.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="w-full space-y-4">
        @csrf

        <div>
            <label for="name" class="block font-serif text-sm font-bold text-amber-950">Nome do aventureiro</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="mt-1 block w-full rounded-lg border-amber-800/50 bg-amber-50/80 text-amber-950 shadow-inner focus:border-purple-700 focus:ring-purple-700">
            @error('name') <p class="mt-1 text-sm text-red-800">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="email" class="block font-serif text-sm font-bold text-amber-950">E-mail</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                class="mt-1 block w-full rounded-lg border-amber-800/50 bg-amber-50/80 text-amber-950 shadow-inner focus:border-purple-700 focus:ring-purple-700">
            @error('email') <p class="mt-1 text-sm text-red-800">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password" class="block font-serif text-sm font-bold text-amber-950">Palavra secreta</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="mt-1 block w-full rounded-lg border-amber-800/50 bg-amber-50/80 text-amber-950 shadow-inner focus:border-purple-700 focus:ring-purple-700">
            @error('password') <p class="mt-1 text-sm text-red-800">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block font-serif text-sm font-bold text-amber-950">Confirme a palavra secreta</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                class="mt-1 block w-full rounded-lg border-amber-800/50 bg-amber-50/80 text-amber-950 shadow-inner focus:border-purple-700 focus:ring-purple-700">
        </div>

        <button type="submit" class="w-full rounded-lg border border-amber-400/70 bg-gradient-to-r from-purple-950 via-purple-800 to-indigo-950 px-5 py-3 font-serif font-bold text-amber-200 shadow-lg hover:from-purple-900 hover:via-purple-700 hover:to-indigo-900">
            Criar meu grimório
        </button>

        <p class="border-t border-amber-800/25 pt-4 text-center text-sm text-amber-950/70">
            Já possui uma conta?
            <a href="{{ route('login') }}" class="font-serif font-bold text-purple-950 hover:text-purple-700 hover:underline">Retornar à jornada</a>
        </p>
    </form>
</x-guest-layout>
