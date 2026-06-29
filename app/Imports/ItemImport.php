<?php

namespace App\Imports;

use App\Models\Company;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\Location;
use App\Models\LocationCategory;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Events\AfterImport;

class ItemImport implements ToModel, WithHeadingRow, SkipsEmptyRows, WithEvents, WithMultipleSheets
{
    /** Jumlah baris berhasil diimport */
    public int $successCount = 0;

    /** Kumpulan error: [ ['row' => N, 'reason' => '...'], ... ] */
    public array $failures = [];

    /** Nomor baris saat ini (mulai dari 2 karena baris 1 adalah header) */
    private int $rowNumber = 1;

    // -------------------------------------------------------------------------

    /**
     * Hanya proses sheet pertama (index 0 = "Main Sheet").
     * Reference Sheet diabaikan sepenuhnya.
     */
    public function sheets(): array
    {
        return [
            0 => $this,
        ];
    }

    // -------------------------------------------------------------------------

    public function model(array $row): ?Item
    {
        $this->rowNumber++;
        $currentRow = $this->rowNumber;

        // Ambil nilai kolom wajib dengan ?? null agar tidak crash
        // meski template yang diupload tidak punya semua kolom (misal tanpa UUID)
        $namaBarang = trim($row['nama_barang'] ?? '');
        $perusahaan = trim($row['perusahaan'] ?? '');
        $kategori   = trim($row['kategori'] ?? '');

        // Skip baris kosong — SkipsEmptyRows tidak cukup karena sel
        // bergaya (warna fill) tetap dikirim meski nilainya kosong
        if (blank($namaBarang) && blank($perusahaan) && blank($kategori)) {
            return null;
        }

        try {
            return DB::transaction(function () use ($row, $currentRow, $namaBarang, $perusahaan, $kategori) {

                // --- Resolve relasi ---
                $company = Company::where('company_name', $perusahaan)
                    ->orWhere('code', $perusahaan)
                    ->first();
                if (! $company) {
                    throw new \Exception("Perusahaan '{$perusahaan}' tidak ditemukan.");
                }

                $category = ItemCategory::where('name', $kategori)->first();
                if (! $category) {
                    throw new \Exception("Kategori '{$kategori}' tidak ditemukan.");
                }

                $picInput = trim($row['pic'] ?? '');
                $pic = $picInput
                    ? User::where('short_name', $picInput)->orWhere('name', $picInput)->first()
                    : null;

                $location = ! empty($row['lokasi'])
                    ? Location::where('name', trim($row['lokasi']))->first()
                    : null;

                $locationCategory = ! empty($row['kategori_lokasi'])
                    ? LocationCategory::where('name', trim($row['kategori_lokasi']))->first()
                    : null;

                // --- Mapping kondisi ---
                $conditionMap = [
                    'baik'  => 'good',
                    'rusak' => 'broken',
                ];
                $inputCondition = strtolower(trim($row['kondisi'] ?? ''));
                $finalCondition = $conditionMap[$inputCondition] ?? 'good';

                // --- Cari atau buat item ---
                $item = null;

                $uuid = trim($row['uuid_kode_unik'] ?? '');
                $kode = trim($row['kode'] ?? '');

                if (! empty($uuid)) {
                    $item = Item::where('public_uuid', $uuid)->first();
                }

                if (! $item && ! empty($kode)) {
                    $item = Item::where('code', $kode)->first();
                }

                $item ??= new Item;

                // --- UUID ---
                if (blank($item->public_uuid)) {
                    $item->public_uuid = ! empty($uuid)
                        ? $uuid
                        : (string) Str::uuid();
                }

                // --- Tanggal Beli ---
                $purchaseDate = null;
                if (! empty($row['tanggal_beli'])) {
                    $purchaseDate = \Carbon\Carbon::parse($row['tanggal_beli'])->format('Y-m-d');
                }

                // --- Isi Data ---
                $item->company_id             = $company->id;
                $item->category_id            = $category->id;
                $item->name                   = $namaBarang;
                $item->brand                  = trim($row['merk'] ?? '');
                $item->specification          = ['seri' => trim($row['seri'] ?? '') ?: null];
                $item->pic_id                 = $pic?->id;
                $item->purchase_price         = $row['harga_idr'] ?? null;
                $item->purchase_date          = $purchaseDate;
                $item->condition              = $finalCondition;
                $item->description            = trim($row['deskripsi'] ?? '') ?: null;
                $item->location_id            = $location?->id;
                $item->location_category_code = $locationCategory?->code;

                if (! empty($kode)) {
                    $item->code = $kode;
                } else {
                    $item->generateInventoryCode();
                }

                $item->save();

                $this->successCount++;

                return $item;
            });

        } catch (\Throwable $e) {
            $this->failures[] = [
                'row'    => $currentRow,
                'name'   => $namaBarang ?: '-',
                'reason' => $e->getMessage(),
            ];

            return null;
        }
    }

    // -------------------------------------------------------------------------

    public function registerEvents(): array
    {
        return [
            AfterImport::class => function (AfterImport $event) {
                // Notifikasi ditangani di ItemsTable
            },
        ];
    }
}