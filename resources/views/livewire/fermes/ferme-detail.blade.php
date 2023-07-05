<div x-data="{ editFerme: @entangle('editFerme') }">
    <x-slot name="header">

    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden p-5 text-xl bg-white shadow-sm sm:rounded-lg">
                <div x-show="!editFerme">
                    @include('livewire.fermes.partials.ferme-show')
                </div>

                <div x-show="editFerme">
                    @include('livewire.fermes.partials.ferme-edit')
                </div>

            </div>

            <div class="overflow-hidden p-5 my-3 text-xl bg-white shadow-sm sm:rounded-lg">

                @include('livewire.fermes.partials.troupeaux')

            </div>

            @if ($ferme->tests->count() > 0)
                <div class="overflow-hidden p-5 my-3 text-xl bg-white shadow-sm sm:rounded-lg">
                    @include('livewire.fermes.partials.tests-ferme')
                </div>

            @else
                <div class="overflow-hidden p-5 my-3 text-xl bg-white shadow-sm sm:rounded-lg">
                    <h2 class="h2">Pas encore de test réalisé</h2>
                </div>

            @endif

            <div class="overflow-hidden p-5 my-3 text-xl bg-white shadow-sm sm:rounded-lg">
                
                <x-buttons.cancel-button :route="route('fermes')" ><x-icones.return/>Retour à la liste des exploitations</x-buttons.cancel-button>

        </div>
    </div>
</div>
