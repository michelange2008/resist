<h2 class="text-gray-500 h2">@lang('ferme-detail.farmEdit')</h2>

<div class="gap-3 lg:grid lg:grid-cols-2">

    <x-forms.input :label="__('ferme-detail.farmName')" model="farm.nom"/>

    <x-forms.input type="email" :label="__('ferme-detail.mail')" model="farm.email" />

</div>

@include('components.forms.input-adresse')

<div class="grid-cols-2 gap-3 sm:grid">

    <x-forms.input type="number" :label="__('ferme-detail.lat')" model="farm.latitude" />

    <x-forms.input type="number" :label="__('ferme-detail.long')" model="farm.longitude" />


</div>

<div class="gap-5 items-center sm:grid sm:grid-cols-2">

    <x-forms.input :label="__('ferme-detail.ede')" model="farm.ede"/>

    <div class="flex flex-row gap-2 items-center">
        <input class="w-6 h-6 rounded form-checkbox" type="checkbox" wire:model.defer="farm.isBio">
        <img class="w-16" src="{{ url('storage/img/bio.svg') }}" alt="Bio">
    </div>

</div>

<x-buttons.success-button wire:click.prevent="update({{ $ferme }})">
    <x-icones.edit></x-icones.edit> @lang('commun.update')
</x-buttons.success-button>

<x-buttons.reset-button x-on:click="editFerme = false">
    <x-icones.return></x-icones.return> @lang('commun.cancel')
</x-buttons.reset-button>

