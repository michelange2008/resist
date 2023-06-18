<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('commun.posologies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-1 sm:px-6 lg:px-8 grid sm:grid-cols-2 xl:grid-cols-3 gap-3">

            @foreach ($anthelms as $anthelm)
                <div class="my-3 bg-orange-300 flex flex-col">
                    <div class=" p-3 bg-orange-700">
                        <h2 class="h2 text-orange-200">{{ $anthelm->nom }} </h2>
                    </div>
                    <div class="p-3 flex flex-col gap-2">
                        @foreach ($anthelm->especes->sortBy($anthelm->espece_id) as $espece)
                            <div class="flex flex-row justify-between">
                                <div class="flex flex-row gap-5 items-center">
                                    <img class="w-8" src="{{ url('storage/img/' . $espece->icone) }}"
                                        alt="{{ $espece->icone }}">
                                    <div class="grid grid-cols-2 gap-2">
                                        @if ($espece->pivot->voie != null)
                                            <p>
                                                <span class="text-slate-600 italic">Voie: </span>
                                                <span class="font-bold">{{ $espece->pivot->voie }} </span>
                                            </p>
                                        @endif
                                        @if ($espece->pivot->lait)
                                            <p>
                                                <span class="text-slate-600 italic">Lait: </span>
                                                <span class="font-bold">{{ $espece->pivot->lait }} </span></p>
                                        @endif
                                        @if ($espece->pivot->posologie)
                                            <p><span class="font-bold">{{ $espece->pivot->posologie }} </span></p>
                                        @endif
                                        @if ($espece->pivot->viande)
                                            <p>
                                                <span class="text-slate-600 italic">Viande: </span>
                                                <span class="font-bold">{{ $espece->pivot->viande }} </span></p>
                                        @endif
                                    </div>
                                </div>
                                <a href="{{ route('posologie.edit', [$anthelm, $espece])}}">
                                    <x-buttons.edit-small-light-button>
                                        <x-icones.edit></x-icones.edit>
                                    </x-buttons.edit-small-light-button>
                                </a>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</x-app-layout>
