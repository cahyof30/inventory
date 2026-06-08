<?php

namespace App\Filament\Widgets;

use App\Models\Item;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class DamagedAssetWidget extends TableWidget
{
    protected static ?string $heading = 'Aset Rusak';

    protected int|string|array $columnSpan = '1/2';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Item::query()->where('condition', 'broken')->latest()->limit(5) // Dashboard cukup 5 data teratas agar tidak terlalu panjang ke bawah
            )
            ->columns([
               TextColumn::make('code')
                    ->label('Kode')
                    ->searchable()
                    ->grow(false)
                    ->limit(6) // Memotong teks jika melebihi 8 karakter dan otomatis menambah '...'
                    ->tooltip(fn (TextColumn $column): ?string => $column->getState()), // Menampilkan teks asli penuh saat di-hover


                TextColumn::make('name')
                    ->label('Nama Asset')
                    ->description(fn ($record) => $record->brand) // Menampilkan brand di bawah nama
                    ->searchable(['name', 'brand']), // Membuat kolom ini bisa dicari berdasarkan nama ATAU brand
                TextColumn::make('location.name')
                    ->label('Lokasi')
                    ->description(fn ($record) => $record->location->description) // Menampilkan deskripsi lokasi di bawah nama lokasi
                    ->searchable('location'), // Membuat kolom ini bisa dicari berdasarkan lokasi ATAU brand
            ])
            ->paginated(false);
    }
}
