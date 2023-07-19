<div class="flex flex-col">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <table class="min-w-full text-sm font-light text-left">

                    <thead class="font-medium border-b" x-data="{orderBy: @entangle('orderBy')}">

                        <th scope="col" class="px-6 py-4">
                            <p class="inline-block">@lang('commun.date')</p>
                            <div class="inline-block cursor-pointer" wire:click="sort('T0')">
                                <x-icones.sort />
                            </div>

                        </th>

                        <th scope="col" class="hidden px-6 py-4 lg:table-cell">
                            <p class="inline-block">@lang('tests.typetest')</p>
                            <div class="inline-block cursor-pointer" wire:click="sort('typetest_id')">
                                <x-icones.sort />
                            </div>

                        </th>

                        @if (Auth::user()->role->nom == 'veto')
                            <th scope="col" class="px-6 py-4">Ferme</th>
                        @else
                            
                        @endif

                        <th scope="col" class="flex flex-row px-6 py-4">@lang('commun.espece')</th>

                        <th scope="col" class="px-6 py-4">
                            <p class="inline-block">@lang('tests.anthelm')</p>
                            <div class="inline-block cursor-pointer" wire:click="sort('anthelm_id')">
                                <x-icones.sort />
                            </div>
                        </th>

                        <th scope="col" class="hidden px-6 py-4 lg:table-cell">@lang('tests.molecules')</th>

                        <th scope="col" class="px-6 py-4">
                            <p class="inline-block">@lang('tests.efficacite')</p>
                            <div class="inline-block cursor-pointer" wire:click="sort('efficacite')">
                                <x-icones.sort />
                            </div>
                        </th>


                    </thead>

                    <tbody>

                        @foreach ($tests as $test)
                            <tr
                                @if ($test->efficacite < 95) class="bg-red-100 border-b"
                                @else class="bg-emerald-100 border-b" @endif>

                                <td class="td">{{ \Carbon\Carbon::parse($test->T0)->format('d/m/Y') }}</td>

                                <td class="hidden text-base font-bold td lg:table-cell">{{ $test->typetest->nom }}</td>

                                @if (Auth::user()->role->nom == 'veto')
                                    
                                <td class="td">{{ $test->troupeau->ferme->nom }} </td>

                                @endif

                                <td class="td">
                                    <img class="p-1 w-12"
                                        src="{{ url('storage/img/' . $test->troupeau->espece->icone) }}"
                                        alt="{{ $test->troupeau->espece->nom }}">
                                </td>

                                <td class="font-bold td hover:text-base">
                                    <a href="{{ route('test.show', $test) }}" title="{{ __('commun.clic_detail') }}">
                                        {{ $test->anthelm->nom }}
                                    </a>
                                </td>

                                <td class="hidden td lg:table-cell">
                                    @include('components.affiche-liste-items', [
                                        'liste' => $test->anthelm->molecules,
                                        'col' => 'nom',
                                    ])
                                </td>

                                <td class="text-base font-bold td">{{ $test->efficacite }} %</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

