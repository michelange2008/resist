@props( [ 'disabled'=>'', 'label', 'field', 'options' ] )
<div class="flex flex-col my-2">

    <label>{{ $label }}</label>

    <select {{$disabled}} wire:model="{{ $field }}">

        <option hidden value="">Choisir une valeur dans la liste ...</option>

        @foreach ($options as $option)
            <option value="{{ $option->id }}">{{ ucFirst($option->nom) }} </option>
        @endforeach

    </select>

</div>