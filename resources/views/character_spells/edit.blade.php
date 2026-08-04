<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif text-3xl font-bold text-purple-950 dark:text-amber-200">
            Editar Magia - {{ $character->name }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-b from-[#b08a5a] to-[#6b4423] py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-2xl border-4 border-purple-950/70 bg-amber-100/90 p-6 text-amber-950 shadow-2xl sm:p-8 [&_label]:font-serif [&_label]:font-bold [&_input]:border-purple-900/30 [&_input]:bg-amber-50/70 [&_input]:focus:border-purple-800 [&_input]:focus:ring-purple-800 [&_textarea]:border-purple-900/30 [&_textarea]:bg-amber-50/70 [&_textarea]:focus:border-purple-800 [&_textarea]:focus:ring-purple-800">

                <form method="POST" action="{{ route('characters.spells.update', [$character, $spell]) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

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
                        <label class="block font-medium">Nome da magia</label>
                        <input type="text" name="name" value="{{ old('name', $spell->name) }}"
                               class="w-full rounded border-gray-300" required>
                    </div>

                    <div>
                        <label class="block font-medium">Nível</label>
                        <input type="text" name="level" value="{{ old('level', $spell->level) }}"
                               class="w-full rounded border-gray-300">
                    </div>

                    <div>
                        <label class="block font-medium">Escola</label>
                        <input type="text" name="school" value="{{ old('school', $spell->school) }}"
                               class="w-full rounded border-gray-300">
                    </div>

                    <div>
                        <label class="block font-medium">Tempo de Conjuração</label>
                        <input type="text" name="casting_time" value="{{ old('casting_time', $spell->casting_time) }}"
                               class="w-full rounded border-gray-300">
                    </div>

                    <div>
                        <label class="block font-medium">Alcance</label>
                        <input type="text" name="range" value="{{ old('range', $spell->range) }}"
                               class="w-full rounded border-gray-300">
                    </div>

                    <div>
                        <label class="block font-medium">Duração</label>
                        <input type="text" name="duration" value="{{ old('duration', $spell->duration) }}"
                               class="w-full rounded border-gray-300">
                    </div>

                    <div>
                        <label class="block font-medium">Componentes</label>
                        <input type="text" name="components" value="{{ old('components', $spell->components) }}"
                               class="w-full rounded border-gray-300">
                    </div>

                    <div>
                        <label class="block font-medium">Descrição</label>
                        <textarea name="description" rows="5"
                                  class="w-full rounded border-gray-300">{{ old('description', $spell->description) }}</textarea>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                                class="rounded-lg border border-amber-500/70 bg-gradient-to-r from-purple-950 to-indigo-950 px-5 py-2 font-serif font-bold text-amber-200 shadow hover:from-purple-900 hover:to-indigo-900">
                            Atualizar
                        </button>

                        <a href="{{ route('characters.spells.index', $character) }}"
                           class="rounded-lg border border-stone-600 bg-stone-300 px-5 py-2 font-serif font-bold text-stone-900 hover:bg-stone-400">
                            Cancelar
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
