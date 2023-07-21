<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            @lang('tests.tests')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">

                @if ($tests->count() > 0)

                    @include('livewire.tests-user.partials.test-tableau')
                @else
                    <div class="p-5">
                        <h2 class="h2">Désolé</h2>
                        @if (Auth::user()->isEleveur())
                            <p>Il n'y a pas encore de tests de résistance concernant votre exploitation</p>
                        @elseif (Auth::user()->isVeto())
                            <p>Il n'y a pas encore de tests de résistance concernant vos éleveurs</p>
                        @else
                            <p>Il n'y a pas encore de tests de résistance vous concernant</p>
                        @endif
                    </div>

                @endif

            </div>
        </div>
    </div>
</div>
