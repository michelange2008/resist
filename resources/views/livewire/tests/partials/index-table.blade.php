<div class="flex flex-col">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <table class="min-w-full text-left text-sm font-light">
                    <thead class="border-b font-medium">
                        <th scope="col" class="px-6 py-4">Date</th>
                        <th scope="col" class="px-6 py-4">Anthelminthique</th>
                        <th scope="col" class="px-6 py-4">Molécules</th>
                        <th scope="col" class="px-6 py-4">Espece</th>
                        <th scope="col" class="px-6 py-4">Efficacité</th>
                        <th scope="col" class="px-6 py-4">Nombre d'animaux</th>
                        <th scope="col" class="px-6 py-4">Voir</th>
                        <th scope="col" class="px-6 py-4">Suppr</th>
                    </thead>
                    <tbody>
                        @foreach ($tests as $test)
                            <tr
                                @if ($test->efficacite < 95) class="group border-b bg-red-200 hover:bg-red-500 hover:text-white"
                                @else class="group border-b bg-green-200 hover:bg-green-500 hover:text-white" @endif>

                                <td class="td">{{ $test->T0 }}</td>
                                <td class="td">{{ $test->anthelm->nom }}</td>
                                <td class="td">
                                    @foreach ($test->anthelm->molecules as $molecule)
                                        {{ $molecule->nom }}
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </td>
                                <td class="td">
                                    <img class="w-12 group-hover:invert"
                                        src="{{ url('storage/img/' . $test->troupeau->espece->icone) }}"
                                        alt="">

                                </td>
                                <td class="td font-bold text-base">{{ $test->efficacite }} %</td>
                                <td class="td font-bold text-base text-center">
                                    {{ $test->animals()->count() }}
                                </td>
                                <td class="td group-hover:text-white font-bold text-base text-green-900 cursor-pointer">
                                    <div wire:click="show( {{ $test }} )"><x-icones.link/></div>

                                </td>

                                <td 
                                    onclick="confirm('Sûr de vouloir supprimmer cet item ?') || event.stopImmediatePropagation()"
                                    wire:click.prevent="del({{$test}})" class="td group-hover:text-white font-bold text-base text-red-900 cursor-pointer">
                                    <x-icones.del />
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
