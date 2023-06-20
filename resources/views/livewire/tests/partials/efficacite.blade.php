<div class="p-3 bg-white my-2">
    <h2 class="h2">
        Efficacité:
        @if ($efficacite === null)
            <span class="text-slate-600">...</span>
        @elseif ($efficacite >= 95)
            <span class="font-bold text-green-700">{{ $efficacite }} %</span>
        @else
            <span class="font-bold text-red-700">{{ $efficacite }} %</span>
        @endif
    </h2>

</div>