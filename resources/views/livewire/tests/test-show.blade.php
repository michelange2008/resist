{{-- Présente le détail d'un test --}}
<div class="mx-auto my-3 max-w-7xl pT-6 sm:px-6 lg:px-8">
    <div class="py-2 bg-transparent">
        <div class="px-5 bg-slate-100">

            @if ($test != null)

                <div class="p-3 my-3 bg-gray-300 sm:w-2/3 md:w-1/2 lg:w-1/3">
                    <p class="italic">Type de test:</p>
                    <p class="px-3 text-lg font-bold">{{ $test->typetest->nom }}</p>
                </div>
                {{-- Anthelminthique utilisé et nom de la/les molécules.s --}}
                <div class="mb-4">
                    <h2 class="h2">{{ $test->anthelm->nom }}</h2>
                    @foreach ($test->anthelm->molecules as $molecule)
                        <h4>{{ mb_convert_case($molecule->nom, MB_CASE_TITLE_SIMPLE) }} @if (!$loop->last)
                                ,
                            @endif
                        </h4>
                    @endforeach
                </div>

                {{-- Nom de l'exploitation avec lien cliquable vers l'exploitation.
            Liste des animaux testés et date du test --}}
                <div class="my-3">
                    <img class="w-20" src="{{ url('storage/img/' . $test->troupeau->espece->icone) }}"
                        alt="{{ $test->troupeau->espece->nom }}">
                    <a href=" {{ route('ferme', $test->troupeau->ferme) }}">
                        <p class="text-lg font-bold text-green-700">{{ $test->troupeau->ferme->nom }}
                            ({{ $test->troupeau->nom }})
                        </p>
                    </a>
                    <p>
                        @if ($test->animals->count() == 0)
                            Aucun animal testé
                        @else
                            @if ($test->animals->count() == 1)
                                {{ $test->animals->count() }} animal testé
                            @else
                                {{ $test->animals->count() }} animaux testés
                                (@include('components.affiche-liste-items', [
                                    'liste' => $test->animals,
                                    'col' => 'numero',
                                ]))
                            @endif
                        @endif
                    </p>
                    <p>Traitement réalisé le {{ \Carbon\Carbon::parse($test->T0)->format('d/m/Y') }}</p>
                </div>

                {{-- Résultat du test --}}
                <div class="my-3">
                    <div class="px-2 py-5 rounded-r-full bg-slate-300 w-12/12">Avant le traitement:
                        {{ $test->opg0 }} opg</div>
                </div>
                <div class="my-3">
                    @include('livewire.tests.partials.graph-fer')
                </div>
                <div class="my-3 text-3xl font-bold">{{ $test->efficacite }}% d'efficacité</div>
            @endif

        </div>

    </div>
</div>
