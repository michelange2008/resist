<div x-data="{ index: @entangle('index'), create: @entangle('create') }">

    <div class="mx-auto max-w-7xl pT-6 sm:px-6 lg:px-8">
        <h2 class="py-2 leading-tight text-gray-800 border-b-4 h2">
            <div x-show="index">{{ __('tests.tests') }}</div>
            <div x-show="create">{{ __('tests.new_test') }}</div>
        </h2>
    </div>

    <div class="mx-auto my-3 max-w-7xl pT-6 sm:px-6 lg:px-8">
        <input type="text" placeholder="Chercher un produit ..." wire:model="search"
            class="w-full rounded form-input border-1 focus:active:border-0">
    </div>

    <div class="mx-auto my-3 max-w-7xl pT-6 sm:px-6 lg:px-8">
        <p class="mb-2">Choix de l'espèce:</p>
        <div class="flex flex-row gap-3">
            <img class="p-1 w-12 rounded cursor-pointer hover:invert hover:bg-gray-400 hover:drop-shadow-lg"
                wire:click="getTests()" src="{{ url('storage/img/all.svg') }}" alt="Toutes les espèces"
                title="Toutes les espèces">
            @foreach ($especes as $espece)
                @if ($espece->tests->count() > 0)
                    <img class="p-1 w-12 rounded cursor-pointer hover:invert hover:bg-gray-400 hover:drop-shadow-lg"
                        wire:click="afficheEspece( {{ $espece }} )"
                        src="{{ url('storage/img/' . $espece->icone) }}" alt="{{ $espece->nom }}">
                {{-- @else
                    <img class="p-1 w-12"
                    src="{{ url('storage/img/' . $espece->icone) }}" alt="{{ $espece->nom }}"> --}}
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
