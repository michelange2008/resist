<div class="flex flex-col">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <table class="min-w-full text-left text-sm font-light">

                    @include('livewire.tests.partials.tests-index-thead')

                    <tbody>
                        @foreach ($tests as $test)

                            @include('livewire.tests.partials.tests-index-rows')

                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
