<?php

namespace App\Filament\Resources\Items\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('company_id')
                    ->label('Perusahaan')
                    ->relationship('company', 'company_name')
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),

                TextInput::make('name')
                    ->label("Nama Barang")
                    ->required(),

                TextInput::make('brand')
                    ->label("Merk"),

                TextInput::make('purchase_price')
                    ->label('Harga Beli')
                    ->numeric()
                    ->required()
                    ->prefix('IDR'),

                DatePicker::make('purchase_date')
                    ->label('Tanggal Pembelian')
                    ->required(),

                Select::make('condition')
                    ->label('Kondisi Barang')
                    ->options([
                        'good' => 'Baik',
                        'broken' => 'Rusak',
                    ])
                    ->required()
                    ->native(false),

                FileUpload::make('image')
                    ->label('Gambar Barang')
                    ->image()
                    ->directory('items'),

                // Textarea::make('qr_code')
                //     ->label('QR Code Content')
                //     ->rows(3)
                //     ->disabled()
                //     ->dehydrated()
                //     ->columnSpanFull(),

                Textarea::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull(),

                // Textarea::make('specifications')
                //     ->columnSpanFull(),
            ]);
    }
}
