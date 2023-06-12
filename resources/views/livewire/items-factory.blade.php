<div class="mx-1 md:mx-4 lg:mx-8 xl:mx-12" x-data="{ show: @entangle('change'), update: @entangle('updateMode'), see: @entangle('toShow') }" @click.outside="see = false">

    <x-titres.titre :icone="$iconeModel">{{ $titre }}</x-titres.titre>

    <x-tableau :cols="$cols" :show="$show" :items="$items"></x-tableau>

    {{-- Fenêtre modale qui affiche les détails d'un item --}}
    <x-modal-small>
        <div x-show='see'>
            <x-titres.titre1 :icone="'detail.svg'">Détails</x-titres.titre1>
            <div class="p-3">
                @isset($item)
                    @foreach ($cols as $col => $champ)
                        @if ($champ['type'] == 'select')
                            <p><span class="italic text-gray-600">{{ $champ['label'] }}: </span><span
                                    class="font-bold">{{ $item->{$champ['belongsTo']}->{$champ['coltable']} ?? ' - ' }}</span>
                            </p>
                        @elseif ($champ['type'] == 'date')
                            <p><span class="italic text-gray-600">{{ $champ['label'] }}: </span> <span
                                    class="font-bold">{{ date('d/m/Y', strtotime($item->$col)) }}</span> </p>
                        @else
                            <p><span class="italic text-gray-600">{{ $champ['label'] }}: </span><span
                                    class="font-bold">{{ $item->$col }}</span></p>
                        @endif
                    @endforeach
                @endisset
            </div>
        </div>
        <div class="flex justify-end">
            <x-buttons.cancel-button x-on:click="see = false" :route="'#'">
                <x-icones.close></x-icones.close> Fermer
            </x-buttons.cancel-button>
        </div>
    </x-modal-small>

    @if ($add)
        {{-- Bouton rond situé au bas à droite de l'écran pour ajouter un item --}}
        <x-buttons.success-round wire:click="addModal"></x-buttons.success-round>
    @endif

    {{-- fenêtre modale qui affiche le formulaire pour ajouter ou modifier un item --}}
    <x-modal-custom>

        <form>
            <x-titres.group-titre :updateMode="$updateMode"></x-titres.group-titre>

            @foreach ($cols as $champ)
                @if ($champ['type'] == 'select')
                    <x-forms.select :label="$champ['label']" :field="$champ['col']" :options="$champ['bt_options']"></x-forms.select>
                @elseif ($champ['type'] == 'textarea')

                @elseif ($champ['type'] == 'checkbox')

                @elseif ($champ['type'] == 'id')

                @elseif ($champ['type'] == 'radio')

                @elseif ($champ['type'] == 'file')
                    <x-forms.input-file :label="$champ['label']" :field="$champ['col']"></x-forms.input-file>

                    {{-- @elseif ($champ['type'] == 'number') --}}
                @elseif ($champ['type'] == 'belongsToMany')

                @elseif ($champ['type'] == 'password')
                @else
                    <x-forms.input-text :type="$champ['type']" :label="$champ['label']" :field="$champ['col']"></x-forms.input-text>
                @endif
            @endforeach

            <x-buttons.group-button :updateMode="$updateMode" :id="$item->id ?? ''"></x-buttons.group-button>

        </form>

    </x-modal-custom>

</div>
