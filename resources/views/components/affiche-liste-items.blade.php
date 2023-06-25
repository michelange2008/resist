@props(['liste', 'col'])

@foreach ($liste as $item)

    @if ($loop->first)
    
        {{ mb_convert_case($item->{$col}, MB_CASE_TITLE_SIMPLE) }}, 

    @else

        @if ($loop->last)

            {{ $item->{$col} }}

        @else

            {{ $item->{$col} }}, 

        @endif

    @endif

@endforeach
