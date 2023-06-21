<div class="p-5">

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
    @endif

    <div x-on:click="detail = false">
        <x-buttons.secondary-button>
            <x-icones.return /> Tous les tests
        </x-buttons.secondary-button>
    </div>
</div>
