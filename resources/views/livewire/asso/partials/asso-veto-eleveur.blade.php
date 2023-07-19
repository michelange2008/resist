{{-- Partie de la page associations qui permet d'associer une ou plusieurs fermes à un vétérinaire (et un seul) --}}
<div class="pb-3 my-3 border-y-4">

    <div class="flex flex-row gap-3 px-3 pt-3 pb-4 my-3 text-2xl bg-slate-400">
        <img class="w-8" src="{{ url('storage/img/veto.svg')}}" alt="Véto">
        <h1>@lang('asso.assoVeto')</h1>
    </div>
    {{-- Liste des éleveurs --}}
    <div class="grid grid-cols-2 gap-5 px-3">
            @if ($selectedVeto == null)
                <h2 class="h2">@lang('asso.choixVeto')</h2>
            @else
                <div title="{{ __('asso.unselectVeto')}}"
                x-on:click="selectedVeto=null"
                class="w-8 h-8 bg-orange-500 rounded-full border-4 border-orange-500 cursor-pointer hover:bg-orange-800 hover:border-orange-800 active:outline active:outeline-offset-2 active:outline-orange-800 active:outline-offset-2 active:border-none"></div>
            @endif
        <div>
            @if ($selectedVeto != null)
                <h2 class="h2">@lang('asso.clickFerme') {{ $selectedVeto->name ?? '' }}</h2>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-2 gap-5 px-3">
        <div>
            {{-- Il est possible de cliquer sur un vétérinaire pour le sélectionner et lui associer une ferme --}}
            @foreach ($vetos as $veto)
                <div class="p-5 my-3 cursor-grab active:outline active:outline-offset-2 active:outline-orange-700 active:cursor-grabbing
                    @if ($selectedVeto != null && $selectedVeto == $veto )
                        bg-orange-900 text-white
                    @else 
                        bg-orange-200
                    @endif " 
                    wire:click="selectVetoToAddFerme( {{ $veto }} )"
                    x-on:click="selectedEleveur=null">
                    <p class="font-bold">{{ $veto->name }}</p>
                    @foreach ($fermes->where('veto_id', $veto->id) as $ferme)
                            <p class="px-2 m-2 text-sm" >{{ $ferme->nom }}</p>
                    @endforeach
                </div>
            @endforeach
        </div>
        {{-- liste de fermes pour cliquer dessus et l'associer au vétérinaire sélectionné --}}
        <div class=" @if($selectedVeto == null) invisible @endif">
            @foreach ($fermes as $ferme)
                <div class="p-5 my-3 border 
                @if($ferme->veto_id != null) text-gray-500 @else font-bold @endif
                @if($selectedVeto != null) cursor-grab hover:bg-gray-300 active:cursor-grabbing active:bg-gray-600 active:text-white @endif"
                    wire:click="addFermeToVeto( {{ $ferme }} )">
                    {{ $ferme->nom }} 
                    @if ($ferme->veto_id != null)
                    ({{ $ferme->veto->name }})
                    @endif
                </div>
            @endforeach
        </div>
        
    </div>
</div>
