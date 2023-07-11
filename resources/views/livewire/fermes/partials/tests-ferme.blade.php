<div class="flex flex-row gap-3 items-center">
    <img class="w-20 invert" src="{{ url('storage/img/tests.svg') }}" alt="">
    <h2 class="mb-3 h2">@lang('ferme-detail.tests')</h2>
</div>

<table class="min-w-full text-sm font-light text-left">

    <thead class="font-medium border-b">

        <th scope="col" class="px-6 py-4">@lang('commun.date')</th>

        <th scope="col" class="px-6 py-4">@lang('tests.typetest')</th>

        <th scope="col" class="px-6 py-4">@lang('tests.anthelm')</th>
        
        <th scope="col" class="px-6 py-4">@lang('tests.molecules')</th>
        
        <th scope="col" class="px-6 py-4">@lang('tests.efficacite')</th>
        
        <th scope="col" class="px-6 py-4">@lang('ferme-detail.troupeau')</th>

        <th scope="col" class="px-6 py-4">@lang('tests.nb_ax')</th>

    </thead>


    <tbody>

        @foreach ($ferme->tests as $test)
            <tr
                @if ($test->efficacite < 95) class="bg-red-100 border-b"
                @else class="bg-emerald-100 border-b" @endif>

                <td class="td">{{ \Carbon\Carbon::parse($test->T0)->format('d/m/Y') }}</td>

                <td class="text-base font-bold td">{{ $test->typetest->nom }}</td>

                <td class="font-bold td hover:text-base">
                    <a href="{{ route('test.show', $test) }}" title="Cliquer pour voir le détail...">
                        {{ $test->anthelm->nom }}
                    </a>
                </td>
                
                <td class="td">
                    @include('components.affiche-liste-items', [
                        'liste' => $test->anthelm->molecules,
                        'col' => 'nom',
                        ])
                </td>
                
                <td class="text-base font-bold td">{{ $test->efficacite }} %</td>
                
                <td class="td">
                    <img class="p-1 w-12" src="{{ url('storage/img/' . $test->troupeau->espece->icone) }}"
                        alt="{{ $test->troupeau->espece->nom }}" title="{{ $test->troupeau->nom }}">
                </td>

                <td class="text-base font-bold text-center td">
                    {{ $test->animals()->count() }}
                </td>

            </tr>
        @endforeach

    </tbody>
</table>
