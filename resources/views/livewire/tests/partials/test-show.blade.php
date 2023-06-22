<div class="py-2 bg-transparent">
    <div class=" px-5 bg-slate-100">

        @if ($test != null)
            <div class="mb-3">
                <h2 class="h2">{{ $test->anthelm->nom }}</h2>
                @foreach ($test->anthelm->molecules as $molecule)
                    <h4>{{ mb_convert_case($molecule->nom, MB_CASE_TITLE_SIMPLE) }} @if (!$loop->last)
                            ,
                        @endif
                    </h4>
                @endforeach
            </div>

            <div>
                <img class="w-20" src="{{ url('storage/img/' . $test->troupeau->espece->icone) }}"
                    alt="{{ $test->troupeau->espece->nom }}">
                <p class="font-bold text-lg text-green-700">{{ $test->troupeau->ferme->nom }}
                    ({{ $test->troupeau->nom }})
                </p>
                <p>
                    @if ($test->animals->count() == 0)
                        Aucun animal testé
                    @elseif($test->animals->count() == 1)
                        {{ $test->animals->count() }} animal testé
                    @else
                        {{ $test->animals->count() }} animaux testés
                    @endif
                </p>
                <p>Traitement réalisé le {{ \Carbon\Carbon::parse($test->T0)->format('d/m/Y') }}</p>
            </div>

            <div class="my-3">
                <div class="bg-slate-300 px-2 py-5 rounded-r-full w-12/12 {{ $opg0Long }}">Avant le traitement:
                    {{ $test->opg0 }} opg</div>
            </div>
            <div class="my-3">
                @include('livewire.tests.partials.graph-fer')
            </div>
            <div class="my-3 font-bold text-3xl">{{ $test->efficacite }}% d'efficacité</div>
        @endif

    </div>
    <div class="mt-5 px-5" x-on:click="detail = false">
        <x-buttons.reset-button>
            <x-icones.return /> Retour
        </x-buttons.reset-button>
    </div>
</div>
