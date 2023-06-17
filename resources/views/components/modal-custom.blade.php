<div 
    x-show="show" 
    x-transition
    x-cloak 
    class="fixed top-0 inset-0 z-40 bg-gray-400/50 py-5">


    <div class="w-full h-full sm:w-3/4 lg:w-2/3 xl-w-1/2 m-auto shadow transition-all bg-orange-200 p-5 overflow-auto"
        x-on:click.away="show = false">

        {{ $slot }}

    </div>

</div>
