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
                        Perfil do Aventureiro
                    </h2>

                    <p class="mt-1 text-sm text-amber-900/75">
                        Gerencie seus dados de acesso e as informações da sua conta.
                    </p>
                </div>

                <a
                    href="{{ route('dashboard') }}"
                    class="rounded-lg border border-amber-800 bg-amber-700 px-4 py-2 text-center font-serif text-sm font-bold text-white shadow transition hover:bg-amber-800"
                >
                    Voltar ao sumário
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
        <div class="mx-auto max-w-6xl space-y-6 px-4 sm:px-6 lg:px-8">

            <!-- Dados pessoais -->
            <section
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
                <div class="mx-auto max-w-2xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </section>

            <!-- Senha -->
            <section
                class="rounded-2xl border-4 border-amber-900/60 p-6 shadow-2xl sm:p-8"
                style="
                    background-color: #ead4a5;
                    background-image:
                        radial-gradient(circle at 85% 20%, rgba(120, 53, 15, .10), transparent 19%),
                        radial-gradient(circle at 18% 80%, rgba(92, 51, 23, .12), transparent 22%),
                        linear-gradient(
                            rgba(255, 248, 220, .92),
                            rgba(232, 207, 164, .95)
                        );
                "
            >
                <div class="mx-auto max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </section>

            <!-- Exclusão -->
            <section
                class="rounded-2xl border-4 border-red-950/50 bg-red-950/90 p-6 text-red-50 shadow-2xl sm:p-8"
            >
                <div class="mx-auto max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </section>

        </div>
    </div>
</x-app-layout>
