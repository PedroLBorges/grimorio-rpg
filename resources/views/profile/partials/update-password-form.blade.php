<section>
    <header class="mb-6">
        <p class="font-serif text-xs uppercase tracking-[0.3em] text-amber-800">
            Proteção arcana
        </p>

        <h2 class="mt-1 font-serif text-2xl font-bold text-amber-950">
            Alterar palavra secreta
        </h2>

        <p class="mt-2 text-sm text-amber-900/70">
            Utilize uma senha longa e segura para proteger as páginas do seu grimório.
        </p>

        <div class="mt-4 h-px w-full bg-amber-800/30"></div>
    </header>

    <form
        method="POST"
        action="{{ route('password.update') }}"
        class="space-y-5"
    >
        @csrf
        @method('PUT')

        <div>
            <label
                for="update_password_current_password"
                class="block font-serif text-sm font-bold tracking-wide text-amber-950"
            >
                Senha atual
            </label>

            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                class="mt-1 block w-full rounded-lg border-amber-800/40 bg-amber-50/75 text-amber-950 shadow-inner focus:border-purple-800 focus:ring-purple-800"
            >

            @error('current_password', 'updatePassword')
                <p class="mt-2 text-sm font-semibold text-red-800">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label
                for="update_password_password"
                class="block font-serif text-sm font-bold tracking-wide text-amber-950"
            >
                Nova senha
            </label>

            <input
                id="update_password_password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="mt-1 block w-full rounded-lg border-amber-800/40 bg-amber-50/75 text-amber-950 shadow-inner focus:border-purple-800 focus:ring-purple-800"
            >

            @error('password', 'updatePassword')
                <p class="mt-2 text-sm font-semibold text-red-800">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label
                for="update_password_password_confirmation"
                class="block font-serif text-sm font-bold tracking-wide text-amber-950"
            >
                Confirmar nova senha
            </label>

            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="mt-1 block w-full rounded-lg border-amber-800/40 bg-amber-50/75 text-amber-950 shadow-inner focus:border-purple-800 focus:ring-purple-800"
            >

            @error('password_confirmation', 'updatePassword')
                <p class="mt-2 text-sm font-semibold text-red-800">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="flex flex-wrap items-center gap-4">
            <button
                type="submit"
                class="rounded-lg border border-amber-500/70 bg-gradient-to-r from-purple-950 via-purple-800 to-indigo-950 px-5 py-3 font-serif font-bold text-amber-200 shadow-lg transition hover:from-purple-900 hover:via-purple-700 hover:to-indigo-900"
            >
                Alterar senha
            </button>

            @if (session('status') === 'password-updated')
                <p
                    class="text-sm font-semibold text-green-800"
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                >
                    Palavra secreta atualizada.
                </p>
            @endif
        </div>
    </form>
</section>
