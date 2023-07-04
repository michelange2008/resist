<div x-show="addTroupeau">
    <h2 class="mb-3 h2">@lang('ferme-detail.newTroupeau')</h2>

    <div class="p-5 md:grid md:grid-cols-2 lg:grid-cols-6 md:gap-2">
        <div class="lg:col-span-3">
            <label>@lang('ferme-detail.espece')</label>
            <div class="flex flex-row flex-wrap gap-1">
                @foreach ($especes as $espece)
                    <button
                        @if (array_key_exists('espece', $herd) && $herd['espece'] == $espece->id) class="p-2 border-r-2 border-b-2 border-gray-400 shadow-lg shadow-slate-800 border-t-1 border-l-1"
                @else
                class="p-2 cursor-pointer hover:bg-gray-300 active:bg-green-300 focus:border-2 focus:border-green-600" @endif>
                        <img class="w-10" src="{{ url('storage/img/' . $espece->icone) }}" alt="{{ $espece->nom }}"
                            wire:click="choixEspece({{ $espece }})">
                    </button>
                @endforeach
            </div>
        </div>

        <div class="pt-3 lg:col-span-2 md:border-l-4 md:pt-0 md:pl-2">
            <label>@lang('ferme-detail.production')</label>
            <div class="flex flex-row flex-wrap gap-1">
                @foreach ($productions as $production)
                    <button
                        @if (array_key_exists('production', $herd) && $herd['production'] == $production->id) class="p-2 border-r-2 border-b-2 border-gray-400 shadow-lg shadow-slate-800 border-t-1 border-l-1"
            @else
            class="p-2 cursor-pointer hover:bg-gray-300 active:bg-green-300 focus:border-2 focus:border-green-600" @endif>
                        <img class="w-10" src="{{ url('storage/img/' . $production->icone) }}"
                            alt="{{ $production->nom }}" wire:click="choixProduction({{ $production }})">
                    </button>
                @endforeach
            </div>
        </div>

        <div class="pt-3 lg:border-l-4 lg:pt-0 lg:pl-3 lg:-my-2">
            <x-forms.input type="number" min="0" :label="__('ferme-detail.effectif')" model="herd.effectif" />
        </div>

    </div>

    <div class="p-5">
        <label>@lang('ferme-detail.animaux')</label>
        <div class="flex flex-row gap-2">
            <input class="rounded form-input border-1 focus:active:border-0" wire:model.defer="animal"
                wire:keydown.enter="addAnimal()">
            <div class="p-1 w-10 bg-gray-500 rounded-md cursor-pointer hover:invert active:border-2 active:border-spacing-4"
                wire:click="addAnimal()">
                <img src="{{ url('storage/img/add.svg') }}" alt="add">
            </div>
        </div>
        <div class="flex flex-row gap-3 my-3">
            @foreach ($animaux as $animal)
                <div title="clickez pour supprimer"
                    class="p-1 border-2 cursor-pointer hover:text-red-200 hover:bg-gray-800"
                    wire:click="delAnimal( '{{ $animal }}' )">
                    {{ $animal }}
                </div>
            @endforeach
        </div>
    </div>
    <x-buttons.success-button wire:click.prevent="storeTroupeau({{ $ferme }})">
        <x-icones.edit></x-icones.edit> @lang('commun.save')
    </x-buttons.success-button>
    
    <x-buttons.reset-button x-on:click="addTroupeau = false">
        <x-icones.return></x-icones.return> @lang('commun.cancel')
    </x-buttons.reset-button>
</div>
