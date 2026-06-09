{{-- resources/views/filament/items/detail-modal.blade.php --}}

<div class="space-y-4">
    <div>
        <strong>Nama Barang:</strong><br>
        {{ $record->name }}
    </div>

    <div>
        <strong>Kategori:</strong><br>
        {{ $record->category?->name }}
    </div>

    <div>
        <strong>Merek:</strong><br>
        {{ $record->brand }}
    </div>

    <div>
        <strong>Harga Beli:</strong><br>
        Rp {{ number_format($record->purchase_price, 0, ',', '.') }}
    </div>

    @if($record->image)
        <img
            src="{{ asset('storage/'.$record->image) }}"
            class="rounded-lg max-w-xs"
        >
    @endif
</div>