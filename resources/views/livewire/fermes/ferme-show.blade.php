<div x-data = "{ edit: @entangle('edit') }">
    <x-slot name="header">

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-5 bg-white overflow-hidden shadow-sm sm:rounded-lg text-xl">

                @include('livewire.fermes.partials.exploitation')

            </div>

            <div class="my-3 p-5 bg-white overflow-hidden shadow-sm sm:rounded-lg text-xl">

                @include('livewire.fermes.partials.troupeaux')

            </div>

            <div class="my-3 p-5 bg-white overflow-hidden shadow-sm sm:rounded-lg text-xl">

                @include('livewire.fermes.partials.tests-ferme')

            </div>

        </div>
    </div>
</div>