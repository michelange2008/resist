<tr
@if ($test->efficacite < 95) class="group border-b bg-red-100 hover:bg-red-500 hover:text-white"
@else class="group border-b bg-emerald-100 hover:bg-emerald-500 hover:text-white" @endif>

<td class="td">{{ \Carbon\Carbon::parse($test->T0)->format('d/m/Y') }}</td>

<td class="td">
    <img class="w-12 group-hover:invert"
        src="{{ url('storage/img/' . $test->troupeau->espece->icone) }}" alt="">
</td>

<td class="td font-bold">{{ $test->anthelm->nom }}</td>

<td class="td">
    @include('components.affiche-liste-items', [
        'liste' => $test->anthelm->molecules,
        'col' => 'nom',
    ])
</td>

<td class="td font-bold text-base">{{ $test->efficacite }} %</td>

<td class="td font-bold text-base text-center">
    {{ $test->animals()->count() }}
</td>

<td class="td group-hover:text-white font-bold text-base text-green-900 cursor-pointer">
    <div wire:click="show( {{ $test }} )">
        <x-icones.link />
    </div>

</td>

<td onclick="confirm('Sûr de vouloir supprimmer cet item ?') || event.stopImmediatePropagation()"
    wire:click.prevent="del({{ $test }})"
    class="td group-hover:text-white font-bold text-base text-red-900 cursor-pointer">
    <x-icones.del />
</td>

</tr>
