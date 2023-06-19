@props(['type' => 'text', 'label', 'field', 'min' => ''])

<div {{ $attributes->merge(['class' => 'flex flex-col my-2']) }}>

    @if ($type != 'hidden')
        <label>{{ $label }}</label>
    @endif

    <input type="{{ $type }}" wire:model.lazy="{{ $field }}" min="{{ $min }}"
        class="form-input rounded border-1 focus:active:border-0">

    @error( $field )
        <div class="text-red-900 text-xs">{{ $message }}</div>
    @enderror

</div>
