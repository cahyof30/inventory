<div class="flex flex-col items-center justify-center p-2 text-center">
    @php
        // Cek apakah dipanggil dari Column ($getRecord) atau dari Action ($record)
        $data = isset($getRecord) ? $getRecord() : ($record ?? null);
    @endphp

    @if($data && $data->barcode_base64)
        <img src="data:image/png;base64,{{ $data->barcode_base64 }}" class="mx-auto">
        <div class="mt-2 text-xs font-mono">
            {{ $data->code }}
        </div>
    @else
        <span class="text-gray-400 text-xs italic">No Barcode</span>
    @endif
</div>
