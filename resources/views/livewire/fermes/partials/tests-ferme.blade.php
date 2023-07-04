<div class="flex flex-row gap-3 items-center">
    <img class="w-20 invert" src="{{ url('storage/img/tests.svg')}}" alt="">
    <h2 class="mb-3 h2">Les tests</h2>
</div>

<table class="min-w-full text-sm font-light text-left">

    @include('livewire.tests.partials.tests-index-thead')

    @foreach ($ferme->tests as $test)

        @include('livewire.tests.partials.tests-index-rows')
        
    @endforeach

</table>
