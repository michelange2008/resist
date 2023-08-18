<div>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden p-5 text-xl bg-white shadow-sm sm:rounded-lg">
                <div class="flex flex-row gap-3 items-center cursor-pointer">
                    <img class="w-20 invert" src="{{ url('storage/img/ferme.svg') }}" alt="">
                    <h2 class="h2">@lang('ferme-detail.farms_list')</h2>
                </div>
                <div class="my-3">
                    <table class="min-w-full text-sm font-light text-left">
                        <thead class="font-medium border-b">
                            <th class="td">Nom</th>
                            <th class="td">Email (si utilisateur)</th>
                            <th class="td">Commune</th>
                            <th class="td">Troupeaux</th>
                            <th class="td">Tests</th>
                        </thead>
                        <tbody>
                            @foreach ($fermes as $ferme)
                                <tr class="border-b-2 group hover:bg-gray-100">
                                    <td class="align-top cursor-pointer td group-hover:font-bold" 
                                        wire:click="fermeDetail( {{ $ferme }} )"
                                        title="Cliquer pour afficher le détail de cette exploitation">
                                        <p>{{ $ferme->nom }} <span class="inline-block invisible group-hover:visible"><x-icones.eye/></span></p>
                                    </td>
                                    <td class="align-top td">
                                        {{ $ferme->eleveur->name ?? " - " }}
                                    </td>
                                    <td class="align-top td">{{ $ferme->commune->Commune }} ({{ $ferme->commune->Departement}})</td>
                                    <td class="flex flex-row gap-3 td">
                                        @foreach ($ferme->troupeaus as $troupeau)
                                            <img class="p-1 w-10" 
                                                src="{{ url('storage/img/'.$troupeau->espece->icone)}}" 
                                                alt="{{ $troupeau->espece->nom }}"
                                                title="{{ $troupeau->nom}} ( {{ $troupeau->effectif }} )"
                                                >
                                        @endforeach
                                    </td>
                                    <td class="td">
                                        @if ($ferme->tests->count() == 0 )
                                            -
                                        @else
                                            @foreach ($ferme->tests as $test)
                                            <a href=" {{ route('test.show', $test) }} ">
                                                <p class="py-2">
                                                    {{ $test->anthelm->nom }} ({{ $test->efficacite}}%)
                                                </p>
                                            </a>
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
