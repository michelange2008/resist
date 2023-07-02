<div x-data="{ addTroupeau: @entangle('addTroupeau'), herd: @entangle('animaux') }">
    <div x-show="!addTroupeau">
        <h2 class="h2 mb-3">Les troupeaux</h2>
        @foreach ($ferme->troupeaus as $troupeau)
            <div class="py-3 border-b-4 border-gray-300">

                <div class="my-3 flex flex-row gap-5 align-bottom ">
                    <img class="w-20" src="{{ url('storage/img/' . $troupeau->espece->icone) }}" alt="espece">
                    <img class="w-16" src="{{ url('storage/img/' . $troupeau->production->icone) }}" alt="production">
                    <p>{{ $troupeau->effectif }} {{ $troupeau->espece->nom }} </p>
                </div>
                <div class="bg-gray-200  p-3">
                    @if ($troupeau->animals->count() > 0)
                        <p class="pb-3 underline">Liste des animaux</p>
                        <div class="px-1 grid grid-rows-4 grid-cols-5 grid-flow-col gap-2">
                            @foreach ($troupeau->animals as $animal)
                                <span>{{ $animal->numero }}</span>
                            @endforeach
                        </div>
                        <div>ajouter ...</div>
                    @else
                    <p class="pb-3 text-gray-600 cursor-pointer hover:text-black active:underline">Ajouter des animaux</p>

                    @endif
                </div>
            </div>
        @endforeach

        <div x-on:click="addTroupeau = true" class="mt-2 flex flex-row gap-1 items-center group">
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
