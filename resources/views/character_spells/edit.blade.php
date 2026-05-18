<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Magia - {{ $character->name }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

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
                                class="rounded bg-purple-600 px-4 py-2 text-white hover:bg-purple-700">
                            Atualizar
                        </button>

                        <a href="{{ route('characters.spells.index', $character) }}"
                           class="rounded bg-gray-300 px-4 py-2 text-gray-800 hover:bg-gray-400">
                            Cancelar
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
