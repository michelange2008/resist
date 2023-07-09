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

                        <th scope="col" class="flex flex-row px-6 py-4">@lang('commun.espece')</th>

                        <th scope="col" class="px-6 py-4">
                            <p class="inline-block">@lang('tests.anthelm')</p>
                            <div class="inline-block cursor-pointer" wire:click="sort('anthelm_id')">
                                <x-icones.sort />
                            </div>
                        </th>

                        <th scope="col" class="px-6 py-4">@lang('tests.molecules')</th>

                        <th scope="col" class="px-6 py-4">
                            <p class="inline-block">@lang('tests.efficacite')</p>
                            <div class="inline-block cursor-pointer" wire:click="sort('efficacite')">
                                <x-icones.sort />
                            </div>
                        </th>

                        <th scope="col" class="px-6 py-4">@lang('tests.nb_ax')</th>

                        <th scope="col" class="px-6 py-4">@lang('commun.suppr')</th>
                    </thead>

                    <tbody>

                        @foreach ($tests as $test)
                            <tr
                                @if ($test->efficacite < 95) class="bg-red-100 border-b"
                                @else class="bg-emerald-100 border-b" @endif>

                                <td class="td">{{ \Carbon\Carbon::parse($test->T0)->format('d/m/Y') }}</td>

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

                                <td class="td">
                                    @include('components.affiche-liste-items', [
                                        'liste' => $test->anthelm->molecules,
                                        'col' => 'nom',
                                    ])
                                </td>

                                <td class="text-base font-bold td">{{ $test->efficacite }} %</td>

                                <td class="text-base font-bold text-center td">
                                    {{ $test->animals()->count() }}
                                </td>

                                <td class="m-auto text-base font-bold text-red-900 cursor-pointer td"
                                    title="{{ __('commun.clic_del') }}">

                                    <x-confirm_del :test="$test" />
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

