{{-- Partie de la page associations qui permet d'associer une ferme à un éleveur (et un seul) --}}
<div class="pb-3 my-3 border-y-4"">
    <div class="flex flex-row gap-3 px-3 pt-3 pb-4 my-3 text-2xl bg-slate-400">
        <img class="w-8" src="{{ url('storage/img/eleveur.svg')}}" alt="Véto">
        <h1>@lang('asso.assoFerme')</h1>
    </div>  
    {{-- Liste des éleveurs --}}
    <div class="grid grid-cols-2 gap-5 px-3">
            @if ($selectedEleveur == null)
                <h2 class="h2">@lang('asso.choixEleveur')</h2>
            @else
                <div title="{{ __('asso.unselectEleveur')}}"
                x-on:click="selectedEleveur=null"
                class="w-8 h-8 bg-orange-500 rounded-full border-4 border-orange-500 cursor-pointer hover:bg-orange-800 hover:border-orange-800 active:outline active:outeline-offset-2 active:outline-orange-800 active:outline-offset-2 active:border-none"></div>
            @endif
        <div>
            @if ($selectedEleveur != null)
                <h2 class="h2">@lang('asso.clickFerme') {{ $selectedEleveur->name ?? '' }}</h2>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-2 gap-5 px-3">
        <div>
            {{-- Il est possible de cliquer sur un éleveur pour le sélectionner et lui associer une ferme --}}
            @foreach ($eleveurs as $eleveur)
                <div class="p-5 my-3 cursor-grab active:outline active:outline-offset-2 active:outline-orange-700 active:cursor-grabbing
                    @if ($selectedEleveur != null && $selectedEleveur == $eleveur )
                        bg-orange-900 text-white
                    @else 
                        bg-orange-200
                    @endif " 
                    x-on:click="selectedVeto = null"
                    wire:click="selectEleveurToAddFerme( {{ $eleveur }} )">
                    {{ $eleveur->name }}
                    @foreach ($fermes->where('eleveur_id', $eleveur->id) as $ferme)
                            <p class="m-2" >{{ $ferme->nom }}</p>
                    @endforeach
                </div>
            @endforeach
        </div>
        {{-- liste de fermes pour cliquer dessus et l'associer à l'éleveur sélectionné --}}
        <div class=" @if($selectedEleveur == null) invisible @endif">
            @foreach ($fermes as $ferme)
                <div class="p-5 my-3 border 
                @if($ferme->eleveur_id != null) text-gray-500 @else font-bold @endif
                @if($selectedEleveur != null) cursor-grab hover:bg-gray-300 active:cursor-grabbing active:bg-gray-600 active:text-white @endif"
                    wire:click="addFermeToEleveur( {{ $ferme }} )">
                    {{ $ferme->nom }} 
                    @if ($ferme->eleveur_id != null)
                    ({{ $ferme->eleveur->name }})
                    @endif
                </div>
            @endforeach
        </div>
        
    </div>
</div>
