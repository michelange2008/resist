<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('commun.tests') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ detail: @entangle('detail')}">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div x-show="!detail">
                    @include('livewire.tests.partials.index-table')
                </div>
                <div x-show="!detail">
                    @include('livewire.tests.partials.test-show')
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('test.create') }}">
        <x-buttons.success-round></x-buttons.success-round>
    </a>

</div>
