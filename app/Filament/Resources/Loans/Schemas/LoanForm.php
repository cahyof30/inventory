<?php

namespace App\Filament\Resources\Loans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LoanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('item_id')
                    ->label('Barang')
                    ->relationship(
                        name: 'item',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn ($query) => $query->whereDoesntHave('loans')
                    )
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->name.' - '.$record->brand
                    )
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('user_id')
                    ->label('Peminjam')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload(),
                DatePicker::make('loan_date')
                    ->label('Tanggal Peminjaman')
                    ->required(),
                DatePicker::make('expected_return_date')
                    ->label('Tanggal Pengembalian Diharapkan'),
                DatePicker::make('actual_return_date')
                    ->label('Tanggal Pengembalian Sebenarnya'),
                TextInput::make('purpose')
                    ->label('Tujuan Peminjaman')
                    ->required(),
                Select::make('status')
                    ->label('Status Peminjaman')
                    ->options([
                        'active' => 'Aktif (Dipinjam)',
                        'returned' => 'Dikembalikan',
                    ])
                    ->required()
                    ->native(false),

            ]);
    }
}
