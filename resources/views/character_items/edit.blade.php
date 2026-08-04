<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif text-3xl font-bold text-amber-950 dark:text-amber-200">
            Editar Item - {{ $character->name }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-b from-[#b08a5a] to-[#6b4423] py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-2xl border-4 border-amber-900/60 bg-amber-100/90 p-6 text-amber-950 shadow-2xl sm:p-8 [&_label]:font-serif [&_label]:font-bold [&_input]:border-amber-800/40 [&_input]:bg-amber-50/70 [&_input]:focus:border-purple-800 [&_input]:focus:ring-purple-800 [&_textarea]:border-amber-800/40 [&_textarea]:bg-amber-50/70 [&_textarea]:focus:border-purple-800 [&_textarea]:focus:ring-purple-800">
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
                        <button type="submit" class="rounded-lg border border-amber-500/70 bg-gradient-to-r from-purple-950 to-indigo-950 px-5 py-2 font-serif font-bold text-amber-200 shadow hover:from-purple-900 hover:to-indigo-900">
                            Atualizar
                        </button>

                        <a href="{{ route('characters.items.index', $character) }}"
                           class="rounded-lg border border-stone-600 bg-stone-300 px-5 py-2 font-serif font-bold text-stone-900 hover:bg-stone-400">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
