<div x-data="{ index: @entangle('index'), create: @entangle('create') , detail: @entangle('detail')}">

    <div class="pT-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="h2 text-gray-800 leading-tight py-2 border-b-4">
            <div x-show="index">{{ __('commun.tests') }}</div>
            <div x-show="create">{{ __('commun.new_test') }}</div>
            <div x-show="detail">test</div>
        </h2>
    </div>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div x-show="index">
                    @include('livewire.tests.partials.tests-index')
                </div>
            </div>
            <div x-show="create">
                @include('livewire.tests.partials.test-create')
            </div>
            <div x-show="detail">
                @include('livewire.tests.partials.test-show')
            </div>
        </div>
    </div>

    <div wire:click="create" x-show="index">
        <x-buttons.success-round></x-buttons.success-round>
    </div>

</div>
