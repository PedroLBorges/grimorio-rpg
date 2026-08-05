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
                        Gestão de acesso
                    </p>

                    <h2 class="font-serif text-3xl font-bold text-amber-950">
                        Compartilhar {{ $character->name }}
                    </h2>

                    <p class="mt-1 text-sm text-amber-900/75">
                        Conceda acesso à ficha para outros aventureiros cadastrados.
                    </p>
                </div>

                <a
                    href="{{ route('characters.show', $character) }}"
                    class="rounded-lg border border-amber-800 bg-amber-700 px-4 py-2 text-center font-serif text-sm font-bold text-white shadow transition hover:bg-amber-800"
                >
                    Voltar à ficha
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

            @if ($errors->any())
                <div class="mb-5 rounded-lg border border-red-800/30 bg-red-100 p-4 text-red-900 shadow">
                    <p class="font-serif font-bold">
                        Não foi possível concluir a operação.
                    </p>

                    <ul class="mt-2 list-inside list-disc text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
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
                <div class="grid grid-cols-1 gap-8 lg:grid-cols-[1fr_1.2fr]">

                    <!-- Novo compartilhamento -->
                    <section class="rounded-xl border border-amber-800/30 bg-amber-50/45 p-5 shadow-sm">
                        <header class="mb-5">
                            <p class="font-serif text-xs uppercase tracking-[0.3em] text-amber-800">
                                Novo acesso
                            </p>

                            <h3 class="font-serif text-2xl font-bold text-amber-950">
                                Compartilhar personagem
                            </h3>

                            <p class="mt-2 text-sm text-amber-900/70">
                                Informe o e-mail de um usuário já cadastrado no Grimório.
                            </p>

                            <div class="mt-4 h-px bg-amber-800/30"></div>
                        </header>

                        <form
                            method="POST"
                            action="{{ route('characters.sharing.store', $character) }}"
                            class="space-y-5"
                        >
                            @csrf

                            <div>
                                <label
                                    for="email"
                                    class="block font-serif text-sm font-bold text-amber-950"
                                >
                                    E-mail do usuário
                                </label>

                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="email"
                                    placeholder="aventureiro@email.com"
                                    class="mt-1 w-full rounded-lg border-amber-800/40 bg-amber-50/80 text-amber-950 shadow-inner placeholder:text-amber-800/40 focus:border-purple-800 focus:ring-purple-800"
                                >
                            </div>

                            <div>
                                <p class="block font-serif text-sm font-bold text-amber-950">
                                    Permissão
                                </p>

                                <div class="mt-2 space-y-3">
                                    <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-amber-800/30 bg-amber-100/55 p-4 transition hover:bg-amber-200/60">
                                        <input
                                            type="radio"
                                            name="permission"
                                            value="view"
                                            {{ old('permission', 'view') === 'view' ? 'checked' : '' }}
                                            class="mt-1 border-amber-700 bg-amber-50 text-purple-800 focus:ring-purple-700"
                                        >

                                        <span>
                                            <span class="block font-serif font-bold text-amber-950">
                                                Somente visualizar
                                            </span>

                                            <span class="mt-1 block text-sm text-amber-900/70">
                                                O usuário poderá consultar a ficha, mas não poderá alterar seus dados.
                                            </span>
                                        </span>
                                    </label>

                                    <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-red-900/30 bg-red-100/45 p-4 transition hover:bg-red-100/70">
                                        <input
                                            type="radio"
                                            name="permission"
                                            value="transfer"
                                            {{ old('permission') === 'transfer' ? 'checked' : '' }}
                                            class="mt-1 border-red-800 bg-amber-50 text-red-900 focus:ring-red-800"
                                        >
                                        <span>
                                            <span class="block font-serif font-bold text-red-950">Transferir propriedade</span>
                                            <span class="mt-1 block text-sm text-red-900/75">O destinatário se tornará proprietário e você perderá o acesso à ficha. Os demais compartilhamentos serão mantidos.</span>
                                        </span>
                                    </label>

                                    <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-amber-800/30 bg-amber-100/55 p-4 transition hover:bg-amber-200/60">
                                        <input
                                            type="radio"
                                            name="permission"
                                            value="edit"
                                            {{ old('permission') === 'edit' ? 'checked' : '' }}
                                            class="mt-1 border-amber-700 bg-amber-50 text-purple-800 focus:ring-purple-700"
                                        >

                                        <span>
                                            <span class="block font-serif font-bold text-amber-950">
                                                Pode editar
                                            </span>

                                            <span class="mt-1 block text-sm text-amber-900/70">
                                                O usuário poderá visualizar e editar a ficha, sem controlar compartilhamentos ou excluir o personagem.
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <button
                                type="submit"
                                class="w-full rounded-lg border border-amber-500/70 bg-gradient-to-r from-purple-950 via-purple-800 to-indigo-950 px-5 py-3 font-serif font-bold text-amber-200 shadow-lg transition hover:from-purple-900 hover:via-purple-700 hover:to-indigo-900"
                            >
                                Compartilhar ficha
                            </button>
                        </form>
                    </section>

                    <!-- Acessos existentes -->
                    <section class="rounded-xl border border-amber-800/30 bg-amber-50/45 p-5 shadow-sm">
                        <header class="mb-5">
                            <p class="font-serif text-xs uppercase tracking-[0.3em] text-amber-800">
                                Acessos concedidos
                            </p>

                            <h3 class="font-serif text-2xl font-bold text-amber-950">
                                Compartilhado com
                            </h3>

                            <p class="mt-2 text-sm text-amber-900/70">
                                Altere permissões ou revogue acessos existentes.
                            </p>

                            <div class="mt-4 h-px bg-amber-800/30"></div>
                        </header>

                        <div class="space-y-4">
                            @forelse ($character->shares as $share)
                                <article class="rounded-xl border border-amber-800/30 bg-amber-100/60 p-4 shadow-sm">
                                    <div class="flex flex-col gap-4">
                                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                            <div>
                                                <div class="flex flex-wrap items-center gap-2">
                                                    <p class="font-serif text-lg font-bold text-amber-950">
                                                        {{ $share->user->name }}
                                                    </p>

                                                    <span
                                                        class="rounded-full px-3 py-1 text-xs font-bold uppercase tracking-wide
                                                            {{ $share->permission === 'edit'
                                                                ? 'border border-purple-800/40 bg-purple-100 text-purple-950'
                                                                : 'border border-amber-800/30 bg-amber-200/70 text-amber-950' }}"
                                                    >
                                                        {{ $share->permission === 'edit' ? 'Editor' : 'Visualizador' }}
                                                    </span>
                                                </div>

                                                <p class="mt-1 text-sm text-amber-900/70">
                                                    {{ $share->user->email }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 gap-3 md:grid-cols-[1fr_auto]">
                                            <form
                                                method="POST"
                                                action="{{ route('characters.sharing.update', [$character, $share]) }}"
                                                class="flex flex-col gap-2 sm:flex-row"
                                            >
                                                @csrf
                                                @method('PUT')

                                                <select
                                                    name="permission"
                                                    class="w-full rounded-lg border-amber-800/40 bg-amber-50/80 text-amber-950 shadow-inner focus:border-purple-800 focus:ring-purple-800"
                                                >
                                                    <option
                                                        value="view"
                                                        {{ $share->permission === 'view' ? 'selected' : '' }}
                                                    >
                                                        Somente visualizar
                                                    </option>

                                                    <option
                                                        value="edit"
                                                        {{ $share->permission === 'edit' ? 'selected' : '' }}
                                                    >
                                                        Pode editar
                                                    </option>
                                                </select>

                                                <button
                                                    type="submit"
                                                    class="rounded-lg border border-amber-800 bg-amber-700 px-4 py-2 font-serif text-sm font-bold text-white shadow transition hover:bg-amber-800"
                                                >
                                                    Atualizar
                                                </button>
                                            </form>

                                            <form
                                                method="POST"
                                                action="{{ route('characters.sharing.destroy', [$character, $share]) }}"
                                                onsubmit="return confirm('Deseja realmente revogar o acesso deste usuário?')"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="w-full rounded-lg border border-red-900/50 bg-red-900 px-4 py-2 font-serif text-sm font-bold text-red-50 shadow transition hover:bg-red-800 md:w-auto"
                                                >
                                                    Revogar acesso
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </article>
                            @empty
                                <div class="rounded-xl border border-dashed border-amber-900/40 bg-amber-50/50 p-8 text-center">
                                    <p class="font-serif text-xl font-bold text-amber-950">
                                        Nenhum acesso compartilhado
                                    </p>

                                    <p class="mx-auto mt-2 max-w-md text-sm text-amber-900/70">
                                        Esta ficha ainda pertence exclusivamente a você.
                                    </p>
                                </div>
                            @endforelse
                        </div>
                    </section>
                </div>

                <div class="mt-8 border-t border-amber-900/25 pt-5">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <p class="font-serif text-sm italic text-amber-900/65">
                            Somente o proprietário pode controlar os acessos desta ficha.
                        </p>

                        <a
                            href="{{ route('characters.show', $character) }}"
                            class="font-serif text-sm font-bold text-purple-950 hover:text-purple-700 hover:underline"
                        >
                            Retornar ao personagem
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
