<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('commun.new_test') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">

            <div class="p-3 bg-white my-2">
                <h2 class="h2">Elevage et animaux</h2>
                <div class="grid grid-cols-2 gap-4">

                    <x-forms.select-model label="Ferme" field="ferme" :options="$fermes"/>
                    
                        
                    <x-forms.select-model :disabled="($ferme == null) ? 'disabled' : ''" label="Troupeau" field="state.troupeau_id" :options="$troupeaus"/>
                    

                </div>
            </div>

            <div class="p-3 bg-white my-2">
                <h2 class="h2">Dates et Résulats de coproscopie</h2>
                <div class="grid grid-cols-2 gap-4">
                    <x-forms.input-text type="number" label="OPG avant traitement" field="opg0" />
                    <x-forms.input-text type="date" label="Date du traitement" field="T0" />
                    <x-forms.input-text type="number" label="OPG de contrôle" field="opg1" />
                    <x-forms.input-text type="date" label="Date du contrôle" field="T1" />
                </div>
            </div>

@php
    var_dump($state)
@endphp
        </div>
    </div>
</div>