<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('commun.new_test') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-3 bg-white my-2">
                <h2 class="h2">
                    Efficacité:
                    @if ($efficacite === null)
                        <span class="text-slate-600">...</span>
                    @elseif ($efficacite >= 95)
                        <span class="font-bold text-green-700">{{ $efficacite }} %</span>
                    @else
                        <span class="font-bold text-red-700">{{ $efficacite }} %</span>
                    @endif
                </h2>

            </div>
            <form wire:submit.prevent="save">
                <div class="p-3 bg-white my-2">
                    <h2 class="h2">Elevage et animaux</h2>
                    <div class="grid grid-cols-2 gap-4">

                        <x-forms.select-model label="Ferme" field="ferme" :options="$fermes" />

                        <x-forms.select-model :disabled="$ferme == null ? 'disabled' : ''" label="Troupeau" field="troupeau_id"
                            :options="$troupeaus" />


                    </div>
                    <p>Animaux</p>
                    @if ($troupeau_id != null)

                        @foreach ($animals as $animal)
                            <div>

                                <input id="animal_{{ $animal->id }}" type="checkbox"
                                    wire:model="ax.{{ $animal->id }}" value="{{ $animal->id }}">
                                <label for="animal_{{ $animal->id }}">{{ $animal->numero }} </label>

                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="p-3 bg-white my-2">
                    <h2 class="h2">Dates et Résulats de coproscopie</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <x-forms.input type="number" min="0" label="OPG avant traitement" field="opg0" />
                        <x-forms.input type="date" label="Date du traitement" field="T0" />
                        <x-forms.input type="number" min="0" label="OPG de contrôle" field="opg1" />
                        <x-forms.input type="date" label="Date du contrôle" field="T1" />
                    </div>
                </div>

                <div class="p-3 bg-white my-2">
                    <h2 class="h2">Médicament utilisé</h2>
                    <x-forms.select-model label="Médicament" field="anthelm_id" :options="$anthelms" />

                </div>

                <x-buttons.success-button>
                    <x-icones.save /> Enregistrer
                </x-buttons.success-button>
        </div>
        </form>
    </div>
</div>
