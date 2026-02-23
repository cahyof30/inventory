<?php

namespace App\Filament\Resources\Items\Tables;

use App\Exports\ItemExport;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
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
                TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('brand')
                    ->searchable(),
                TextColumn::make('purchase_price')
                    ->label('Purchase Price')
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                // TextColumn::make('purchase_date')
                //     ->date()
                //     ->sortable(),
                // TextColumn::make('condition')
                //     ->searchable(),
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
                Action::make('export_custom')
                    ->label('Export Excel')
                    ->icon('heroicon-o-table-cells')
                    ->action(function ($livewire) {
                        // Ambil data yang sedang tampil di tabel (termasuk filter)
                        $records = $livewire->getSelectedTableRecords()->count() > 0
                                      ? $livewire->getSelectedTableRecords()
                                      : $livewire->getFilteredTableQuery()->get();

                        return Excel::download(
                            new ItemExport($records),
                            'Master_Barang_'.now()->format('Y-m-d').'.xlsx'
                        );
                    }),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
