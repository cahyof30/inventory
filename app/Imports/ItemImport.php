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
use Maatwebsite\Excel\Events\AfterImport;

class ItemImport implements ToModel, WithHeadingRow, SkipsEmptyRows, WithEvents
{
    /** Jumlah baris berhasil diimport */
    public int $successCount = 0;

    /** Kumpulan error: [ ['row' => N, 'reason' => '...'], ... ] */
    public array $failures = [];

    /** Nomor baris saat ini (mulai dari 2 karena baris 1 adalah header) */
    private int $rowNumber = 1;

    // -------------------------------------------------------------------------

    public function model(array $row): ?Item
    {
        $this->rowNumber++;
        $currentRow = $this->rowNumber;

        try {
            return DB::transaction(function () use ($row, $currentRow) {

                // --- Resolve relasi ---
                $company = Company::where('code', $row['perusahaan'])->first();
                if (! $company) {
                    throw new \Exception("Perusahaan '{$row['perusahaan']}' tidak ditemukan.");
                }

                $category = ItemCategory::where('name', $row['kategori'])->first();
                if (! $category) {
                    throw new \Exception("Kategori '{$row['kategori']}' tidak ditemukan.");
                }

                $picInput = trim($row['pic'] ?? '');
                $pic = $picInput
                    ? User::where('short_name', $picInput)->orWhere('name', $picInput)->first()
                    : null;

                $location = ! empty($row['lokasi'])
                    ? Location::where('name', $row['lokasi'])->first()
                    : null;

                $locationCategory = LocationCategory::where('name', $row['kategori_lokasi'])->first() ?? null;

                // --- Mapping kondisi ---
                $conditionMap = [
                    'baik'  => 'good',
                    'rusak' => 'broken',
                ];
                $inputCondition = strtolower(trim($row['kondisi'] ?? ''));
                $finalCondition = $conditionMap[$inputCondition] ?? 'good';

                // --- Cari atau buat item ---
                $item = null;

                if (! empty($row['uuid_kode_unik'])) {
                    $item = Item::where('public_uuid', trim($row['uuid_kode_unik']))->first();
                }

                if (! $item && ! empty($row['kode'])) {
                    $item = Item::where('code', trim($row['kode']))->first();
                }

                $item ??= new Item;

                // --- UUID ---
                if (blank($item->public_uuid)) {
                    $item->public_uuid = ! empty($row['uuid_kode_unik'])
                        ? trim($row['uuid_kode_unik'])
                        : (string) Str::uuid();
                }

                // --- Tanggal Beli ---
                $purchaseDate = null;
                if (! empty($row['tanggal_beli'])) {
                    $purchaseDate = \Carbon\Carbon::parse($row['tanggal_beli'])->format('Y-m-d');
                }

                // --- Isi Data ---
                $item->company_id    = $company->id;
                $item->category_id   = $category->id;
                $item->name          = $row['nama_barang'];
                $item->brand         = $row['merk'];
                $item->specification = ['seri' => $row['seri'] ?? null];
                $item->pic_id        = $pic?->id;
                $item->purchase_price = $row['harga_idr'];
                $item->purchase_date  = $purchaseDate;
                $item->condition     = $finalCondition;
                $item->description   = $row['deskripsi'] ?? null;
                $item->location_id            = $location?->id;
                $item->location_category_code = $locationCategory?->code;

                if (! empty($row['kode'])) {
                    $item->code = trim($row['kode']);
                } else {
                    $item->generateInventoryCode();
                }

                // Observer akan mengisi qr_code & generate QR
                $item->save();

                $this->successCount++;

                return $item; // harus return agar Maatwebsite tidak save ulang
            });

        } catch (\Throwable $e) {
            $namaBarang = $row['nama_barang'] ?? '-';
            $this->failures[] = [
                'row'    => $currentRow,
                'name'   => $namaBarang,
                'reason' => $e->getMessage(),
            ];

            return null; // skip baris ini, lanjut ke baris berikutnya
        }
    }

    // -------------------------------------------------------------------------

    public function registerEvents(): array
    {
        // Hook ini bisa dipakai untuk logging atau side-effect setelah import selesai.
        // Notifikasi ke user dilakukan dari Table action supaya bisa akses Filament session.
        return [
            AfterImport::class => function (AfterImport $event) {
                // Kosongkan — notifikasi ditangani di ItemsTable
            },
        ];
    }
}