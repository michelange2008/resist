<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            @lang('tests.synthese')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <x-maps-leaflet  
                    :centerPoint="['lat' => 44.95363, 'long' => 5.14327]"
                    :zoomLevel="12"
                    :markers="[['lat' => 44.96444513293423, 'long' => 5.145622388024091]]"
                    >
                </x-maps-leaflet>
                
            </div>
        </div>
    </div>



</div>
