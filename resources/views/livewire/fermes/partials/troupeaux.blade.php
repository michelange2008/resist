<div x-data="{
    addTroupeau: @entangle('addTroupeau'),
    herd: @entangle('animaux'),
    open: false,
    effectif: false,
    production: false,
    espece: false
}">
    <div x-show="!addTroupeau">
        <h2 class="h2 mb-3">Les troupeaux</h2>
        @foreach ($ferme->troupeaus as $troupeau)
            <div class="p-3 my-1 bg-gray-200 relative">
                <div class="absolute right-0 px-2 cursor-pointer hover:border-2"
                    title="Cliquez pour supprimer le troupeau"
                    onclick="confirm('Sûr de vouloir supprimmer ce troupeau ?') || event.stopImmediatePropagation()"
                    wire:click.prevent="delTroupeau({{ $troupeau }})">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <div class="my-3 flex flex-row gap-5 align-bottom ">
                    <div class="cursor-pointer" x-on:click="espece = {{ $troupeau->id }}">
                        <img class="w-20" src="{{ url('storage/img/' . $troupeau->espece->icone) }}" alt="espece">
                    </div>
                    <div class="cursor-pointer" x-on:click="production = {{ $troupeau->id }}">
                        <img class="w-16" src="{{ url('storage/img/' . $troupeau->production->icone) }}"
                            alt="production">
                    </div>
                    <div>
                        <p class="cursor-pointer" x-on:click="effectif = {{ $troupeau->id }}">
                            {{ $troupeau->effectif }} {{ $troupeau->espece->nom }}
                        </p>
                        <input x-show="effectif == {{ $troupeau->id }}" type="number" @click.outside="effectif = false"
                            wire:model='herd.effectif' wire:keyup.enter="updateEffectif( {{ $troupeau }} )"
                            x-on:keyup.enter="effectif=false">
                    </div>
                </div>
                <div class="flex flex-row gap-1 flex-wrap" x-show="production=={{ $troupeau->id }}"
                    @click.outside="production = false">

                    @foreach ($productions as $production)
                        <button title="cliquer pour changer de production:"
                            class="p-2 cursor-pointer hover:bg-gray-300 active:bg-green-300">
                            <img class="w-10" src="{{ url('storage/img/' . $production->icone) }}"
                                alt="{{ $production->nom }}"
                                wire:click="updateProduction({{ $troupeau }}, {{ $production }})"
                                x-on:click="production=false">
                        </button>
                    @endforeach
                </div>
                <div class="flex flex-row gap-1 flex-wrap" x-show="espece=={{ $troupeau->id }}"
                    @click.outside="espece = false">
                    @foreach ($especes as $espece)
                        <button class="p-2 cursor-pointer hover:bg-gray-300 active:bg-green-300">
                            <img class="w-10" src="{{ url('storage/img/' . $espece->icone) }}"
                                alt="{{ $espece->nom }}"
                                wire:click="updateEspece({{ $troupeau }}, {{ $espece }})"
                                x-on:click="espece=false">
                        </button>
                    @endforeach
                </div>

                <div class="bg-gray-200  p-3">
                    @if ($troupeau->animals->count() > 1)
                        <p class="pb-3 underline">{{ $troupeau->animals->count() }} animaux</p>
                    @elseif ($troupeau->animals->count() == 1)
                        <p class="pb-3 underline">Un animal</p>
                    @else
                        <p class="pb-3 underline">Aucun animal</p>
                    @endif
                    <div class="px-1 grid grid-flow-row-dense grid-cols-5 gap-2">
                        @foreach ($troupeau->animals as $animal)
                            <div class="flex flex-row gap-2 group">
                                {{ $animal->numero }}
                                @if ($animalTest->where('animal_id', $animal->id)->count() == 0)
                                    <div class="invisible group-hover:visible cursor-pointer" title="supprimer"
                                        onclick="confirm('Sûr de vouloir supprimmer cet animal ?') || event.stopImmediatePropagation()"
                                        wire:click.prevent="delAnimalFromTroupeau({{ $animal }})">
                                        <x-icones.suppr />
                                    </div>
                                @else
                                     <div class="invisible group-hover:visible" title="A participé à un test">
                                        <x-icones.bubble />
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="cursor-pointer text-gray-600 hover:text-black active:underline"
                        x-on:click="open = {{ $troupeau->id }}" x-show="open==false">
                        ajouter ...
                    </div>

                    <div x-show="open == {{ $troupeau->id }}">
                        <p x-on:click="open=false" x-on:keyup.escape="open=false"
                            class="cursor-pointer text-gray-600 hover:text-black active:underline">terminer</p>
                        <input type="text" wire:model="newAnimal"
                            wire:keydown.enter="addAnimalToTroupeau({{ $troupeau }})">
                    </div>
                </div>
            </div>
        @endforeach

        <div x-on:click="addTroupeau = true" class="mt-2 p-1 flex flex-row gap-1 items-center group">
            <div class="cursor-pointer rounded-full p-1 bg-slate-500 text-slate-500 group-hover:invert">
                <img class="w-6" src="{{ url('storage/img/add.svg') }}" alt="add">
            </div>
            <p class="cursor-pointer text-slate-600 group-hover:underline group-hover:text-black">
                Ajouter un troupeau
            </p>
        </div>
    </div>

    @include('livewire.fermes.partials.troupeau-add')
</div>
