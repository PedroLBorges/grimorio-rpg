<section>
    <header class="mb-6">
        <p class="font-serif text-xs uppercase tracking-[0.3em] text-amber-800">
            Registro do aventureiro
        </p>

        <h2 class="mt-1 font-serif text-2xl font-bold text-amber-950">
            Informações do perfil
        </h2>

        <p class="mt-2 text-sm text-amber-900/70">
            Atualize seu nome e o endereço de e-mail utilizado para acessar o grimório.
        </p>

        <div class="mt-4 h-px w-full bg-amber-800/30"></div>
    </header>

    <form
        id="send-verification"
        method="POST"
        action="{{ route('verification.send') }}"
    >
        @csrf
    </form>

    <form
        method="POST"
        action="{{ route('profile.update') }}"
        class="space-y-5"
    >
        @csrf
        @method('PATCH')

        <div>
            <label
                for="name"
                class="block font-serif text-sm font-bold tracking-wide text-amber-950"
            >
                Nome do aventureiro
            </label>

            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
                class="mt-1 block w-full rounded-lg border-amber-800/40 bg-amber-50/75 text-amber-950 shadow-inner focus:border-purple-800 focus:ring-purple-800"
            >

            @error('name')
                <p class="mt-2 text-sm font-semibold text-red-800">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label
                for="email"
                class="block font-serif text-sm font-bold tracking-wide text-amber-950"
            >
                E-mail
            </label>

            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
                class="mt-1 block w-full rounded-lg border-amber-800/40 bg-amber-50/75 text-amber-950 shadow-inner focus:border-purple-800 focus:ring-purple-800"
            >

            @error('email')
                <p class="mt-2 text-sm font-semibold text-red-800">
                    {{ $message }}
                </p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 rounded-lg border border-amber-800/30 bg-amber-100/70 p-3">
                    <p class="text-sm text-amber-950">
                        Seu endereço de e-mail ainda não foi verificado.

                        <button
                            form="send-verification"
                            class="ml-1 font-bold text-purple-900 underline hover:text-purple-700"
                        >
                            Reenviar mensagem de verificação
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-semibold text-green-800">
                            Um novo link de verificação foi enviado.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex flex-wrap items-center gap-4">
            <button
                type="submit"
                class="rounded-lg border border-amber-500/70 bg-gradient-to-r from-purple-950 via-purple-800 to-indigo-950 px-5 py-3 font-serif font-bold text-amber-200 shadow-lg transition hover:from-purple-900 hover:via-purple-700 hover:to-indigo-900"
            >
                Salvar informações
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    class="text-sm font-semibold text-green-800"
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                >
                    Informações salvas.
                </p>
            @endif
        </div>
    </form>
</section>
