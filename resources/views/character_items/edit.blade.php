<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Item - {{ $character->name }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('characters.items.update', [$character, $item]) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-medium">Nome do item</label>
                        <input type="text" name="name" value="{{ old('name', $item->name) }}" class="w-full rounded border-gray-300" required>
                        @error('name')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium">Tipo</label>
                        <input type="text" name="type" value="{{ old('type', $item->type) }}" class="w-full rounded border-gray-300">
                        @error('type')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium">Quantidade</label>
                        <input type="number" name="quantity" value="{{ old('quantity', $item->quantity) }}" min="1" class="w-full rounded border-gray-300" required>
                        @error('quantity')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium">Descrição</label>
                        <textarea name="description" rows="4" class="w-full rounded border-gray-300">{{ old('description', $item->description) }}</textarea>
                        @error('description')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                            Atualizar
                        </button>

                        <a href="{{ route('characters.items.index', $character) }}"
                           class="rounded bg-gray-300 px-4 py-2 text-gray-800 hover:bg-gray-400">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
