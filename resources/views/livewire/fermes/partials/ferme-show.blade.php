<div class="flex flex-row gap-3 items-center cursor-pointer" x-on:click="editFerme = true">

    <img class="w-20 invert" src="{{ url('storage/img/ferme.svg') }}" alt="">
    <h2 class="h2">@lang('ferme-detail.farm')</h2>
    <x-icones.edit />
</div>
<div class="my-3">
    <h2 class="mb-2 text-xl font-semibold leading-tight text-gray-800">
        {{ $ferme->nom }}
    </h2>

    <p class="italic text-gray-600 text-md">@lang('ferme-detail.email')</p>

    <p class="px-2 mb-2">
        @if ($ferme->user_id != null)
            {{ $ferme->user->email }}
        @else
            <span class="text-sm text-gray-400">(pas d'utilisateur associé)</span>
        @endif

    <p class="italic text-gray-600">@lang('ferme-detail.adresse')</p>

    <p class="px-2 mb-2">
        @if ($ferme->adresse != null)
            {{ $ferme->adresse }} -
        @endif
        {{ $ferme->commune->Codepos }} {{ $ferme->commune->Commune }}
    </p>
</div>
<div class="my-3">
    <p class="italic text-gray-600">@lang('ferme-detail.ede')</p>
    <p class="px-2">{{ $ferme->ede }}</p>
</div>

@if ($ferme->isBio)
    <div>
        <img class="w-20" src="{{ url('storage/img/bio.svg') }}" alt="Bio">
    </div>
@endif
