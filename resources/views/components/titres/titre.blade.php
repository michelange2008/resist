<div {{ $attributes->merge(['class' => 'titre bg-teal-900']) }}>

    @isset($icone)

            <img class="w-8 sm:w-12 p-1" src="{{ url('storage/img/' . $icone) }}" alt="{{ $icone }}">

    @endisset

    <h1>
        {{ $slot }}
    </h1>

</div>
