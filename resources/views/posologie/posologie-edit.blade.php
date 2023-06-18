<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $anthelm->nom }} ({{ $anthelm->laboratoire->nom }})
            <img class="w-20" src="{{ url('storage/img/' . $espece->icone) }}" alt="{{ $espece->icone }}">
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('posologie.update')}}" method="POST">
                @method('POST')
                @csrf
                <input type="hidden" name="anthelm_id" value="{{$anthelm->id}}">
                <input type="hidden" name="espece_id" value="{{$espece->id}}">
                <x-forms.input-classic name="voie" label="Voie d'administration (choisir une de ces valeurs: IM, SC, PO, VO)" :value="$detail_anthelm->pivot->voie"></x-forms.input-classic>
                <x-forms.input-classic name="posologie" label="Posologie (exemple: 20 ml/ 50 kg)" :value="$detail_anthelm->pivot->posologie"></x-forms.input-classic>
                <x-forms.input-classic name="lait" label="Temps d'attente lait (exemple: 108 heures ou 2 jours)" :value="$detail_anthelm->pivot->lait"></x-forms.input-classic>
                <x-forms.input-classic name="viande" label="Temps d'attente viande (en jours)" :value="$detail_anthelm->pivot->viande"></x-forms.input-classic>
                
                <x-buttons.success-button><x-icones.edit/> Enregistrer</x-buttons.success-button>
                <x-buttons.cancel-button :route="route('posologie.index')"><x-icones.return/> Annuler</x-buttons.cancel-button>
            </form>
        </div>
    </div>
</x-app-layout>
