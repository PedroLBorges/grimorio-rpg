<nav class="border-b border-purple-950/40 bg-gradient-to-r from-purple-950 via-purple-900 to-indigo-950 shadow-lg">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">

            <!-- LOGO / ÍCONE -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3">

                    <img
                        src="{{ asset('images/grimorio-logo.png') }}"
                        alt="Grimório RPG"
                        class="h-12 w-12 rounded-lg object-contain transition duration-300 hover:scale-105"
                    />

                </a>
            </div>

            <!-- LOGOUT -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="rounded-lg border border-amber-400/60 bg-purple-800 px-4 py-2 font-serif text-sm font-bold text-amber-200 shadow transition hover:bg-purple-700"
                >
                    Logout
                </button>
            </form>

        </div>
    </div>
</nav>
