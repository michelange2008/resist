<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('commun.test_du_avec', [
            'anthelm' => $test->anthelm->nom,
            'date' => $test->T0,
        ]) }}
    </h2>
</x-slot>

<div class="py-12">
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

            @include('livewire.tests.partials.efficacite')

            @include('livewire.tests.partials.create-edit')

        </div>

    </div>

</div>
