<div>
    <div class="flex flex-col justify-center items-center">
        <button type="button" data-te-toggle="modal" data-te-target="#confirmDel{{ $test->id }}" data-te-ripple-init
            data-te-ripple-color="light">
            <x-icones.del />
        </button>
    </div>
    <div>
        <div data-te-modal-init
            class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
            id="confirmDel{{ $test->id }}" tabindex="-1" aria-labelledby="confirmDelTitle" aria-modal="true" role="dialog">
            <div data-te-modal-dialog-ref
                class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
                <div
                    class="flex relative flex-col w-full text-current bg-clip-padding bg-white rounded-md border-none shadow-lg outline-none pointer-events-auto dark:bg-neutral-600">
                    <div
                        class="flex flex-shrink-0 justify-between items-center p-4 rounded-t-md border-b-2 border-opacity-100 border-neutral-100 dark:border-opacity-50">
                        <!--Modal title-->
                        <h5 class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200"
                            id="exampleModalScrollableLabel">
                            {{ $test->anthelm->nom }}
                        </h5>
                        <!--Close button-->
                        <button type="button"
                            class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
                            data-te-modal-dismiss aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!--Modal body-->
                    <div class="relative p-4">
                        <p>Attention, vous allez supprimer le test</p>
                    </div>

                    <!--Modal footer-->
                    <div
                        class="flex flex-wrap flex-shrink-0 gap-2 justify-end items-center p-4 rounded-b-md border-t-2 border-opacity-100 border-neutral-100 dark:border-opacity-50">
                        <button type="button" class="bg-red-600 btn" wire:click.prevent="del({{ $test }})" data-te-ripple-init data-te-ripple-color="light">
                            Confirmer
                        </button>
                        <button type="button" class="bg-gray-500 btn" data-te-modal-dismiss data-te-ripple-init
                            data-te-ripple-color="light">
                            Annuler
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
