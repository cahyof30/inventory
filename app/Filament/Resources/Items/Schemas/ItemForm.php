<?php

namespace App\Filament\Resources\Items\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Get;
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
                    ->preload()
                    ->live(),

                Group::make()
                    ->relationship('vehicleDetail')
                    ->visible(fn ($get) => $get('category_id') &&
                        \App\Models\ItemCategory::find($get('category_id'))?->slug === 'kendaraan'
                    )
                    ->schema([
                        TextInput::make('license_plate')
                            ->label('No. Polisi (Nopol)')
                            ->placeholder('Contoh: AB 1234 CD')
                            ->required(),
                    ]),

                TextInput::make('name')
                    ->label('Nama Barang')
                    ->required()
                    ->placeholder('Contoh: Motor, Laptop, dll.'),

                TextInput::make('brand')
                    ->label('Merk')
                    ->placeholder('Contoh: Honda, Yamaha, Samsung, dll.'),

                // Kolom Seri khusus untuk Peralatan Elektronik
                TextInput::make('specification.seri') // <--- Otomatis masuk ke JSON 'specification' dengan key 'Seri'
                    ->label('Seri')
                    ->placeholder(function (Get $get) {
                        $categoryId = $get('category_id');

                        // Jika kategori = 1 (Misal: Kendaraan)
                        if ($categoryId == 1) { 
                            return 'Vario, Beat, Aerox';
                        }

                        // Jika kategori = 2 (Misal: Peralatan Elektronik / Default)
                        return 'Contoh: X441U, Ideapad 3, dll.';
                    })
                    ->visible(function (Get $get) {
                        // Ambil ID atau Nilai dari kategori yang sedang dipilih
                        $categoryId = $get('category_id');

                        if (! $categoryId) {
                            return false;
                        }

                        // Opsi 1: Jika value category_id berupa ID (Angka), cek ke database atau hardcode ID-nya
                        // Contoh jika ID untuk 'Peralatan Elektronik' adalah 2 (sesuai di screenshot kamu):
                        return in_array($categoryId, [1, 2]);

                        // Opsi 2: Jika relasi ingin lebih dinamis berdasarkan nama kategori (opsional):
                        // $category = \App\Models\Category::find($categoryId);
                        // return $category && $category->name === 'Peralatan Elektronik';
                    }),

                TextInput::make('vehicleDetail.color') // <--- Otomatis masuk ke JSON 'specification' dengan key 'Seri'
                    ->label('Warna')
                    ->placeholder('Contoh: Hitam / Merah')
                    ->visible(function (Get $get) {
                        // Ambil ID atau Nilai dari kategori yang sedang dipilih
                        $categoryId = $get('category_id');

                        if (! $categoryId) {
                            return false;
                        }

                        // Opsi 1: Jika value category_id berupa ID (Angka), cek ke database atau hardcode ID-nya
                        // Contoh jika ID untuk 'Peralatan Elektronik' adalah 2 (sesuai di screenshot kamu):
                        return $categoryId == 1;

                        // Opsi 2: Jika relasi ingin lebih dinamis berdasarkan nama kategori (opsional):
                        // $category = \App\Models\Category::find($categoryId);
                        // return $category && $category->name === 'Peralatan Elektronik';
                    }),

                Select::make('pic_id')
                    ->label('PIC (Penanggung jawab)')
                    ->relationship(
                        name: 'pic',
                        titleAttribute: 'name',
                        // Filter langsung ke kolom 'role' yang ada di tabel users
                        modifyQueryUsing: fn ($query) => $query
                            ->with('division') // Tetap eager load divisi untuk mengambil JSON styles
                            ->where('role', 'staf') // Hanya menampilkan user yang kolom role-nya berisi 'staf'
                            ->orderBy('name', 'asc')
                    )
                    ->searchable(['name', 'short_name'])
                    ->preload()
                    ->live()
                    ->allowHtml()
                    ->getOptionLabelFromRecordUsing(function ($record) {
                        // 1. Ambil data JSON styles dari relasi divisi si User
                        $styles = $record->division?->styles;

                        // 2. Tentukan fallback jika data JSON di DB kosong/null
                        $bgColor = $styles['bg_color'] ?? '#f1f5f9';
                        $textColor = $styles['text_color'] ?? '#475569';
                        $borderColor = $styles['border_color'] ?? '#e2e8f0';

                        // 3. Satukan menjadi string inline CSS
                        $badgeStyle = "background-color: {$bgColor}; color: {$textColor}; border: 1px solid {$borderColor};";

                        return "
            <div style='display: flex; align-items: center; justify-content: space-between; width: 100%; gap: 8px;'>
                <span style='font-weight: 500; color: #111827;'>{$record->name}</span>
                <span style='
                    display: inline-flex; 
                    align-items: center; 
                    padding: 2px 8px; 
                    border-radius: 4px; 
                    font-size: 11px; 
                    font-weight: 600; 
                    {$badgeStyle}
                '>
                    ".($record->position ?? '-').'
                </span>
            </div>
        ';
                    }),

                TextInput::make('purchase_price')
                    ->label('Harga Beli')
                    ->numeric()
                    ->prefix('IDR'),

                DatePicker::make('purchase_date')
                    ->label('Tanggal Pembelian'),

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
                    ->disk('public')
                    ->directory('items'),
                // Textarea::make('qr_code')
                //     ->label('QR Code Content')
                //     ->rows(3)
                //     ->disabled()
                //     ->dehydrated()
                //     ->columnSpanFull(),
                Select::make('location_id')
                    ->label('Lokasi')
                    ->relationship('location', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                Textarea::make('description')
                    ->label('Deskripsi'),

                // Textarea::make('specifications')
                //     ->columnSpanFull(),
            ]);
    }
}
