<x-app-layout>
    <x-slot name="header">
        <div class="rounded-xl border border-amber-700/40 bg-amber-100 shadow-md p-5"
            style="background-image: linear-gradient(rgba(255,248,220,.88), rgba(245,222,179,.9));">

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 items-center">

                <!-- LADO ESQUERDO: 40% -->
                <div class="lg:col-span-2">
                    <div class="flex items-baseline gap-4">
                        <h2 class="font-serif font-bold text-3xl text-amber-950">
                            {{ $character->name }}
                        </h2>

                        <span class="rounded border border-amber-800/40 bg-amber-200/70 px-3 py-1 text-sm font-bold text-amber-950">
                            Nível {{ $character->level }}
                        </span>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('characters.edit', $character) }}"
                        class="inline-block rounded border border-amber-800 bg-amber-700 px-4 py-2 text-sm font-semibold text-white hover:bg-amber-800">
                            Editar Ficha
                        </a>
                    </div>
                </div>

                <!-- LADO DIREITO: 60% -->
                <div class="lg:col-span-3">
                    <div class="grid grid-cols-3 gap-x-4 gap-y-3 text-sm text-amber-950">

                        <div>
                            <p class="text-xs uppercase tracking-wide text-amber-800">Classe</p>
                            <p class="font-semibold">{{ $character->class }}</p>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-wide text-amber-800">Antecedente</p>
                            <p class="font-semibold">{{ $character->background }}</p>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-wide text-amber-800">Jogador</p>
                            <p class="font-semibold">{{ $character->player_name ?: '-' }}</p>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-wide text-amber-800">Raça</p>
                            <p class="font-semibold">{{ $character->race }}</p>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-wide text-amber-800">Tendência</p>
                            <p class="font-semibold">{{ $character->alignment }}</p>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-wide text-amber-800">XP</p>
                            <p class="font-semibold">{{ $character->experience }}</p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </x-slot>

    <div class="py-8 min-h-screen"
     style="background-color: #b08a5a;
        background-image:
        radial-gradient(circle at 15% 20%, rgba(80, 43, 20, 0.20), transparent 24%),
        radial-gradient(circle at 85% 12%, rgba(92, 51, 23, 0.18), transparent 22%),
        radial-gradient(circle at 35% 85%, rgba(70, 39, 18, 0.16), transparent 28%),
        linear-gradient(rgba(176, 138, 90, 0.95), rgba(139, 102, 62, 0.96));">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 items-start">

                <!-- COLUNA ESQUERDA -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- ATRIBUTOS -->
                    <div class="rounded-xl border border-amber-700/30 bg-amber-100/80 shadow p-4 text-amber-950">
                        <h3 class="text-lg font-semibold mb-3">Atributos</h3>

                        <div class="space-y-3">
                            @foreach([
                                'Força' => $character->strength,
                                'Destreza' => $character->dexterity,
                                'Constituição' => $character->constitution,
                                'Inteligência' => $character->intelligence,
                                'Sabedoria' => $character->wisdom,
                                'Carisma' => $character->charisma,
                            ] as $label => $value)

                                @php $mod = $character->getAbilityModifier($value); @endphp

                                <div class="border border-amber-800/30 rounded-lg p-3 text-center shadow-sm"
                                    style="background-color: #d8b982;">
                                    <p class="text-sm">{{ $label }}</p>
                                    <p class="text-2xl font-bold">{{ $value }}</p>
                                    <p class="text-sm text-gray-600">
                                        {{ $mod >= 0 ? '+' . $mod : $mod }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- INSPIRAÇÃO + PROFICIÊNCIA + RESISTÊNCIAS + PERÍCIAS -->
                    <div class="space-y-4">

                        <div class="rounded-xl border border-amber-700/30 bg-amber-100/80 shadow p-3 text-amber-950">
                            <form method="POST" action="{{ route('characters.toggleInspiration', $character) }}">
                                @csrf
                                @method('PATCH')

                                <button type="submit"
                                        class="w-full rounded px-4 py-2 text-white {{ $character->has_inspiration ? 'bg-green-600 hover:bg-green-700' : 'bg-gray-500 hover:bg-gray-600' }}">
                                    {{ $character->has_inspiration ? 'Possui Inspiração' : 'Sem Inspiração' }}
                                </button>
                            </form>
                        </div>

                        <div class="rounded-xl border border-amber-700/30 bg-amber-100/80 shadow px-4 py-2 text-center text-amber-950">
                            <p class="text-xs text-gray-700">Proficiência</p>
                            <p class="text-2xl font-bold">+{{ $character->getProficiencyBonus() }}</p>
                        </div>

                        <div class="rounded-xl border border-amber-700/30 bg-amber-100/80 shadow p-4 text-amber-950">
                            <h3 class="text-lg font-semibold mb-3">Testes de Resistência</h3>

                            @foreach([
                                'Força' => 'strength',
                                'Destreza' => 'dexterity',
                                'Constituição' => 'constitution',
                                'Inteligência' => 'intelligence',
                                'Sabedoria' => 'wisdom',
                                'Carisma' => 'charisma',
                            ] as $label => $ability)

                                @php
                                    $save = $character->getSavingThrowValue($ability);
                                    $field = $ability . '_save_proficient';
                                @endphp

                                <div class="flex justify-between border-b border-amber-700/30 py-1 text-sm">
                                    <span>{{ $label }}</span>
                                    <span>
                                        {{ $character->{$field} ? '●' : '○' }}
                                        {{ $save >= 0 ? '+' . $save : $save }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        <div class="rounded-xl border border-amber-700/30 bg-amber-100/80 shadow p-4 text-amber-950">
                            <h3 class="text-lg font-semibold mb-3">Perícias</h3>

                            @foreach([
                                'Acrobacia' => 'acrobatics',
                                'Adestrar Animais' => 'animal_handling',
                                'Arcanismo' => 'arcana',
                                'Atletismo' => 'athletics',
                                'Atuação' => 'performance',
                                'Enganação' => 'deception',
                                'Furtividade' => 'stealth',
                                'História' => 'history',
                                'Intimidação' => 'intimidation',
                                'Intuição' => 'insight',
                                'Investigação' => 'investigation',
                                'Medicina' => 'medicine',
                                'Natureza' => 'nature',
                                'Percepção' => 'perception',
                                'Persuasão' => 'persuasion',
                                'Prestidigitação' => 'sleight_of_hand',
                                'Religião' => 'religion',
                                'Sobrevivência' => 'survival',
                            ] as $label => $skill)

                                @php
                                    $value = $character->getSkillValue($skill);
                                    $prof = $skill . '_proficient';
                                @endphp

                                <div class="flex justify-between border-b border-amber-700/30 py-1 text-sm">
                                    <span>{{ $label }}</span>
                                    <span>
                                        {{ $character->{$prof} ? '●' : '○' }}
                                        {{ $value >= 0 ? '+' . $value : $value }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <!-- BLOCO INFERIOR OCUPANDO AS DUAS COLUNAS -->
                    <div class="md:col-span-2 space-y-4">

                        <div class="rounded-xl border border-amber-700/30 bg-amber-100/80 shadow p-4 text-amber-950 text-center">
                            <p class="text-sm text-gray-600">Sabedoria Passiva</p>
                            <p class="text-4xl font-bold">{{ $character->getPassiveWisdom() }}</p>
                        </div>

                        <div class="rounded-xl border border-amber-700/30 bg-amber-100/80 shadow p-4 text-amber-950">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-lg font-semibold">Idiomas e outras proficiências</h3>

                                <a href="{{ route('characters.language-proficiencies.index', $character) }}"
                                class="rounded border border-amber-800 bg-amber-700 px-3 py-1 text-sm font-semibold text-white hover:bg-amber-800">
                                    Gerenciar
                                </a>
                            </div>

                            @forelse($character->languageProficiencies as $record)
                                <div class="mb-3 rounded border-l-4 border-amber-700 bg-amber-50/50 p-3">
                                    <p class="font-semibold">{{ $record->name }}</p>
                                    <p class="text-xs text-gray-600">{{ $record->type }}</p>

                                    @if($record->description)
                                        <p class="text-sm text-gray-700 mt-1 whitespace-pre-line">
                                            {{ $record->description }}
                                        </p>
                                    @endif
                                </div>
                            @empty
                                <p class="text-sm text-gray-600">
                                    Nenhum idioma ou proficiência cadastrada.
                                </p>
                            @endforelse
                        </div>

                    </div>

                </div>

                <!-- COLUNA CENTRAL -->
                <div class="space-y-4">

                    <!-- RETRATO DO PERSONAGEM -->
                    <div
                        class="rounded-xl border border-amber-700/30 bg-amber-100/80 p-4 text-amber-950 shadow"
                    >
                        <div class="flex flex-col items-center">
                            @if ($character->photo_path)
                                <img
                                    src="{{ asset('storage/' . $character->photo_path) }}"
                                    alt="Retrato de {{ $character->name }}"
                                    class="h-80 w-64 rounded-xl border-4 border-amber-900/60 object-cover shadow-xl"
                                >
                            @else
                                <div
                                    class="flex h-80 w-64 items-center justify-center rounded-xl border-4 border-dashed border-amber-900/35 bg-amber-50/50 p-6 text-center"
                                >
                                    <div>
                                        <p class="font-serif text-lg font-bold text-amber-950">
                                            Retrato não registrado
                                        </p>

                                        <p class="mt-2 text-sm text-amber-900/65">
                                            Adicione uma imagem pela edição da ficha.
                                        </p>
                                    </div>
                                </div>
                            @endif

                            <p class="mt-3 font-serif text-xl font-bold text-amber-950">
                                {{ $character->name }}
                            </p>

                            <p class="text-sm text-amber-900/70">
                                {{ $character->race }} • {{ $character->class }}
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">

                        <!-- CA -->
                        <div class="rounded-xl border border-amber-700/30 bg-amber-100/80 shadow p-4 text-amber-950 text-center">
                            <p class="text-xs text-gray-500">Classe de Armadura</p>
                            <p class="text-3xl font-bold">{{ $character->armor_class }}</p>
                        </div>

                        <!-- INICIATIVA -->
                        <div class="rounded-xl border border-amber-700/30 bg-amber-100/80 shadow p-4 text-amber-950 text-center">
                            <p class="text-xs text-gray-500">Iniciativa</p>
                            <p class="text-3xl font-bold">
                                {{ $character->getInitiative() >= 0 ? '+' . $character->getInitiative() : $character->getInitiative() }}
                            </p>
                        </div>

                        <!-- DESLOCAMENTO -->
                        <div class="rounded-xl border border-amber-700/30 bg-amber-100/80 shadow p-4 text-amber-950 text-center">
                            <p class="text-xs text-gray-500">Deslocamento</p>
                            <p class="text-3xl font-bold">{{ $character->getSpeedInMeters() }}</p>
                        </div>

                    </div>

                    <div class="rounded-xl border border-amber-700/30 bg-amber-100/80 shadow p-4 text-amber-950">
                        <h3 class="font-semibold mb-2">Pontos de Vida</h3>

                        <div class="w-full bg-gray-200 rounded h-4 overflow-hidden">
                            <div class="bg-red-500 h-4"
                                style="width: {{ ($character->hp_max > 0 ? ($character->hp_current / $character->hp_max) * 100 : 0) }}%">
                            </div>
                        </div>

                        <p class="mt-2 text-center font-bold">
                            {{ $character->hp_current }} / {{ $character->hp_max }}
                        </p>

                        <div class="mt-4 space-y-2">
                            <form method="POST" action="{{ route('characters.damage', $character) }}" class="flex gap-2">
                                @csrf @method('PATCH')
                                <input type="number" name="amount" class="w-full rounded border-gray-300" placeholder="Dano">
                                <button class="bg-red-600 text-white px-3 rounded">-</button>
                            </form>

                            <form method="POST" action="{{ route('characters.heal', $character) }}" class="flex gap-2">
                                @csrf @method('PATCH')
                                <input type="number" name="amount" class="w-full rounded border-gray-300" placeholder="Cura">
                                <button class="bg-green-600 text-white px-3 rounded">+</button>
                            </form>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">

                        <!-- DADOS DE VIDA -->
                        <div class="rounded-xl border border-amber-700/30 bg-amber-100/80 shadow px-4 py-3 text-amber-950">
                            <h3 class="font-semibold text-sm mb-1">Dados de Vida</h3>
                            <p class="text-lg font-bold">
                                @php
                                    $hitDice = match($character->class) {
                                        'Bárbaro' => 'd12',
                                        'Guerreiro', 'Paladino', 'Patrulheiro' => 'd10',
                                        'Bardo', 'Clérigo', 'Druida', 'Monge', 'Bruxo' => 'd8',
                                        default => 'd6',
                                    };
                                @endphp

                                {{ $character->level }}{{ $hitDice }}
                            </p>
                        </div>

                        <!-- TESTES DE MORTE -->
                        <div class="rounded-xl border border-amber-700/30 bg-amber-100/80 shadow p-4 text-amber-950">
                            <h3 class="font-semibold mb-2">Testes contra a Morte</h3>

                            <div class="mb-2">
                                <p class="text-sm">Sucessos</p>
                                <div class="flex gap-2">
                                    @for ($i = 0; $i < 3; $i++)
                                        <input type="checkbox">
                                    @endfor
                                </div>
                            </div>

                            <div>
                                <p class="text-sm">Fracassos</p>
                                <div class="flex gap-2">
                                    @for ($i = 0; $i < 3; $i++)
                                        <input type="checkbox">
                                    @endfor
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="flex gap-2">

                        <a href="{{ route('characters.weapons.index', $character) }}"
                            class="rounded-lg border border-stone-500 bg-gradient-to-r from-yellow-950 via-amber-900 to-stone-800 px-4 py-2 font-semibold text-slate-200 shadow hover:from-yellow-900 hover:to-stone-700">
                            Arsenal
                        </a>

                        <a href="{{ route('characters.spells.index', $character) }}"
                            class="rounded-lg border border-indigo-300 bg-gradient-to-r from-indigo-950 via-purple-900 to-blue-900 px-4 py-2 font-serif font-bold tracking-wide text-amber-200 shadow hover:from-indigo-900 hover:to-purple-800">
                            Grimório
                        </a>

                    </div>

                    <div class="space-y-4">

                        <!-- MOEDAS -->
                        <div class="rounded-xl border border-amber-700/30 bg-amber-100/80 shadow p-4 text-amber-950">
                            <h3 class="font-semibold mb-3">Moedas</h3>

                            <form id="coinsForm" method="POST" action="{{ route('characters.updateCoins', $character) }}">
                                @csrf
                                @method('PATCH')

                                <div class="grid grid-cols-5 gap-2 text-center text-sm">
                                    <div class="rounded border border-amber-700/20 bg-amber-50/60 p-1">
                                        <label class="block text-xs text-gray-600">PC</label>
                                        <input type="number" name="cp" value="{{ $character->cp }}" min="0"
                                            class="coin-input w-full rounded border-gray-300 text-center text-sm pr-1"
                                            style="appearance: textfield;">
                                    </div>

                                    <div class="rounded border border-amber-700/20 bg-amber-50/60 p-1">
                                        <label class="block text-xs text-gray-600">PP</label>
                                        <input type="number" name="sp" value="{{ $character->sp }}" min="0"
                                            class="coin-input w-full rounded border-gray-300 text-center text-sm pr-1"
                                            style="appearance: textfield;">
                                    </div>

                                    <div class="rounded border border-amber-700/20 bg-amber-50/60 p-1">
                                        <label class="block text-xs text-gray-600">PE</label>
                                        <input type="number" name="ep" value="{{ $character->ep }}" min="0"
                                            class="coin-input w-full rounded border-gray-300 text-center text-sm pr-1"
                                            style="appearance: textfield;">
                                    </div>

                                    <div class="rounded border border-amber-700/20 bg-amber-50/60 p-1">
                                        <label class="block text-xs text-gray-600">PO</label>
                                        <input type="number" name="gp" value="{{ $character->gp }}" min="0"
                                            class="coin-input w-full rounded border-gray-300 text-center text-sm pr-1"
                                            style="appearance: textfield;">
                                    </div>

                                    <div class="rounded border border-amber-700/20 bg-amber-50/60 p-1">
                                        <label class="block text-xs text-gray-600">PL</label>
                                        <input type="number" name="pp" value="{{ $character->pp }}" min="0"
                                            class="coin-input w-full rounded border-gray-300 text-center text-sm pr-1"
                                            style="appearance: textfield;">
                                    </div>
                                </div>

                            </form>
                        </div>

                        <!-- EQUIPAMENTOS -->
                        <a href="{{ route('characters.items.index', $character) }}"
                            class="block w-full rounded-lg border border-yellow-700 bg-gradient-to-r from-amber-900 to-yellow-900 px-4 py-3 text-center font-bold text-yellow-300 shadow hover:from-amber-800 hover:to-yellow-800">
                            Equipamentos
                        </a>

                        <a href="{{ route('characters.appearance.show', $character) }}"
                            class="block w-full rounded-lg border border-stone-700 bg-gradient-to-r from-stone-700 to-stone-900 px-4 py-3 text-center font-bold text-amber-200 shadow hover:from-stone-600 hover:to-stone-800">
                            Aparência
                        </a>

                    </div>

                </div>

                <!-- COLUNA DIREITA -->
                <div class="space-y-4">

                    <div class="rounded-xl border border-amber-700/30 bg-amber-100/80 shadow p-4 text-amber-950">
                        <h3 class="text-lg font-semibold mb-2">Traços de Personalidade</h3>
                        <p class="text-sm text-gray-700 whitespace-pre-line">
                            {{ $character->personality_traits ?: 'Não informado.' }}
                        </p>
                    </div>

                    <div class="rounded-xl border border-amber-700/30 bg-amber-100/80 shadow p-4 text-amber-950">
                        <h3 class="text-lg font-semibold mb-2">Ideais</h3>
                        <p class="text-sm text-gray-700 whitespace-pre-line">
                            {{ $character->ideals ?: 'Não informado.' }}
                        </p>
                    </div>

                    <div class="rounded-xl border border-amber-700/30 bg-amber-100/80 shadow p-4 text-amber-950">
                        <h3 class="text-lg font-semibold mb-2">Ligações</h3>
                        <p class="text-sm text-gray-700 whitespace-pre-line">
                            {{ $character->bonds ?: 'Não informado.' }}
                        </p>
                    </div>

                    <div class="rounded-xl border border-amber-700/30 bg-amber-100/80 shadow p-4 text-amber-950">
                        <h3 class="text-lg font-semibold mb-2">Defeitos</h3>
                        <p class="text-sm text-gray-700 whitespace-pre-line">
                            {{ $character->flaws ?: 'Não informado.' }}
                        </p>
                    </div>

                    <div class="rounded-xl border border-amber-700/30 bg-amber-100/80 shadow p-4 text-amber-950">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg font-semibold">Habilidades e Características</h3>

                            <a href="{{ route('characters.features.index', $character) }}"
                                class="rounded-lg border border-amber-900 bg-gradient-to-r from-amber-800 to-amber-900 px-3 py-1 text-sm font-semibold text-yellow-200 shadow hover:from-amber-700 hover:to-amber-800">
                                Gerenciar
                            </a>
                        </div>

                        @forelse($character->features as $feature)
                            <div class="mb-3 rounded border-l-4 border-amber-700 bg-indigo-50/40 p-3">
                                <p class="font-semibold">{{ $feature->name }}</p>
                                <p class="text-xs text-gray-500">{{ $feature->type }}</p>

                                @if($feature->description)
                                    <p class="text-sm text-gray-700 mt-1 whitespace-pre-line">
                                        {{ $feature->description }}
                                    </p>
                                @endif
                            </div>
                        @empty
                            <p class="text-sm text-gray-600">
                                Nenhuma habilidade ou característica cadastrada.
                            </p>
                        @endforelse
                    </div>

                </div>

            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('coinsForm');
            const inputs = document.querySelectorAll('.coin-input');
            let timeout = null;

            function saveCoins() {
                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }).catch(() => {
                    console.log('Erro ao salvar moedas automaticamente.');
                });
            }

            inputs.forEach(input => {
                input.addEventListener('input', function () {
                    clearTimeout(timeout);

                    timeout = setTimeout(() => {
                        saveCoins();
                    }, 600);
                });

                input.addEventListener('blur', function () {
                    clearTimeout(timeout);
                    saveCoins();
                });
            });
        });
    </script>

</x-app-layout>
