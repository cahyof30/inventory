<?php

namespace App\Filament\Resources\Loans\Tables;

use Dom\Text;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LoansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('item_id')
                    ->label('Barang')
                    ->formatStateUsing(fn ($record) => $record->item->name.' - '.$record->item->brand)
                    ->searchable(),
                TextColumn::make('user_id')
                    ->label('Peminjam')
                    ->formatStateUsing(fn ($record) => $record->user->name)
                    ->searchable(),
                    TextColumn::make('loan_date')
                    ->label('Tanggal Peminjaman')
                    ->date()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                // EditAction::make(),
                  ActionGroup::make([
                    // 1. Tombol Edit
                    EditAction::make(),
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
                ]),
            ]);
    }
}
