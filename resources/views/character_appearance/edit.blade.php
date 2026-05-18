<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Aparência - {{ $character->name }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('characters.appearance.update', $character) }}" class="space-y-4">
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

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium">Altura</label>
                            <input type="text" name="height" value="{{ old('height', $appearance->height ?? '') }}"
                                   placeholder="Ex: 1,80 m"
                                   class="w-full rounded border-gray-300">
                        </div>

                        <div>
                            <label class="block font-medium">Peso</label>
                            <input type="text" name="weight" value="{{ old('weight', $appearance->weight ?? '') }}"
                                   placeholder="Ex: 75 kg"
                                   class="w-full rounded border-gray-300">
                        </div>

                        <div>
                            <label class="block font-medium">Olhos</label>
                            <input type="text" name="eyes" value="{{ old('eyes', $appearance->eyes ?? '') }}"
                                   placeholder="Ex: verdes"
                                   class="w-full rounded border-gray-300">
                        </div>

                        <div>
                            <label class="block font-medium">Cabelo</label>
                            <input type="text" name="hair" value="{{ old('hair', $appearance->hair ?? '') }}"
                                   placeholder="Ex: castanho escuro"
                                   class="w-full rounded border-gray-300">
                        </div>

                        <div>
                            <label class="block font-medium">Pele</label>
                            <input type="text" name="skin" value="{{ old('skin', $appearance->skin ?? '') }}"
                                   placeholder="Ex: clara, bronzeada, oliva..."
                                   class="w-full rounded border-gray-300">
                        </div>
                    </div>

                    <div>
                        <label class="block font-medium">Descrição física</label>
                        <textarea name="description" rows="6"
                                  class="w-full rounded border-gray-300"
                                  placeholder="Descreva marcas, cicatrizes, postura, roupas, aparência geral...">{{ old('description', $appearance->description ?? '') }}</textarea>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                                class="rounded bg-amber-700 px-4 py-2 text-white hover:bg-amber-800">
                            Salvar
                        </button>

                        <a href="{{ route('characters.appearance.show', $character) }}"
                           class="rounded bg-gray-300 px-4 py-2 text-gray-800 hover:bg-gray-400">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
