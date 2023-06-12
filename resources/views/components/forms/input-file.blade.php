<div class="flex flex-col my-2">

    <label>{{ $label }}</label>

    <input type="file" wire:model.defer="{{ $field }}" class="form-input rounded border-1 focus:active:border-0">
    @isset ($icone)

    Photo Preview:

    <img src="{{ $icone->temporaryUrl() }}">

@endisset
    @error($field)
        <div class="text-red-900 text-xs">{{ $message }}</div>
    @enderror
    
</div>