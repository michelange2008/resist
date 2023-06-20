<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('commun.all_tests') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            
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
                            @if ($test->efficacite < 95) class="border-b bg-red-200"
                            @else class="border-b bg-green-200" @endif>

                            <td class="whitespace-nowrap px-6 py-4">{{ $test->T0 }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ $test->anthelm->nom }}</td>
                            <td class="whitespace-nowrap px-6 py-4">
                                @foreach ($test->anthelm->molecules as $molecule)
                                    {{ $molecule->nom }}
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <img class="w-12" src="{{ url('storage/img/' . $test->troupeau->espece->icone) }}"
                                    alt="">

                            </td>
                            <td class="whitespace-nowrap px-6 py-4 font-bold text-base">{{ $test->efficacite }} %</td>
                            <td class="whitespace-nowrap px-6 py-4 font-bold text-base"></td>
                            <td class="whitespace-nowrap px-6 py-4 font-bold text-base text-green-900 cursor-pointer"><x-icones.link/></td>

                            <td class="whitespace-nowrap px-6 py-4 font-bold text-base text-red-900 cursor-pointer"><x-icones.del/></td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
