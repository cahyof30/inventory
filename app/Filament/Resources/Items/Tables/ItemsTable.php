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
use Filament\Support\Enums\Alignment;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Torgodly\Html2Media\Actions\Html2MediaAction;

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
                    ->label('Kategori / Kode')
                    ->description(fn ($record) => $record->code)
                    ->searchable('code')
                    ->sortable()
                    ->visible(fn ($livewire) => $livewire->activeTab !== 'kendaraan'),
                TextColumn::make('name')
                    ->label('Nama / Seri')
                    ->formatStateUsing(fn ($state, $record) => "{$state} {$record->brand}")
                    ->description(fn ($record) => $record->specification['seri'] ?? '')
                    ->searchable(['name', 'brand']),
                // TextColumn::make('brand')
                //     ->searchable(),
                // TextColumn::make('purchase_price')
                //     ->label('Purchase Price')
                //     ->money('IDR', locale: 'id')
                //     ->sortable(),
                ImageColumn::make('image')
                ->toggleable(isToggledHiddenByDefault: true),
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
                                $import = new ItemVehicleImport;
                                Excel::import($import, $filePath);

                                Storage::disk('public')->delete($data['file']);

                                static::sendImportNotification(
                                    $import->successCount,
                                    $import->failures
                                );
                            } catch (\Exception $e) {
                                Notification::make()
                                    ->title('Import Gagal Total')
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
                        ->modalDescription(new HtmlString('
                            <div class="rounded-lg border border-blue-200 bg-blue-50 p-3 mb-2 flex items-center justify-between gap-3">
                                <div class="flex items-center gap-2 text-sm text-blue-700">
                                    <x-heroicon-o-information-circle class="w-5 h-5 shrink-0" />
                                    <span>Belum punya template? Download dulu dan sesuaikan datanya sebelum upload.</span>
                                </div>
                                <a
                                    href="' . route('items.template.download') . '"
                                    class="inline-flex items-center gap-1.5 rounded-md bg-blue-600 px-3 py-1.5 text-xs font-semibold text-white shadow-sm hover:bg-blue-500 whitespace-nowrap"
                                >
                                    <x-heroicon-o-arrow-down-tray class="w-4 h-4" />
                                    Download Template
                                </a>
                            </div>
                        '))
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
                                $import = new ItemImport;
                                Excel::import($import, $filePath);
 
                                Storage::disk('public')->delete($data['file']);
 
                                static::sendImportNotification(
                                    $import->successCount,
                                    $import->failures
                                );
                            } catch (\Exception $e) {
                                Notification::make()
                                    ->title('Import Gagal Total')
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
                SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('location_category')
                    ->label('Kategori Lokasi')
                    ->options([
                        'I' => 'Kantor',
                        'G' => 'Gudang',
                        'V' => 'Kandang',
                    ])
                    ->query(function (Builder $query, array $data): Builder {

                        if (blank($data['value'])) {
                            return $query;
                        }

                        return $query->whereHas(
                            'location.locationCategory',
                            fn (Builder $q) => $q->where('code', $data['value'])
                        );
                    }),
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

                    // 2. Tombol Lihat QR Code (Modal)
                    Action::make('view_qr')
                        ->label('QR Code')
                        ->icon('heroicon-o-qr-code')
                        ->color('success')
                        ->modalHeading('QR Code Asset')
                        ->modalWidth('md')
                        ->modalAlignment(Alignment::Center)
                        ->modalCancelActionLabel('Tutup')
                        ->modalSubmitAction(false)
                        ->modalContent(fn ($record) => view(
                            'filament.components.qr-code',
                            ['state' => $record->qr_code]
                        )),

                    // 3. Tombol Hapus
                    DeleteAction::make(),
                ])
                    ->label('Opsi')
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->color('gray')
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
                                'png.sticker-a4',
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
                                'png.sticker-a3',
                                [
                                    'ids' => $ids->implode(','),
                                    'download' => 1,
                                ]
                            );
                        }),
                    BulkAction::make('downloadStickerQR')
                        ->label('Download Stiker (QR Only) PNG')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('success')
                        ->action(function ($records) {

                            $ids = $records->pluck('id');

                            return redirect()->route(
                                'png.sticker-qr-a4',
                                [
                                    'ids' => $ids->implode(','),
                                    'download' => 1,
                                ]
                            );
                        }),
                    Html2MediaAction::make('downloadA3')
                        ->label('Sticker A3')
                        ->icon('heroicon-o-document-arrow-down')
                        ->accessSelectedRecords()
                        ->savePdf()
                        ->print(false)
                        ->preview(false)
                        ->filename('Sticker-A3')
                        ->format('a3')
                        ->orientation('landscape')
                        ->showPageNumbers(false)
                        ->margins(5)
                        ->content(function (Collection $records) {

                            return view('pdf.sticker-a3', [
                                'items' => $records,
                            ]);

                        }),
                    Html2MediaAction::make('downloadA4')
                        ->label('Sticker A4')
                        ->icon('heroicon-o-document-arrow-down')
                        ->accessSelectedRecords()
                        ->savePdf()
                        ->print(false)
                        ->preview(false)
                        ->filename('Sticker-A4')
                        ->format('a4')
                        ->orientation('portrait')
                        ->showPageNumbers(false)
                        ->margins(5)
                        ->content(function (Collection $records) {

                            return view('pdf.sticker', [
                                'items' => $records,
                            ]);

                        }),
                ]),
            ]);
    }

    // -------------------------------------------------------------------------
    // Helper: Kirim notifikasi ringkasan import
    // -------------------------------------------------------------------------

    protected static function sendImportNotification(int $successCount, array $failures): void
    {
        $failCount = count($failures);

        if ($failCount === 0) {
            // Semua berhasil
            Notification::make()
                ->title('Import Berhasil')
                ->body("{$successCount} data berhasil diimport.")
                ->success()
                ->send();

            return;
        }

        if ($successCount === 0) {
            // Semua gagal
            $body = static::buildFailureList($failures);

            Notification::make()
                ->title("Import Gagal — {$failCount} baris bermasalah")
                ->body($body)
                ->danger()
                ->persistent()
                ->send();

            return;
        }

        // Sebagian berhasil, sebagian gagal — kirim 2 notifikasi
        Notification::make()
            ->title('Import Selesai (Sebagian)')
            ->body("{$successCount} data berhasil diimport.")
            ->success()
            ->send();

        $body = static::buildFailureList($failures);

        Notification::make()
            ->title("{$failCount} baris gagal diimport")
            ->body($body)
            ->warning()
            ->persistent()
            ->send();
    }

    /**
     * Buat ringkasan teks dari daftar kegagalan.
     * Ditampilkan maksimal 10 baris pertama agar notifikasi tidak terlalu panjang.
     */
    protected static function buildFailureList(array $failures): string
    {
        $lines = [];

        foreach (array_slice($failures, 0, 10) as $f) {
            $lines[] = "• Baris {$f['row']} ({$f['name']}): {$f['reason']}";
        }

        $body = implode("\n", $lines);

        $remaining = count($failures) - count(array_slice($failures, 0, 10));
        if ($remaining > 0) {
            $body .= "\n• ... dan {$remaining} baris lainnya.";
        }

        return $body;
    }
}
