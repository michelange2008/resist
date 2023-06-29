<div x-data="{ addTroupeau: false }">

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

    <div class="p-5">
        <div>
            <label for="especes">Espece</label>
            <div class="flex flex-row gap-3">
                @foreach ($especes as $espece)
                <button class="p-3 cursor-pointer hover:bg-gray-300 active:bg-green-300 focus:border-2 focus:border-green-600">
                    <img 
                        class="w-12" 
                        src="{{ url('storage/img/'.$espece->icone)}}" 
                        alt="{{ $espece->nom }}"
                        wire:click="choixEspece({{ $espece }})"
                        >
                </button>
                @endforeach
            </div>
        </div>
    </div>
</div>
