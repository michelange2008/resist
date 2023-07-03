<h2 class="h2 text-gray-500">Modifier l'exploitation</h2>

<div class="lg:grid lg:grid-cols-2 gap-3">

    <x-forms.input label="Nom de l'exploitation" model="farm.nom"/>

    <x-forms.input type="email" label="Adresse électronique" model="farm.email" />

</div>

@include('components.forms.input-adresse')

<div class="sm:grid grid-cols-2 gap-3">

    <x-forms.input type="number" label="Latitude" model="farm.latitude" />

    <x-forms.input type="number" label="Longitude" model="farm.longitude" />


</div>

<div class="sm:grid sm:grid-cols-2 gap-5  items-center">

    <x-forms.input label="N° EDE" model="farm.ede"/>

    <div class="flex flex-row gap-2 items-center">
        <input class="form-checkbox w-6 h-6 rounded" type="checkbox" wire:model.defer="farm.isBio">
        <img class="w-16" src="{{ url('storage/img/bio.svg') }}" alt="Bio">
    </div>

</div>

<x-buttons.success-button wire:click.prevent="update({{ $ferme }})">
    <x-icones.edit></x-icones.edit> Mettre à jour
</x-buttons.success-button>

<x-buttons.reset-button x-on:click="editFerme = false">
    <x-icones.return></x-icones.return> Annuler
</x-buttons.reset-button>

