<div x-data="{ index: @entangle('index'), create: @entangle('create'), selectedEspeces: @entangle('selectedEspeces') }">

        {{-- Barre de titre qui change si on est en mode create --}}
    <div class="mx-auto max-w-7xl pT-6 sm:px-6 lg:px-8">
        <h2 class="py-2 leading-tight text-gray-800 border-b-4 h2">
            <div x-show="index">{{ __('tests.tests') }}</div>
            <div x-show="create">{{ __('tests.new_test') }}</div>
        </h2>
    </div>
    {{-- Barre de recherche d'un produit anthelmintique --}}
    <div class="mx-auto my-3 max-w-7xl pT-6 sm:px-6 lg:px-8">
        <input type="text" placeholder="{{ __('commun.anthelm_search') }}" wire:model="search"
            class="w-full rounded form-input border-1 focus:active:border-0">
    </div>
    {{-- Choix des espèces à afficher --}}
    <div class="mx-auto my-3 max-w-7xl pT-6 sm:px-6 lg:px-8">
        <div class="flex flex-row gap-3">

            @foreach ($especes as $espece)
                @if ($espece->tests->count() > 0) {{-- Ne s'affiche que les espèces pour lesquelles il y a un test --}}
                    @if ( in_array($espece->id, $selectedEspeces) )
                        <img class="p-1 w-12 bg-orange-300 rounded-xl cursor-pointer hover:outline hover:outline-2 hover:outline-orange-900 hover:outline-offset-4"
                            wire:click="afficheEspece( {{ $espece }} )"
                            src="{{ url('storage/img/' . $espece->icone) }}" alt="{{ $espece->nom }}"
                            title="{{ __('tests.clic_unselect') }}">
                    @else
                        <img class="p-1 w-12 rounded-xl cursor-pointer hover:outline hover:outline-2 hover:outline-orange-500 hover:outline-offset-4 active:border-orange-700"
                            wire:click="afficheEspece( {{ $espece }} )"
                            src="{{ url('storage/img/' . $espece->icone) }}" alt="{{ $espece->nom }}"
                            title="{{ __('tests.clic_select') }}">
                    @endif
                @endif
            @endforeach
        </div>
    </div>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div x-show="index">
                    @include('livewire.tests.partials.tests-index')
                </div>
            </div>
            <div x-show="create">
                @include('livewire.tests.partials.test-create')
            </div>

        </div>
    </div>

    <div wire:click="create" x-show="index">
        <x-buttons.success-round></x-buttons.success-round>
    </div>

</div>
