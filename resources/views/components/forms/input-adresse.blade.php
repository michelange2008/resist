<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">

    <div class="sm:col-span-2 lg:col-span-1 flex flex-col my-2" }}>

        <label>Adresse</label>

        <input type="text" wire:model.defer="farm.adresse" class="form-input rounded border-1 focus:active:border-0">

        @error('farm.adresse')
            <div class="text-red-900 text-xs">{{ $message }}</div>
        @enderror

    </div>

    <div class="flex flex-col my-2">

        <label>Code postal</label>

        <select wire:model.defer="cp">

            @foreach ($cps as $cp)
                <option hidden value="">Choisir une valeur dans la liste ...</option>

                @if ($cp->Codepos == $ferme->commune->Codepos)
                    <option value="{{ $cp->Codepos }}" selected>{{ ucFirst($cp->Codepos) }} </option>
                @endif

                <option value="{{ $cp->Codepos }}">{{ ucFirst($cp->Codepos) }} </option>
            @endforeach


        </select>

        @error('cp')
            <div class="text-red-900 text-xs">{{ $message }}</div>
        @enderror

    </div>

    <div class="flex flex-col my-2">

        <label>Commune</label>

        <select wire:model.lazy="farm.commune_id">

            <cp hidden value="">Choisir une valeur dans la liste ...</cp>

            @foreach ($communes as $commune)
                <option value="{{ $commune->id }}">{{ ucFirst($commune->Commune) }} </option>
            @endforeach


        </select>

        @error('cp')
            <div class="text-red-900 text-xs">{{ $message }}</div>
        @enderror

    </div>

</div>
