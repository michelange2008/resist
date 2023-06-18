<div class="flex flex-col">
    <label for="{{ $field }}">{{ $label }}</label>
    <select id="{{ $field }}"  wire:model.defer="{{ 'state.'.$field }}"">
        <option value="0">Non</option>
        <option value="1">Oui</option>
    </select>
</div>
