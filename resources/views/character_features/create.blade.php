<x-app-layout>
    <x-slot name="header">
        <div class="rounded-xl border border-amber-700/40 bg-amber-100 shadow-md p-4"
                style="background-image: linear-gradient(rgba(255,248,220,.88), rgba(245,222,179,.9));">
        <h2 class="font-serif font-bold text-2xl text-amber-950">
            Novo Registro - {{ $character->name }}
        </h2>
    </x-slot>

    <div class="py-8 min-h-screen"
        style="background-color: #b08a5a;
            background-image:
            radial-gradient(circle at 15% 20%, rgba(80, 43, 20, 0.20), transparent 24%),
            radial-gradient(circle at 85% 12%, rgba(92, 51, 23, 0.18), transparent 22%),
            radial-gradient(circle at 35% 85%, rgba(70, 39, 18, 0.16), transparent 28%),
            linear-gradient(rgba(176, 138, 90, 0.95), rgba(139, 102, 62, 0.96));">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-xl border border-amber-700/30 bg-amber-100/85 shadow-lg p-6 text-amber-950">

                <form method="POST" action="{{ route('characters.features.store', $character) }}" class="space-y-4">
                    @csrf

                    @if ($errors->any())
                        <div class="mb-4 rounded bg-red-100 p-4 text-red-800">
                            <strong>Há erros no formulário:</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div>
                        <label class="block font-medium">Tipo</label>
                        <select name="type" class="w-full rounded border-gray-300" required>
                            <option value="">Selecione</option>
                            <option value="Habilidade" {{ old('type') === 'Habilidade' ? 'selected' : '' }}>
                                Habilidade
                            </option>
                            <option value="Característica" {{ old('type') === 'Característica' ? 'selected' : '' }}>
                                Característica
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium">Nome</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full rounded border-gray-300" required>
                    </div>

                    <div>
                        <label class="block font-medium">Descrição</label>
                        <textarea name="description" rows="5"
                                  class="w-full rounded border-gray-300">{{ old('description') }}</textarea>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                                class="rounded-lg border border-amber-900 bg-gradient-to-r from-amber-800 to-amber-950 px-4 py-2 font-semibold text-yellow-200 shadow hover:from-amber-700 hover:to-amber-900"
                            Salvar
                        </button>

                        <a href="{{ route('characters.features.index', $character) }}"
                           class="rounded-lg border border-stone-600 bg-stone-300 px-4 py-2 font-semibold text-stone-900 hover:bg-stone-400"
                            Cancelar
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
