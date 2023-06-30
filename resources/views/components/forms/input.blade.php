@props(['type' => 'text', 'label', 'model', 'min' => ''])

<div {{ $attributes->merge(['class' => 'flex flex-col my-2']) }}>

    @if ($type != 'hidden')
        <label>{{ $label }}</label>
    @endif

    <input type="{{ $type }}" wire:model.defer="{{ $model }}" min="{{ $min }}"
        class="form-input rounded border-1 focus:active:border-0">

    @error( $model )
        <div class="text-red-900 text-xs">{{ $message }}</div>
    @enderror

</div>
