<div class="my-3">
    <table class="w-full border-2">
        <thead class="bg-slate-900 text-white">
            @foreach ($cols as $col)
                @if ($col['onTable'])
                    <th class="border-2 border-white">{{ $col['label'] }}</th>
                @endif
            @endforeach
            @if ($show)
                <th class="border-2 border-white">Voir</th>
            @endif
            <th class="border-2 border-white">Modif.</th>
            <th class="border-2 border-white">Supp.</th>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr class="border-2">
                    @foreach ($cols as $field => $col)
                        @if ($col['onTable'])

                            @if ($col['type'] == 'select')
                                <td class="p-2 border-2">
                                    @if ($col['bt_type'] == 'img')
                                        <img class="w-12 m-auto" 
                                            src="{{ url('storage/img/' . $item->{$col['belongsTo']}->{$col['bt_col_display']}) }}" 
                                            alt="{{ $item->{$col['belongsTo']}->{$col['bt_col']} }}">
                                    @else
                                        {{ $item->{$col['belongsTo']}->{$col['bt_col']} ?? ' - ' }}
                                    @endif
                                </td>

                            @elseif ($col['type'] == 'bool')
                                <td class="p-2 border-2 text-{{ $col['align'] }}">
                                    @if ($item->{$col['col']})
                                        Oui
                                    @else
                                        Non
                                    @endif
                                </td>

                            @elseif ($col['type'] == 'date')
                                <td class="p-2 border-2 text-{{ $col['align'] }}">
                                    {{ date('d/m/Y', strtotime($item->$field)) }} 
                                </td>

                            @elseif ($col['type'] == 'file')
                                <td class="p-2 border-2">
                                    <div class="flex justify-{{ $col['align'] }}">
                                        <img class="w-8" src="{{ url('storage/img/' . $item->$field) }}"
                                            alt="{{ $item->$field }}">
                                    </div>
                                </td>

                            @elseif($col['type'] == 'belongsToMany')
                                <td class="p-2 border-2">
                                    @if ($item->{$col['belongsToMany']} != null)
                                        @foreach ($item->{$col['belongsToMany']} as $relative)
                                            {{ $relative->{$col['btm_col']} }}
                                            @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    @endif
                                </td>

                            @elseif ($col['type'] == "hasMany")
                            <td class="p-2 border-2">
                                @foreach ($item->{$col['btm_table']} as $btm)
                                    <p>{{$btm->{$col['btm_col']} }}</p>
                                @endforeach
                            </td>
                       
                            @else

                                <td class="p-2 border-2 text-{{ $col['align'] }}">{{ $item->$field }} </td>

                            @endif
                        @endif
                    @endforeach

                    @if ($show)
                        <td class="p-2 border-2 text-center">
                            <x-buttons.see-small-button x-on:click="see = true"
                                wire:click.prevent="show({{ $item->id }})">
                            </x-buttons.see-small-button>
                        </td>
                    @endif

                    <td class="p-2 border-2 text-center">
                        <x-buttons.edit-small-button x-on:click="show = !show, see = false"
                            wire:click.prevent="edit({{ $item->id }})">
                        </x-buttons.edit-small-button>
                    </td>
                    <td class="p-2 border-2 text-center ">
                        <x-buttons.del-small-button
                            onclick="confirm('Sûr de vouloir supprimmer cet item ?') || event.stopImmediatePropagation()"
                            wire:click.prevent="delete({{ $item->id }})">
                        </x-buttons.del-small-button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
