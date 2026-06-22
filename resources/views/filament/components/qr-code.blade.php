<div class="flex flex-col items-center justify-center p-4 text-center">
    <div class="bg-white p-4 rounded-lg shadow-sm inline-block">
        {!! QrCode::size(250)->margin(1)->generate($state) !!}
    </div>
    
    <span class="mt-4 text-sm font-mono text-gray-500 bg-gray-100 dark:bg-gray-800 px-3 py-1 rounded">
        {{ $state }}
    </span>
</div>