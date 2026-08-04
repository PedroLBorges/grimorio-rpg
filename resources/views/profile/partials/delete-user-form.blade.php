<section class="space-y-5">
    <header>
        <p class="font-serif text-xs uppercase tracking-[0.3em] text-red-300">
            Zona perigosa
        </p>

        <h2 class="mt-1 font-serif text-2xl font-bold text-red-50">
            Apagar registro do aventureiro
        </h2>

        <p class="mt-2 text-sm text-red-100/75">
            Ao excluir sua conta, todos os personagens, armas, magias,
            equipamentos e demais registros serão removidos permanentemente.
        </p>
    </header>

    <button
        type="button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="rounded-lg border border-red-400/50 bg-red-800 px-5 py-3 font-serif font-bold text-red-50 shadow transition hover:bg-red-700"
    >
        Excluir minha conta
    </button>

    <x-modal
        name="confirm-user-deletion"
        :show="$errors->userDeletion->isNotEmpty()"
        focusable
    >
        <form
            method="POST"
            action="{{ route('profile.destroy') }}"
            class="border-4 border-amber-900/50 p-6"
            style="
                background-color: #ead4a5;
                background-image:
                    radial-gradient(circle at 15% 20%, rgba(120, 53, 15, .10), transparent 20%),
                    radial-gradient(circle at 85% 80%, rgba(92, 51, 23, .10), transparent 22%),
                    linear-gradient(
                        rgba(255, 248, 220, .94),
                        rgba(232, 207, 164, .96)
                    );
            "
        >
            @csrf
            @method('DELETE')

            <p class="font-serif text-xs uppercase tracking-[0.3em] text-red-800">
                Confirmação final
            </p>

            <h2 class="mt-1 font-serif text-2xl font-bold text-amber-950">
                Tem certeza de que deseja apagar sua conta?
            </h2>

            <p class="mt-3 text-sm leading-relaxed text-amber-900/75">
                Esta ação é permanente. Todos os personagens, armas, magias,
                equipamentos, fichas e demais registros associados à sua conta
                serão removidos definitivamente.
            </p>

            <p class="mt-2 text-sm font-semibold text-red-800">
                Digite sua senha para confirmar a exclusão.
            </p>

            <div class="mt-6">
                <label
                    for="user_deletion_password"
                    class="block font-serif text-sm font-bold tracking-wide text-amber-950"
                >
                    Senha atual
                </label>

                <input
                    id="user_deletion_password"
                    name="password"
                    type="password"
                    autocomplete="current-password"
                    placeholder="Digite sua senha"
                    class="mt-1 block w-full rounded-lg border-amber-800/40 bg-amber-50/80 text-amber-950 shadow-inner placeholder:text-amber-800/40 focus:border-red-800 focus:ring-red-800"
                >

                @error('password', 'userDeletion')
                    <p class="mt-2 text-sm font-semibold text-red-800">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="rounded-lg border border-stone-600 bg-stone-300 px-5 py-3 font-serif font-bold text-stone-900 shadow transition hover:bg-stone-400"
                >
                    Cancelar
                </button>

                <button
                    type="submit"
                    class="rounded-lg border border-red-400/50 bg-red-800 px-5 py-3 font-serif font-bold text-red-50 shadow transition hover:bg-red-700"
                >
                    Excluir conta permanentemente
                </button>
            </div>
        </form>
    </x-modal>
</section>
