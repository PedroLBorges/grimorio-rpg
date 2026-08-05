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
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="font-serif text-sm uppercase tracking-[0.25em] text-amber-800">
                        Grimório RPG
                    </p>

                    <h2 class="font-serif text-3xl font-bold text-amber-950">
                        Registrar novo personagem
                    </h2>

                    <p class="mt-1 text-sm text-amber-900/75">
                        Preencha as páginas abaixo para iniciar uma nova jornada.
                    </p>
                </div>

                <a
                    href="{{ route('characters.index') }}"
                    class="rounded-lg border border-amber-800 bg-amber-700 px-4 py-2 text-center font-serif text-sm font-bold text-white shadow transition hover:bg-amber-800"
                >
                    Voltar às fichas
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
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div
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
                <form
                    method="POST"
                    action="{{ route('characters.store') }}"
                    enctype="multipart/form-data"
                    class="space-y-8"
                >
                    @csrf

                    @if ($errors->any())
                        <div class="rounded-xl border border-red-800/40 bg-red-100 p-4 text-red-900 shadow">
                            <strong class="font-serif text-lg">
                                Há erros no registro:
                            </strong>

                            <ul class="mt-2 list-inside list-disc text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Identificação -->
                    <section class="rounded-xl border border-amber-800/30 bg-amber-50/45 p-5 shadow-sm">
                        <header class="mb-5">
                            <p class="font-serif text-xs uppercase tracking-[0.3em] text-amber-800">
                                Capítulo I
                            </p>

                            <h3 class="font-serif text-2xl font-bold text-amber-950">
                                Identificação do aventureiro
                            </h3>

                            <div class="mt-3 h-px bg-amber-800/30"></div>
                        </header>

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                            <div>
                                <label
                                    for="name"
                                    class="block font-serif text-sm font-bold text-amber-950"
                                >
                                    Nome do personagem
                                </label>

                                <input
                                    id="name"
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    required
                                    class="mt-1 w-full rounded-lg border-amber-800/40 bg-amber-50/80 text-amber-950 shadow-inner focus:border-purple-800 focus:ring-purple-800"
                                >
                            </div>

                            <div>
                                <label
                                    for="player_name"
                                    class="block font-serif text-sm font-bold text-amber-950"
                                >
                                    Nome do jogador
                                </label>

                                <input
                                    id="player_name"
                                    type="text"
                                    name="player_name"
                                    value="{{ old('player_name') }}"
                                    class="mt-1 w-full rounded-lg border-amber-800/40 bg-amber-50/80 text-amber-950 shadow-inner focus:border-purple-800 focus:ring-purple-800"
                                >
                            </div>

                            <div class="md:col-span-2">
                                <label
                                    for="photo"
                                    class="block font-serif text-sm font-bold text-amber-950"
                                >
                                    Retrato do personagem
                                </label>

                                <input
                                    id="photo"
                                    type="file"
                                    name="photo"
                                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                    class="mt-1 block w-full rounded-lg border border-amber-800/40 bg-amber-50/80 px-3 py-2 text-sm text-amber-950 shadow-inner
                                        file:mr-4 file:rounded-lg file:border-0 file:bg-purple-900 file:px-4 file:py-2
                                        file:font-serif file:font-bold file:text-amber-200 hover:file:bg-purple-800"
                                >

                                <p class="mt-2 text-xs text-amber-900/65">
                                    Formatos aceitos: JPG, JPEG, PNG ou WEBP. Tamanho máximo: 5 MB.
                                </p>

                                @error('photo')
                                    <p class="mt-2 text-sm font-semibold text-red-800">
                                        {{ $message }}
                                    </p>
                                @enderror

                                <div id="photo-preview-container" class="mt-4 hidden">
                                    <p class="mb-2 font-serif text-sm font-bold text-amber-950">
                                        Prévia do retrato
                                    </p>

                                    <img
                                        id="photo-preview"
                                        src=""
                                        alt="Prévia do retrato do personagem"
                                        class="h-64 w-48 rounded-xl border-4 border-amber-900/50 object-cover shadow-lg"
                                    >
                                </div>
                            </div>

                            <div>
                                <label class="block font-serif text-sm font-bold text-amber-950">
                                    Raça
                                </label>

                                <select
                                    id="character-race"
                                    name="race"
                                    required
                                    class="mt-1 w-full rounded-lg border-amber-800/40 bg-amber-50/80 text-amber-950 shadow-inner focus:border-purple-800 focus:ring-purple-800"
                                >
                                    <option value="">Selecione</option>

                                    @foreach(['Humano', 'Anão', 'Elfo', 'Halfling', 'Draconato', 'Gnomo', 'Meio-Elfo', 'Meio-Orc', 'Tiefling'] as $option)
                                        <option
                                            value="{{ $option }}"
                                            {{ old('race') === $option ? 'selected' : '' }}
                                        >
                                            {{ $option }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block font-serif text-sm font-bold text-amber-950">
                                    Classe
                                </label>

                                <select
                                    id="character-class"
                                    name="class"
                                    required
                                    class="mt-1 w-full rounded-lg border-amber-800/40 bg-amber-50/80 text-amber-950 shadow-inner focus:border-purple-800 focus:ring-purple-800"
                                >
                                    <option value="">Selecione</option>

                                    @foreach(['Bárbaro', 'Bardo', 'Bruxo', 'Clérigo', 'Druida', 'Feiticeiro', 'Guerreiro', 'Ladino', 'Mago', 'Monge', 'Paladino', 'Patrulheiro'] as $option)
                                        <option
                                            value="{{ $option }}"
                                            {{ old('class') === $option ? 'selected' : '' }}
                                        >
                                            {{ $option }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block font-serif text-sm font-bold text-amber-950">
                                    Antecedente
                                </label>

                                <select
                                    name="background"
                                    required
                                    class="mt-1 w-full rounded-lg border-amber-800/40 bg-amber-50/80 text-amber-950 shadow-inner focus:border-purple-800 focus:ring-purple-800"
                                >
                                    <option value="">Selecione</option>

                                    @foreach(['Acólito', 'Artesão de Guilda', 'Artista', 'Charlatão', 'Criminoso', 'Eremita', 'Forasteiro', 'Herói do Povo', 'Marinheiro', 'Nobre', 'Órfão', 'Sábio', 'Soldado'] as $option)
                                        <option
                                            value="{{ $option }}"
                                            {{ old('background') === $option ? 'selected' : '' }}
                                        >
                                            {{ $option }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block font-serif text-sm font-bold text-amber-950">
                                    Tendência
                                </label>

                                <select
                                    name="alignment"
                                    required
                                    class="mt-1 w-full rounded-lg border-amber-800/40 bg-amber-50/80 text-amber-950 shadow-inner focus:border-purple-800 focus:ring-purple-800"
                                >
                                    <option value="">Selecione</option>

                                    @foreach(['Leal e Bom', 'Neutro e Bom', 'Caótico e Bom', 'Leal e Neutro', 'Neutro', 'Caótico e Neutro', 'Leal e Mau', 'Neutro e Mau', 'Caótico e Mau'] as $option)
                                        <option
                                            value="{{ $option }}"
                                            {{ old('alignment') === $option ? 'selected' : '' }}
                                        >
                                            {{ $option }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block font-serif text-sm font-bold text-amber-950">
                                    Nível
                                </label>

                                <input
                                    id="level"
                                    type="number"
                                    name="level"
                                    value="{{ old('level', 1) }}"
                                    min="1"
                                    max="20"
                                    required
                                    class="mt-1 w-full rounded-lg border-amber-800/40 bg-amber-50/80 text-amber-950 shadow-inner focus:border-purple-800 focus:ring-purple-800"
                                >
                            </div>

                        </div>
                    </section>

                    <!-- Atributos -->
                        <section class="rounded-xl border border-amber-800/30 bg-amber-50/45 p-5 shadow-sm">
                            <header class="mb-5">
                                <p class="font-serif text-xs uppercase tracking-[0.3em] text-amber-800">
                                    Capítulo II
                                </p>

                                <h3 class="font-serif text-2xl font-bold text-amber-950">
                                    Atributos
                                </h3>

                                <div class="mt-3 h-px bg-amber-800/30"></div>
                            </header>

                            <div class="grid grid-cols-2 gap-4 md:grid-cols-3">
                                @foreach([
                                    'strength' => 'Força',
                                    'dexterity' => 'Destreza',
                                    'constitution' => 'Constituição',
                                    'intelligence' => 'Inteligência',
                                    'wisdom' => 'Sabedoria',
                                    'charisma' => 'Carisma',
                                ] as $field => $label)

                                    <div class="rounded-xl border border-amber-800/30 bg-[#d8b982] p-4 text-center shadow-sm">
                                        <label
                                            for="{{ $field }}"
                                            class="block font-serif text-sm font-bold text-amber-950"
                                        >
                                            {{ $label }}
                                        </label>

                                        <input
                                            id="{{ $field }}"
                                            data-ability-input
                                            type="number"
                                            name="{{ $field }}"
                                            value="{{ old($field, 10) }}"
                                            min="1"
                                            max="20"
                                            required
                                            class="mt-2 w-full rounded-lg border-amber-800/40 bg-amber-50/80 text-center text-lg font-bold text-amber-950 shadow-inner focus:border-purple-800 focus:ring-purple-800"
                                        >

                                        <p class="mt-2 text-sm font-bold text-amber-950">
                                            Modificador:
                                            <span id="{{ $field }}-modifier">+0</span>
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </section>

                    <!-- Valores automáticos -->
                    <section class="rounded-xl border border-purple-900/30 bg-purple-950/90 p-5 text-amber-100 shadow-lg">
                        <header class="mb-4">
                            <p class="font-serif text-xs uppercase tracking-[0.3em] text-purple-200">
                                Cálculos do grimório
                            </p>

                            <h3 class="font-serif text-xl font-bold text-amber-200">
                                Valores automáticos
                            </h3>
                        </header>

                        <div class="grid grid-cols-2 gap-3 md:grid-cols-3 lg:grid-cols-6">
                            <div class="rounded-lg border border-amber-400/30 bg-purple-900/60 p-3 text-center">
                                <p class="text-xs text-purple-100">Proficiência</p>
                                <p id="calculated-proficiency" class="mt-1 text-2xl font-bold text-amber-200">+2</p>
                            </div>

                            <div class="rounded-lg border border-amber-400/30 bg-purple-900/60 p-3 text-center">
                                <p class="text-xs text-purple-100">Iniciativa</p>
                                <p id="calculated-initiative" class="mt-1 text-2xl font-bold text-amber-200">+0</p>
                            </div>

                            <div class="rounded-lg border border-amber-400/30 bg-purple-900/60 p-3 text-center">
                                <p class="text-xs text-purple-100">Percepção passiva</p>
                                <p id="calculated-passive-perception" class="mt-1 text-2xl font-bold text-amber-200">10</p>
                            </div>

                            <div class="rounded-lg border border-amber-400/30 bg-purple-900/60 p-3 text-center">
                                <p class="text-xs text-purple-100">Dado de vida</p>
                                <p id="calculated-hit-die" class="mt-1 text-2xl font-bold text-amber-200">—</p>
                            </div>

                            <div class="rounded-lg border border-amber-400/30 bg-purple-900/60 p-3 text-center">
                                <p class="text-xs text-purple-100">HP inicial sugerido</p>
                                <p id="calculated-starting-hp" class="mt-1 text-2xl font-bold text-amber-200">—</p>
                            </div>

                            <div class="rounded-lg border border-amber-400/30 bg-purple-900/60 p-3 text-center">
                                <p class="text-xs text-purple-100">Deslocamento</p>
                                <p id="calculated-speed" class="mt-1 text-2xl font-bold text-amber-200">—</p>
                            </div>
                        </div>
                    </section>

                    <!-- Combate e vida -->
                    <section class="rounded-xl border border-amber-800/30 bg-amber-50/45 p-5 shadow-sm">
                        <header class="mb-5">
                            <p class="font-serif text-xs uppercase tracking-[0.3em] text-amber-800">
                                Capítulo III
                            </p>

                            <h3 class="font-serif text-2xl font-bold text-amber-950">
                                Combate e vitalidade
                            </h3>

                            <div class="mt-3 h-px bg-amber-800/30"></div>
                        </header>

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                            <div>
                                <label class="block font-serif text-sm font-bold text-amber-950">
                                    HP máximo
                                </label>

                                <input
                                    type="number"
                                    name="hp_max"
                                    value="{{ old('hp_max', 10) }}"
                                    min="1"
                                    required
                                    class="mt-1 w-full rounded-lg border-amber-800/40 bg-amber-50/80 text-amber-950 shadow-inner focus:border-purple-800 focus:ring-purple-800"
                                >
                            </div>

                            <div>
                                <label class="block font-serif text-sm font-bold text-amber-950">
                                    HP atual
                                </label>

                                <input
                                    type="number"
                                    name="hp_current"
                                    value="{{ old('hp_current', 10) }}"
                                    min="0"
                                    required
                                    class="mt-1 w-full rounded-lg border-amber-800/40 bg-amber-50/80 text-amber-950 shadow-inner focus:border-purple-800 focus:ring-purple-800"
                                >
                            </div>

                            <div>
                                <label class="block font-serif text-sm font-bold text-amber-950">
                                    Classe de Armadura
                                </label>

                                <input
                                    type="number"
                                    name="armor_class"
                                    value="{{ old('armor_class', 10) }}"
                                    min="1"
                                    max="40"
                                    required
                                    class="mt-1 w-full rounded-lg border-amber-800/40 bg-amber-50/80 text-amber-950 shadow-inner focus:border-purple-800 focus:ring-purple-800"
                                >
                            </div>
                        </div>
                    </section>

                    <!-- Perícias -->
                    <section class="rounded-xl border border-amber-800/30 bg-amber-50/45 p-5 shadow-sm">
                        <header class="mb-5">
                            <p class="font-serif text-xs uppercase tracking-[0.3em] text-amber-800">
                                Capítulo IV
                            </p>

                            <h3 class="font-serif text-2xl font-bold text-amber-950">
                                Perícias
                            </h3>

                            <p class="mt-2 text-sm text-amber-900/70">
                                Marque apenas as perícias nas quais o personagem possui proficiência.
                                Os valores serão calculados automaticamente.
                            </p>

                            <div class="mt-3 h-px bg-amber-800/30"></div>
                        </header>

                        @php
                            $skills = [
                                'acrobatics_proficient' => 'Acrobacia (Destreza)',
                                'animal_handling_proficient' => 'Adestrar Animais (Sabedoria)',
                                'arcana_proficient' => 'Arcanismo (Inteligência)',
                                'athletics_proficient' => 'Atletismo (Força)',
                                'performance_proficient' => 'Atuação (Carisma)',
                                'deception_proficient' => 'Enganação (Carisma)',
                                'stealth_proficient' => 'Furtividade (Destreza)',
                                'history_proficient' => 'História (Inteligência)',
                                'intimidation_proficient' => 'Intimidação (Carisma)',
                                'insight_proficient' => 'Intuição (Sabedoria)',
                                'investigation_proficient' => 'Investigação (Inteligência)',
                                'medicine_proficient' => 'Medicina (Sabedoria)',
                                'nature_proficient' => 'Natureza (Inteligência)',
                                'perception_proficient' => 'Percepção (Sabedoria)',
                                'persuasion_proficient' => 'Persuasão (Carisma)',
                                'sleight_of_hand_proficient' => 'Prestidigitação (Destreza)',
                                'religion_proficient' => 'Religião (Inteligência)',
                                'survival_proficient' => 'Sobrevivência (Sabedoria)',
                            ];
                        @endphp

                        <div class="grid grid-cols-1 gap-3 md:grid-cols-2 lg:grid-cols-3">
                            @foreach($skills as $field => $label)
                                <label class="flex cursor-pointer items-center gap-3 rounded-lg border border-amber-800/30 bg-amber-100/55 p-3 text-sm text-amber-950 transition hover:bg-amber-200/60">
                                    <input
                                        type="checkbox"
                                        name="{{ $field }}"
                                        value="1"
                                        {{ old($field) ? 'checked' : '' }}
                                        class="rounded border-amber-700 bg-amber-50 text-purple-800 focus:ring-purple-700"
                                    >

                                    <span>{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </section>

                    <!-- Resistências -->
                    <section class="rounded-xl border border-amber-800/30 bg-amber-50/45 p-5 shadow-sm">
                        <header class="mb-5">
                            <p class="font-serif text-xs uppercase tracking-[0.3em] text-amber-800">
                                Capítulo V
                            </p>

                            <h3 class="font-serif text-2xl font-bold text-amber-950">
                                Testes de resistência
                            </h3>

                            <p class="mt-2 text-sm text-amber-900/70">
                                Marque os testes nos quais o personagem possui proficiência.
                            </p>

                            <div
                                id="saving-throws-class-message"
                                class="mt-3 hidden rounded-lg border border-purple-800/30 bg-purple-100/60 p-3 text-sm text-purple-950"
                            >
                                <strong class="font-serif">Proficiências da classe:</strong>

                                <span id="saving-throws-class-description"></span>
                            </div>

                            <div class="mt-3 h-px bg-amber-800/30"></div>
                        </header>

                        @php
                            $savingThrows = [
                                'strength_save_proficient' => 'Força',
                                'dexterity_save_proficient' => 'Destreza',
                                'constitution_save_proficient' => 'Constituição',
                                'intelligence_save_proficient' => 'Inteligência',
                                'wisdom_save_proficient' => 'Sabedoria',
                                'charisma_save_proficient' => 'Carisma',
                            ];
                        @endphp

                        <div class="grid grid-cols-1 gap-3 md:grid-cols-2 lg:grid-cols-3">
                            @foreach($savingThrows as $field => $label)
                                <label
                                    id="{{ $field }}-container"
                                    class="flex cursor-pointer items-center gap-3 rounded-lg border border-amber-800/30 bg-amber-100/55 p-3 text-amber-950 transition hover:bg-amber-200/60"
                                >
                                    <input
                                        id="{{ $field }}"
                                        data-saving-throw
                                        type="checkbox"
                                        name="{{ $field }}"
                                        value="1"
                                        {{ old($field) ? 'checked' : '' }}
                                        class="rounded border-amber-700 bg-amber-50 text-purple-800 focus:ring-purple-700"
                                    >

                                    <span>{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </section>

                    <!-- Personalidade -->
                    <section class="rounded-xl border border-amber-800/30 bg-amber-50/45 p-5 shadow-sm">
                        <header class="mb-5">
                            <p class="font-serif text-xs uppercase tracking-[0.3em] text-amber-800">
                                Capítulo VI
                            </p>

                            <h3 class="font-serif text-2xl font-bold text-amber-950">
                                Personalidade e história
                            </h3>

                            <div class="mt-3 h-px bg-amber-800/30"></div>
                        </header>

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                            <div>
                                <label class="block font-serif text-sm font-bold text-amber-950">
                                    Traços de personalidade
                                </label>

                                <textarea
                                    name="personality_traits"
                                    rows="4"
                                    class="mt-1 w-full rounded-lg border-amber-800/40 bg-amber-50/80 text-amber-950 shadow-inner focus:border-purple-800 focus:ring-purple-800"
                                >{{ old('personality_traits') }}</textarea>
                            </div>

                            <div>
                                <label class="block font-serif text-sm font-bold text-amber-950">
                                    Ideais
                                </label>

                                <textarea
                                    name="ideals"
                                    rows="4"
                                    class="mt-1 w-full rounded-lg border-amber-800/40 bg-amber-50/80 text-amber-950 shadow-inner focus:border-purple-800 focus:ring-purple-800"
                                >{{ old('ideals') }}</textarea>
                            </div>

                            <div>
                                <label class="block font-serif text-sm font-bold text-amber-950">
                                    Ligações
                                </label>

                                <textarea
                                    name="bonds"
                                    rows="4"
                                    class="mt-1 w-full rounded-lg border-amber-800/40 bg-amber-50/80 text-amber-950 shadow-inner focus:border-purple-800 focus:ring-purple-800"
                                >{{ old('bonds') }}</textarea>
                            </div>

                            <div>
                                <label class="block font-serif text-sm font-bold text-amber-950">
                                    Defeitos
                                </label>

                                <textarea
                                    name="flaws"
                                    rows="4"
                                    class="mt-1 w-full rounded-lg border-amber-800/40 bg-amber-50/80 text-amber-950 shadow-inner focus:border-purple-800 focus:ring-purple-800"
                                >{{ old('flaws') }}</textarea>
                            </div>
                        </div>

                        <div class="mt-5">
                            <label class="block font-serif text-sm font-bold text-amber-950">
                                História
                            </label>

                            <textarea
                                name="backstory"
                                rows="7"
                                class="mt-1 w-full rounded-lg border-amber-800/40 bg-amber-50/80 text-amber-950 shadow-inner focus:border-purple-800 focus:ring-purple-800"
                            >{{ old('backstory') }}</textarea>
                        </div>
                    </section>

                    <!-- Ações -->
                    <div class="flex flex-col-reverse gap-3 border-t border-amber-900/30 pt-6 sm:flex-row sm:justify-end">
                        <a
                            href="{{ route('characters.index') }}"
                            class="rounded-lg border border-stone-600 bg-stone-300 px-5 py-3 text-center font-serif font-bold text-stone-900 shadow transition hover:bg-stone-400"
                        >
                            Cancelar
                        </a>

                        <button
                            type="submit"
                            class="rounded-lg border border-amber-500/70 bg-gradient-to-r from-purple-950 via-purple-800 to-indigo-950 px-6 py-3 font-serif font-bold text-amber-200 shadow-lg transition hover:from-purple-900 hover:via-purple-700 hover:to-indigo-900"
                        >
                            Registrar personagem
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const abilityFields = [
            'strength',
            'dexterity',
            'constitution',
            'intelligence',
            'wisdom',
            'charisma',
        ];

        const classField = document.getElementById('character-class');
        const raceField = document.getElementById('character-race');
        const levelField = document.getElementById('level');
        const hpMaxField = document.querySelector('[name="hp_max"]');
        const hpCurrentField = document.querySelector('[name="hp_current"]');

        let hpWasAutomaticallyFilled = true;

        const modifier = score => Math.floor((Number(score || 10) - 10) / 2);
        const formatModifier = value => value >= 0 ? `+${value}` : `${value}`;

        const proficiencyBonus = level => {
            const normalizedLevel = Math.min(20, Math.max(1, Number(level || 1)));
            return 2 + Math.floor((normalizedLevel - 1) / 4);
        };

        const hitDieByClass = {
            'Bárbaro': 12,
            'Guerreiro': 10,
            'Paladino': 10,
            'Patrulheiro': 10,
            'Bardo': 8,
            'Bruxo': 8,
            'Clérigo': 8,
            'Druida': 8,
            'Ladino': 8,
            'Monge': 8,
            'Feiticeiro': 6,
            'Mago': 6,
        };

        const savingThrowsByClass = {
            'Bárbaro': [
                'strength_save_proficient',
                'constitution_save_proficient',
            ],

            'Bardo': [
                'dexterity_save_proficient',
                'charisma_save_proficient',
            ],

            'Bruxo': [
                'wisdom_save_proficient',
                'charisma_save_proficient',
            ],

            'Clérigo': [
                'wisdom_save_proficient',
                'charisma_save_proficient',
            ],

            'Druida': [
                'intelligence_save_proficient',
                'wisdom_save_proficient',
            ],

            'Feiticeiro': [
                'constitution_save_proficient',
                'charisma_save_proficient',
            ],

            'Guerreiro': [
                'strength_save_proficient',
                'constitution_save_proficient',
            ],

            'Ladino': [
                'dexterity_save_proficient',
                'intelligence_save_proficient',
            ],

            'Mago': [
                'intelligence_save_proficient',
                'wisdom_save_proficient',
            ],

            'Monge': [
                'strength_save_proficient',
                'dexterity_save_proficient',
            ],

            'Paladino': [
                'wisdom_save_proficient',
                'charisma_save_proficient',
            ],

            'Patrulheiro': [
                'strength_save_proficient',
                'dexterity_save_proficient',
            ],
        };

        const savingThrowLabels = {
            'strength_save_proficient': 'Força',
            'dexterity_save_proficient': 'Destreza',
            'constitution_save_proficient': 'Constituição',
            'intelligence_save_proficient': 'Inteligência',
            'wisdom_save_proficient': 'Sabedoria',
            'charisma_save_proficient': 'Carisma',
        };

        const speedByRace = {
            'Humano': '9 m',
            'Anão': '7,5 m',
            'Elfo': '9 m',
            'Halfling': '7,5 m',
            'Draconato': '9 m',
            'Gnomo': '7,5 m',
            'Meio-Elfo': '9 m',
            'Meio-Orc': '9 m',
            'Tiefling': '9 m',
        };

        function applyClassSavingThrows() {
            const selectedClass = classField?.value;
            const classSavingThrows = savingThrowsByClass[selectedClass] ?? [];

            const savingThrowInputs = document.querySelectorAll(
                '[data-saving-throw]'
            );

            savingThrowInputs.forEach(input => {
                const shouldBeProficient = classSavingThrows.includes(input.id);

                input.checked = shouldBeProficient;

                const container = document.getElementById(
                    `${input.id}-container`
                );

                if (container) {
                    container.classList.toggle(
                        'border-purple-800',
                        shouldBeProficient
                    );

                    container.classList.toggle(
                        'bg-purple-100',
                        shouldBeProficient
                    );

                    container.classList.toggle(
                        'shadow-sm',
                        shouldBeProficient
                    );
                }
            });

            const message = document.getElementById(
                'saving-throws-class-message'
            );

            const description = document.getElementById(
                'saving-throws-class-description'
            );

            if (!message || !description) {
                return;
            }

            if (!selectedClass || classSavingThrows.length === 0) {
                message.classList.add('hidden');
                description.textContent = '';
                return;
            }

            const readableNames = classSavingThrows.map(
                field => savingThrowLabels[field]
            );

            description.textContent = `${readableNames.join(' e ')}.`;
            message.classList.remove('hidden');
        }

        function updateCalculations() {
            abilityFields.forEach(field => {
                const input = document.getElementById(field);
                const output = document.getElementById(`${field}-modifier`);

                if (input && output) {
                    output.textContent = formatModifier(modifier(input.value));
                }
            });

            const dexterityModifier = modifier(document.getElementById('dexterity')?.value);
            const wisdomModifier = modifier(document.getElementById('wisdom')?.value);
            const constitutionModifier = modifier(document.getElementById('constitution')?.value);

            const proficiency = proficiencyBonus(levelField?.value);
            const selectedClass = classField?.value;
            const selectedRace = raceField?.value;
            const hitDie = hitDieByClass[selectedClass] ?? null;

            document.getElementById('calculated-proficiency').textContent =
                formatModifier(proficiency);

            document.getElementById('calculated-initiative').textContent =
                formatModifier(dexterityModifier);

            document.getElementById('calculated-passive-perception').textContent =
                10 + wisdomModifier;

            document.getElementById('calculated-hit-die').textContent =
                hitDie ? `d${hitDie}` : '—';

            document.getElementById('calculated-speed').textContent =
                speedByRace[selectedRace] ?? '—';

            const startingHp = hitDie
                ? Math.max(1, hitDie + constitutionModifier)
                : null;

            document.getElementById('calculated-starting-hp').textContent =
                startingHp ?? '—';

            if (startingHp && hpWasAutomaticallyFilled && hpMaxField && hpCurrentField) {
                hpMaxField.value = startingHp;
                hpCurrentField.value = startingHp;
            }
        }

        abilityFields.forEach(field => {
            document.getElementById(field)?.addEventListener('input', updateCalculations);
        });

        classField?.addEventListener('change', () => {
            updateCalculations();
            applyClassSavingThrows();
        });
        raceField?.addEventListener('change', updateCalculations);
        levelField?.addEventListener('input', updateCalculations);

        hpMaxField?.addEventListener('input', () => {
            hpWasAutomaticallyFilled = false;
        });

        hpCurrentField?.addEventListener('input', () => {
            hpWasAutomaticallyFilled = false;
        });

        document.querySelectorAll('[data-saving-throw]').forEach(input => {
            input.addEventListener('change', () => {
                const container = document.getElementById(
                    `${input.id}-container`
                );

                if (!container) {
                    return;
                }

                container.classList.toggle(
                    'border-purple-800',
                    input.checked
                );

                container.classList.toggle(
                    'bg-purple-100',
                    input.checked
                );

                container.classList.toggle(
                    'shadow-sm',
                    input.checked
                );
            });
        });

        const photoInput = document.getElementById('photo');
        const photoPreview = document.getElementById('photo-preview');
        const photoPreviewContainer = document.getElementById(
            'photo-preview-container'
        );

        let currentPreviewUrl = null;

        photoInput?.addEventListener('change', event => {
            const file = event.target.files?.[0];

            if (currentPreviewUrl) {
                URL.revokeObjectURL(currentPreviewUrl);
                currentPreviewUrl = null;
            }

            if (!file || !photoPreview || !photoPreviewContainer) {
                photoPreviewContainer?.classList.add('hidden');

                if (photoPreview) {
                    photoPreview.removeAttribute('src');
                }

                return;
            }

            if (!file.type.startsWith('image/')) {
                photoInput.value = '';
                photoPreviewContainer.classList.add('hidden');
                alert('Selecione um arquivo de imagem válido.');
                return;
            }

            const maximumSize = 5 * 1024 * 1024;

            if (file.size > maximumSize) {
                photoInput.value = '';
                photoPreviewContainer.classList.add('hidden');
                alert('A imagem deve possuir no máximo 5 MB.');
                return;
            }

            currentPreviewUrl = URL.createObjectURL(file);

            photoPreview.src = currentPreviewUrl;
            photoPreviewContainer.classList.remove('hidden');
        });

        updateCalculations();
    });
</script>

</x-app-layout>
