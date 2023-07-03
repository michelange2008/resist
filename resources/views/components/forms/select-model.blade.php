@props(['disabled' => '', 'label', 'model', 'options', 'col' => 'nom'])
<div class="flex flex-col my-2">

    <label>{{ $label }}</label>

    <select {{ $disabled }} wire:model.lazy="{{ $model }}">

        <option hidden value="">Choisir une valeur dans la liste ...</option>

        @foreach ($options as $option)
            <option value="{{ $option->id }}">{{ ucFirst( $option->{$col} ) }} </option>
        @endforeach

        
    </select>
    
    @error($model)
        <div class="text-red-900 text-xs">{{ $message }}</div>
    @enderror
    
</div>
