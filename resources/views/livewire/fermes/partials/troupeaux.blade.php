<div x-data="{ addTroupeau: @entangle('addTroupeau'), herd: @entangle('herd') }">

    <h2 class="h2 mb-3">Les troupeaux</h2>
    @foreach ($ferme->troupeaus as $troupeau)
    <div class="py-3 border-b-4 border-gray-300">
        
        <div class="my-3 flex flex-row gap-5 align-bottom ">
            <img class="w-20" src="{{ url('storage/img/' . $troupeau->espece->icone) }}" alt="espece">
            <img class="w-16" src="{{ url('storage/img/' . $troupeau->production->icone) }}" alt="production">
            <p>{{ $troupeau->effectif }} {{ $troupeau->espece->nom }} </p>
        </div>
        <div class="bg-gray-200  p-3">
            <p class="pb-3 underline">Liste des animaux</p>
            <div class="px-1 grid grid-rows-4 grid-cols-5 grid-flow-col gap-2">
                
                @foreach ($animals as $animal)
                <span>{{ $animal->numero }}</span>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach

    <div x-on:click="addTroupeau = true" class="mt-2 flex flex-row gap-1 items-center group">
        <p class="cursor-pointer text-slate-500 group-hover:text-black"><x-icones.add/></p>
        <p class="cursor-pointer text-slate-600 group-hover:underline group-hover:text-black" >
            Ajouter un troupeau
        </p>
    </div>

    <div class="p-5 md:grid md:grid-cols-2 lg:grid-cols-6 md:gap-2">
        <div class="lg:col-span-3">
            <label>Espece</label>
            <div class="flex flex-row gap-1 flex-wrap">
                @foreach ($especes as $espece)
                <button
                    @if ( array_key_exists('espece', $herd) && $herd['espece'] == $espece->id )
                        class="p-2 shadow-lg shadow-slate-800 border-b-2 border-r-2 border-gray-400 border-t-1 border-l-1"
                    @else
                        class="p-2 cursor-pointer hover:bg-gray-300 active:bg-green-300 focus:border-2 focus:border-green-600"
                    @endif
                >
                <img 
                        class="w-10" 
                        src="{{ url('storage/img/'.$espece->icone)}}" 
                        alt="{{ $espece->nom }}"
                        wire:click="choixEspece({{ $espece }})"
                        >
                </button>
                @endforeach
            </div>
        </div>

        <div class="lg:col-span-2 md:border-l-4 pt-3 md:pt-0 md:pl-2">
            <label>Production</label>
            <div class="flex flex-row gap-1 flex-wrap">
                @foreach ($productions as $production)
                <button
                @if ( array_key_exists('production', $herd) && $herd['production'] == $production->id )
                    class="p-2 shadow-lg shadow-slate-800 border-b-2 border-r-2 border-gray-400 border-t-1 border-l-1"
                @else
                    class="p-2 cursor-pointer hover:bg-gray-300 active:bg-green-300 focus:border-2 focus:border-green-600"
                @endif
            >
                    <img 
                        class="w-10" 
                        src="{{ url('storage/img/'.$production->icone)}}" 
                        alt="{{ $production->nom }}"
                        wire:click="choixProduction({{ $production }})"
                        >
                </button>
                @endforeach
            </div>
        </div>

        <div class="lg:border-l-4 pt-3 lg:pt-0 lg:pl-3 lg:-my-2">
            <x-forms.input type="number" min="0" label="Effectif" model="herd.effectif"/>
        </div>

    </div>

    <div class="p-5">
        <label>Animaux</label>
        <div class="flex flex-row gap-2">
            <input type="number" wire:model = "animal">
            <div 
                class="w-10 p-1 rounded-md bg-gray-500 cursor-pointer hover:invert active:border-2 active:border-spacing-4"
                wire:click="addAnimal"
            >
                <img src="{{ url('storage/img/add.svg')}}" alt="">
            </div>
            @if (array_key_exists('animaux', $herd))
                @foreach ($herd['animaux'] as $animal)
                    <span>{{ $animal }}</span>
                @endforeach
            @endif
        </div>
    </div>

</div>
