<div class="flex flex-row gap-3 cursor-pointer" x-on:click="editFerme = true">

    <h2 class="h2 text-gray-500">L'exploitation</h2>
    <x-icones.edit/>
</div>
<div class="my-3">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ $ferme->nom }}
    </h2>

    <p class="italic text-gray-600">Email: </p>
    
    <p class="px-2">{{ $ferme->email }} </p>

    <p class="italic text-gray-600">Adresse: </p>

    <p class="px-2">
        @if ($ferme->adresse != null)
            {{ $ferme->adresse }} -     
        @endif
        {{ $ferme->commune->Codepos }} {{ $ferme->commune->Commune }}
    </p>
</div>
<div class="my-3">
    <p class="italic text-gray-600">N° EDE: </p>
    <p class="px-2">{{ $ferme->ede }}</p>
</div>

@if ($ferme->isBio)
<div>
    <img class="w-20" src="{{ url('storage/img/bio.svg') }}" alt="Bio">
</div>
@endif


