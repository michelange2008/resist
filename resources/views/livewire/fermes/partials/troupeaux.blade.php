{{-- Partie de la page ferme-detail qui affiche toutes les infos sur les troupeaux de la fermer
    avec la possibilité d'en ajouter, supprimer (sauf s'ils ont inclus dans un test), de les modifier
    d'ajouter ou de supprimer des animaux (suaf aussi s'ils sont inclus dans un test) --}}
<div x-data="{
    addTroupeau: @entangle('addTroupeau'),
    herd: @entangle('animaux'),
    open: false,
    nom: false,
    effectif: false,
    production: false,
    espece: false
    }"
>
    <div x-show="!addTroupeau">
        <div class="flex flex-row gap-3 items-center">
            <img class="w-20 invert" src="{{ url('storage/img/troupeaux.svg')}}" alt="">
            <h2 class="mb-3 h2">@lang('ferme-detail.troupeaux')</h2>
        </div>

        @foreach ($ferme->troupeaus as $troupeau)
            <div class="relative p-3 my-1 bg-gray-200">
                {{-- Icones à droite de chaque troupeau pour le supprimer ou informer qu'il est inclus
                dans un test donc non supprimable --}}
                @if ($troupeau->tests->count() == 0)
                    <div class="absolute right-0 px-2 cursor-pointer hover:border-2"
                        title="Cliquez pour supprimer le troupeau"
                        onclick="confirm('Sûr de vouloir supprimmer ce troupeau ?') || event.stopImmediatePropagation()"
                        wire:click.prevent="delTroupeau({{ $troupeau }})">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                @else
                    <div class="absolute right-0 px-2 cursor-help"
                        title="Ce troupeau est inclu dans un test">
                        <x-icones.bubble/>
                    </div>
                @endif
                
                {{-- Nom du troupeau avec un input non visible pour le modifier --}}
                <p class="cursor-pointer" x-show="!nom" x-on:click="nom = {{$troupeau->id }}">
                    {{ $troupeau->nom }}
                </p>
                <input type='text' x-show="nom == {{ $troupeau->id }}" @click.outside="nom = false"
                    wire:model="herd.nom" wire:keyup.enter="updateNomTroupeau( {{ $troupeau }} )" 
                    x-on:keyup.enter="nom=false" x-cloak/>
                
                {{-- Affichage sous fourme d'icone de l'espece et de la production, 
                et l'effectif sous forme de chiffre. 
                En cliquant dessus on peut les modifier (cf comment du dessous) --}}
                <div class="flex flex-row gap-5 my-3 align-bottom">
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
                        {{-- champ pour modifier l'effectif après avoir cliqué sur l'effectif --}}
                        <input x-show="effectif == {{ $troupeau->id }}" type="number" @click.outside="effectif = false"
                            wire:model='herd.effectif' wire:keyup.enter="updateEffectif( {{ $troupeau }} )"
                            x-on:keyup.enter="effectif=false" x-cloak>
                    </div>
                </div>
                {{-- Affichage des icones "espece" ou "production" pour en changer après avoir cliquer
                sur l'icone de l'espèce ou de la production --}}
                <div class="flex flex-row flex-wrap gap-1" x-show="production=={{ $troupeau->id }}"
                    @click.outside="production = false" x-cloak>
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

                {{-- Effectif du troupeau avec un input non visible pour pouvoir le modifier --}}
                <div class="flex flex-row flex-wrap gap-1" x-show="espece=={{ $troupeau->id }}"
                    @click.outside="espece = false" x-cloak>
                    @foreach ($especes as $espece)
                        <button class="p-2 cursor-pointer hover:bg-gray-300 active:bg-green-300">
                            <img class="w-10" src="{{ url('storage/img/' . $espece->icone) }}"
                                alt="{{ $espece->nom }}"
                                wire:click="updateEspece({{ $troupeau }}, {{ $espece }})"
                                x-on:click="espece=false">
                        </button>
                    @endforeach
                </div>

                {{-- Affichage de la liste des animaux avec possibilité de les supprimer
                    (sauf s'ils sont inclus dans un test) --}}
                <div class="p-3 bg-gray-200">
                    @if ($troupeau->animals->count() > 1)
                        <p class="pb-3 underline">{{ $troupeau->animals->count() }} @lang('ferme-detail.animaux')</p>
                    @elseif ($troupeau->animals->count() == 1)
                        <p class="pb-3 underline">@lang('ferme-detail.un_animal')</p>
                    @else
                        <p class="pb-3 underline">@lang('ferme-detail.no_animal')</p>
                    @endif
                    <div class="grid grid-cols-5 grid-flow-row-dense gap-2 px-1">
                        @foreach ($troupeau->animals as $animal)
                            <div class="flex flex-row gap-2 group">
                                {{ $animal->numero }}
                                {{-- Si pas inclus dans un test on peut les supprimer --}}
                                @if ($animal->tests->count() == 0)
                                    <div class="invisible cursor-pointer group-hover:visible" title="supprimer"
                                        onclick="confirm('Sûr de vouloir supprimmer cet animal ?') || event.stopImmediatePropagation()"
                                        wire:click.prevent="delAnimalFromTroupeau({{ $animal }})">
                                        <x-icones.suppr />
                                    </div>
                                {{-- Sinon on affiche l'information de la participation à un test --}}
                                @else
                                    <div class="invisible cursor-help group-hover:visible" title="A participé à un test">
                                        <x-icones.bubble />
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    {{-- Permet d'ajouter des animaux à la volée quand on clique sur ajouter
                    affichage d'un champs input qui enregistre à chaque clic sur enter --}}
                    <div class="text-gray-600 cursor-pointer hover:text-black active:underline"
                        x-on:click="open = {{ $troupeau->id }}" x-show="open==false">
                        @lang('ferme-detail.add')
                    </div>
                    <div x-show="open == {{ $troupeau->id }}" x-cloak>
                        <p x-on:click="open=false" x-on:keyup.escape="open=false"
                            class="text-gray-600 cursor-pointer hover:text-black active:underline">
                            @lang('ferme-detail.finish')
                        </p>
                        <input type="text" wire:model="newAnimal"
                            wire:keydown.enter="addAnimalToTroupeau({{ $troupeau }})">
                    </div>
                </div>
            </div>
        @endforeach
        
        {{-- Texte cliquable qui permet d'ajouter un troupeau en masquant les troupeaux existants 
        et en affichant troupeau-add qui est un formulaire --}}
        <div x-on:click="addTroupeau = true" class="flex flex-row gap-1 items-center p-1 mt-2 group">
            <div class="p-1 rounded-full cursor-pointer bg-slate-500 text-slate-500 group-hover:invert">
                <img class="w-6" src="{{ url('storage/img/add.svg') }}" alt="add">
            </div>
            <p class="cursor-pointer text-slate-600 group-hover:underline group-hover:text-black">
                @lang('ferme-detail.addTroupeau')
            </p>
        </div>
    </div>

    @include('livewire.fermes.partials.troupeau-add')
</div>
