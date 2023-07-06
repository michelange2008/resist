<tr
@if ($test->efficacite < 95) class="bg-red-100 border-b group hover:bg-red-500 hover:text-white"
@else class="bg-emerald-100 border-b group hover:bg-emerald-500 hover:text-white" @endif>

<td class="td">{{ \Carbon\Carbon::parse($test->T0)->format('d/m/Y') }}</td>

<td class="td">
    <img class="w-12 group-hover:invert"
        src="{{ url('storage/img/' . $test->troupeau->espece->icone) }}" alt="">
</td>

<td class="font-bold td">{{ $test->anthelm->nom }}</td>

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

<td class="text-base font-bold text-green-900 cursor-pointer td group-hover:text-white">
    <a href="{{ route('test.show', $test)}}">
        <x-icones.link />
    </a>    

</td>

<td onclick="confirm('Sûr de vouloir supprimmer cet item ?') || event.stopImmediatePropagation()"
    wire:click.prevent="del({{ $test }})"
    class="text-base font-bold text-red-900 cursor-pointer td group-hover:text-white">
    <x-icones.del />
</td>

</tr>
