@props(['liste', 'col'])

@foreach ($liste as $item)

    {{ mb_convert_case($item->{$col}, MB_CASE_TITLE_SIMPLE) }}

    @if (!$loop->last)
        ,
    @endif

@endforeach
