<?php

namespace App\Filament\Widgets;

use App\Models\Item;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class RecentAssetWidget extends TableWidget
{
    protected static ?string $heading = 'Aset Terbaru';

    protected int|string|array $columnSpan = '1/2';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Item::query()->latest()->limit(5) // Dashboard cukup 5 data teratas agar tidak terlalu panjang ke bawah
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

                //             // DATA URGENT: Status Asset saat ini (Bagus/Rusak/Tersedia)
                //             // Ini sangat penting agar General Affair langsung tahu kondisi barang baru tersebut
                //             TextColumn::make('condition')
                //                 ->label('Status')
                //                 ->badge()
                // // 1. Mengubah teks yang muncul di layar (Label Penganti)
                //                 ->formatStateUsing(fn (string $state): string => match ($state) {
                //                     'good' => 'Bagus',
                //                     'broken' => 'Rusak',
                //                     default => ucfirst($state), // Mengkapitalisasi huruf pertama jika ada status lain (misal: 'borrowed' jadi 'Borrowed')
                //                 })
                // // 2. Memberikan warna berdasarkan value asli dari database
                //                 ->color(fn (string $state): string => match ($state) {
                //                     'good' => 'success',
                //                     'broken' => 'danger',
                //                     default => 'warning',
                //                 }),

                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d M H:i') // Diringkas tanpa tahun agar hemat space
                    ->sortable(),
            ])
            ->paginated(false);
    }
}
