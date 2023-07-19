<div class="py-12" 
    x-data="{ 
        selectedVeto: @entangle('selectedVeto'), 
        selectedEleveur: @entangle('selectedEleveur'),
        showVeto: false,
        showEleveur: false
    }">

    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

        <div class="overflow-hidden p-5 text-xl bg-white shadow-sm sm:rounded-lg">
            <div class="flex flex-row gap-3 items-center cursor-pointer">
                <img class="w-20 invert" src="{{ url('storage/img/asso.svg') }}" alt="">
                <h2 class="h2">@lang('asso.liste')</h2>
            </div>
        </div>

        @include('livewire.asso.partials.toggle-eleveur-veto')

        <div x-show="showEleveur" x-cloak>
            @include('livewire.asso.partials.asso-ferme-eleveur')
        </div>

        <div x-show="showVeto" x-cloak>
            @include('livewire.asso.partials.asso-veto-eleveur')
        </div>        

    </div>
</div>
