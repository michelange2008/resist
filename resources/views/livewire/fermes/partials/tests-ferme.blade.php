<h2 class="h2 mb-3">Les tests</h2>

<table class="min-w-full text-left text-sm font-light">

    @include('livewire.tests.partials.tests-index-thead')

    @foreach ($tests as $test)

    @include('livewire.tests.partials.tests-index-rows')

    @endforeach

</table>
