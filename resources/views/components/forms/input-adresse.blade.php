<div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3">

    <div class="flex flex-col my-2 sm:col-span-2 lg:col-span-1" }}>

        <label>@lang('ferme-detail.adresse')</label>

        <input type="text" wire:model.defer="farm.adresse" class="rounded form-input border-1 focus:active:border-0">

        @error('farm.adresse')
            <div class="text-xs text-red-900">{{ $message }}</div>
        @enderror

    </div>

    <div class="flex flex-col my-2">

        <label>@lang('ferme-detail.cp')</label>

        <select wire:model.defer="cp">

            @foreach ($cps as $cp)
                <option hidden value="">@lang('commun.select')</option>

                @if ($cp->Codepos == $ferme->commune->Codepos)
                    <option value="{{ $cp->Codepos }}" selected>{{ ucFirst($cp->Codepos) }} </option>
                @endif

                <option value="{{ $cp->Codepos }}">{{ ucFirst($cp->Codepos) }} </option>
            @endforeach


        </select>

        @error('cp')
            <div class="text-xs text-red-900">{{ $message }}</div>
        @enderror

    </div>

    <div class="flex flex-col my-2">

        <label>@lang('ferme-detail.commune')</label>

        <select wire:model.lazy="farm.commune_id">

            <p hidden value="">@lang('commun.select')</p>

            @foreach ($communes as $commune)
                <option value="{{ $commune->id }}">{{ ucFirst($commune->Commune) }} </option>
            @endforeach


        </select>

        @error('cp')
            <div class="text-xs text-red-900">{{ $message }}</div>
        @enderror

    </div>

</div>
