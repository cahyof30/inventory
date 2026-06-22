<div class="flex flex-col items-center justify-center p-4 text-center min-h-[350px] relative">
    
    <div class="flex flex-col items-center justify-center flex-1 w-full">
        <div class="bg-white p-4 rounded-lg shadow-sm inline-block">
            {!! QrCode::size(250)->margin(1)->generate($state) !!}
        </div>
        
        <span class="mt-4 text-sm font-mono text-gray-500 bg-gray-100 dark:bg-gray-800 px-3 py-1 rounded max-w-full break-all">
            {{ $state }}
        </span>
    </div>

    <div class="w-full flex justify-end mt-6">
        <button x-on:click="close" class="fi-ac-btn-action bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 px-4 py-2 rounded-lg text-sm font-semibold shadow-sm transition-colors duration-700">
            Tutup
        </button>
    </div>

</div>