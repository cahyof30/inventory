<?php

namespace App\Filament\Resources\Items\Tables;

use App\Exports\ItemExport;
use App\Exports\ItemVehicleExport;
use App\Imports\ItemImport;
use App\Imports\ItemVehicleImport;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('code')
                //     ->searchable(),
                TextColumn::make('qr_code')
                    ->label('QR Code')
                    ->html()
                    ->formatStateUsing(function ($state) {
                        return QrCode::size(80)
                            ->margin(1)
                            ->generate($state); // ⬅️ SVG otomatis
                    }),
                // ViewColumn::make('barcode')
                //     ->view('filament.components.barcode'),
                // Kolom Nopol HANYA tampil jika di tab 'kendaraan'
                TextColumn::make('vehicleDetail.license_plate')
                    ->label('No. Polisi')
                    ->visible(fn ($livewire) => $livewire->activeTab === 'kendaraan'),
                TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable()
                    ->visible(fn ($livewire) => $livewire->activeTab !== 'kendaraan'),
                TextColumn::make('name')
                    ->label('Nama / Kode')
                    ->description(fn ($record) => $record->code)
                    ->searchable(['name', 'code']), // Membuat kolom ini bisa dicari berdasarkan nama ATAU kode
                TextColumn::make('brand')
                    ->searchable(),
                TextColumn::make('purchase_price')
                    ->label('Purchase Price')
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                ImageColumn::make('image'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                ActionGroup::make([
                    Action::make('import_kendaraan')
                        ->label('Import Excel (Kendaraan)')
                        ->icon('heroicon-o-truck')
                        ->color('success')
                        ->form([
                            FileUpload::make('file')
                                ->label('File Excel (.xlsx / .csv)')
                                ->disk('public')
                                ->directory('temp-imports')
                                ->required(),
                        ])
                        ->action(function (array $data) {
                            $filePath = Storage::disk('public')->path($data['file']);

                            try {
                                Excel::import(new ItemVehicleImport, $filePath);

                                // Hapus file sementara
                                Storage::disk('public')->delete($data['file']);

                                Notification::make()
                                    ->title('Import Berhasil')
                                    ->success()
                                    ->send();
                            } catch (\Exception $e) {
                                Notification::make()
                                    ->title('Import Gagal')
                                    ->body($e->getMessage())
                                    ->danger()
                                    ->persistent()
                                    ->send();
                            }
                        }),
                    Action::make('import_peralatan')
                        ->label('Import Excel (Peralatan)')
                        ->icon('heroicon-o-tv')
                        ->color('success')
                        ->form([
                            FileUpload::make('file')
                                ->label('File Excel (.xlsx / .csv)')
                                ->disk('public')
                                ->directory('temp-imports')
                                ->required(),
                        ])
                        ->action(function (array $data) {
                            $filePath = Storage::disk('public')->path($data['file']);

                            try {
                                Excel::import(new ItemImport, $filePath);

                                // Hapus file sementara
                                Storage::disk('public')->delete($data['file']);

                                Notification::make()
                                    ->title('Import Berhasil')
                                    ->success()
                                    ->send();
                            } catch (\Exception $e) {
                                Notification::make()
                                    ->title('Import Gagal')
                                    ->body($e->getMessage())
                                    ->danger()
                                    ->persistent()
                                    ->send();
                            }
                        }),

                ])
                    ->label('Import')
                    ->icon('heroicon-o-arrow-up-tray')
                    ->color('success')
                    ->button(),

                ActionGroup::make([
                    Action::make('export_kendaraan')
                        ->label('Export Kendaraan')
                        ->icon('heroicon-o-truck')
                        ->action(function ($livewire) {

                            $records = $livewire->getSelectedTableRecords()->count() > 0
                                ? $livewire->getSelectedTableRecords()
                                    ->filter(
                                        fn ($item) => $item->category?->slug === 'kendaraan'
                                    )
                                : $livewire->getFilteredTableQuery()
                                    ->whereHas(
                                        'category',
                                        fn ($q) => $q->where('slug', 'kendaraan')
                                    )
                                    ->get();

                            return Excel::download(
                                new ItemVehicleExport($records),
                                'Kendaraan_'.now()->format('Y-m-d').'.xlsx'
                            );
                        }),
                    Action::make('export_peralatan')
                        ->label('Export Peralatan')
                        ->icon('heroicon-o-tv')
                        ->action(function ($livewire) {

                            $records = $livewire->getSelectedTableRecords()->count() > 0
                                ? $livewire->getSelectedTableRecords()
                                    ->filter(
                                        fn ($item) => $item->category?->slug !== 'kendaraan'
                                    )
                                : $livewire->getFilteredTableQuery()
                                    ->whereHas(
                                        'category',
                                        fn ($q) => $q->where('slug', '!=', 'kendaraan')
                                    )
                                    ->get();

                            return Excel::download(
                                new ItemExport($records),
                                'Peralatan_'.now()->format('Y-m-d').'.xlsx'
                            );
                        }),

                ])
                    ->label('Export')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->button(),
                Action::make('scan_qr')
                    ->label('Scan QR')
                    ->icon('heroicon-o-qr-code')
                    ->color('success')
                    ->url(route('items.scan-camera')),
            ])
            ->filters([
                //
            ])
            ->recordAction('detailItem')
            ->recordActions([
                Action::make('detailItem')
                    ->modalHeading(fn ($record) => $record->name)
                    ->modalWidth('4xl')
                    ->modalContent(fn ($record) => view(
                        'filament.items.detail-modal',
                        [
                            'record' => $record,
                        ]
                    ))
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup'),

                ActionGroup::make([
                    // 1. Tombol Edit
                    EditAction::make(),

                    // 2. Tombol Lihat Barcode (Modal)
                    Action::make('view_barcode')
                        ->label('Barcode')
                        ->icon('heroicon-o-qr-code')
                        ->color('info')
                        ->modalHeading(fn ($record) => "Barcode - {$record->name} ".($record->brand ? "({$record->brand})" : ''))
                        ->modalContent(fn ($record) => view('filament.components.barcode', [
                            'record' => $record,
                        ]))
                        ->modalSubmitAction(false)
                        ->modalCancelActionLabel('Tutup'),
                    // Action::make('printSticker')
                    //     ->label('Cetak Stiker')
                    //     ->icon('heroicon-o-printer')
                    //     ->color('success')
                    //     ->url(fn ($record) => route(
                    //         'items.print-single-sticker',
                    //         $record
                    //     ))
                    //     ->openUrlInNewTab(),
                    // 3. Tombol Hapus
                    DeleteAction::make(),
                ])
                    ->label('Opsi') // Nama tombol utama
                    ->icon('heroicon-m-ellipsis-vertical') // Ikon titik tiga vertikal
                    ->color('gray') // Warna tombol grup
                    ->button(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    BulkAction::make('downloadSticker')
                        ->label('Download Stiker PNG')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('success')
                        ->action(function ($records) {

                            $ids = $records->pluck('id');

                            return redirect()->route(
                                'items.sticker',
                                [
                                    'ids' => $ids->implode(','),
                                    'download' => 1,
                                ]
                            );
                        }),
                        BulkAction::make('downloadStickerA3')
                        ->label('Download Stiker A3 PNG')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('success')
                        ->action(function ($records) {

                            $ids = $records->pluck('id');

                            return redirect()->route(
                                'items.sticker-a3',
                                [
                                    'ids' => $ids->implode(','),
                                    'download' => 1,
                                ]
                            );
                        }),
                ]),
            ]);
    }
}
