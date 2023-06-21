<form wire:submit.prevent="save">
    <div class="p-3 bg-white my-2">
        <h2 class="h2">Elevage et animaux</h2>
        <div class="grid grid-cols-2 gap-4">

            <x-forms.select-model label="Ferme" field="ferme" :options="$fermes" :selected="$ferme->id ?? '' " />

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

    <div class="m-3">
        <x-buttons.success-button>
            <x-icones.save /> Enregistrer
        </x-buttons.success-button>
        <x-buttons.cancel-button :route="route('tests.index')">
            <x-icones.return/> Annuler
        </x-buttons.cancel-button>
    </div>
</form>
