<?php

namespace App\Imports;

use App\Models\Company;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\Location;
use App\Models\User;
use App\Models\VehicleDetail;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\AfterImport;

class ItemVehicleImport implements SkipsEmptyRows, ToModel, WithEvents, WithHeadingRow
{
    /** Jumlah baris berhasil diimport */
    public int $successCount = 0;

    /** Kumpulan error: [ ['row' => N, 'name' => '...', 'reason' => '...'], ... ] */
    public array $failures = [];

    /** Nomor baris saat ini (mulai dari 2 karena baris 1 adalah header) */
    private int $rowNumber = 1;

    // -------------------------------------------------------------------------

    public function model(array $row): ?Item
    {
        $this->rowNumber++;
        $currentRow = $this->rowNumber;

        try {
            return DB::transaction(function () use ($row) {

                // --- Resolve relasi ---
                $company = Company::where('code', $row['perusahaan'])->first();
                if (! $company) {
                    throw new \Exception("Perusahaan dengan slug '{$row['perusahaan']}' tidak ditemukan.");
                }

                $category = ItemCategory::where('slug', 'kendaraan')->first();
                if (! $category) {
                    throw new \Exception("Kategori 'kendaraan' tidak ditemukan di database.");
                }

                $picInput = trim($row['pic'] ?? '');
                $pic = $picInput
                    ? User::where('short_name', $picInput)->orWhere('name', $picInput)->first()
                    : null;

                $location = ! empty($row['lokasi'])
                    ? Location::where('name', $row['lokasi'])->first()
                    : null;

                // --- Mapping kondisi ---
                $conditionMap = [
                    'baik' => 'good',
                    'rusak' => 'broken',
                ];
                $inputCondition = strtolower(trim($row['kondisi'] ?? ''));
                $finalCondition = $conditionMap[$inputCondition] ?? 'good';

                // --- Tanggal Beli ---
                $purchaseDate = null;
                if (! empty($row['tanggal_beli'])) {
                    $purchaseDate = \Carbon\Carbon::parse($row['tanggal_beli'])->format('Y-m-d');
                }

                // --- Buat Item (sama persis dengan ItemImport) ---
                $item = new Item;

                $item->company_id = $company->id;
                $item->category_id = $category->id;
                $item->name = $row['nama_barang'];
                $item->brand = $row['merk'];
                $item->specification = ['seri' => $row['seri'] ?? null];
                $item->pic_id = $pic?->id;
                $item->purchase_price = $row['harga_idr'];
                $item->purchase_date = $purchaseDate;
                $item->condition = $finalCondition;
                $item->description = $row['deskripsi'] ?? null;
                $item->location_id = $location?->id;

                if (! empty($row['kode'])) {
                    $item->code = trim($row['kode']);
                } else {
                    $item->generateInventoryCode();
                }

                // Observer akan mengisi qr_code & generate QR
                $item->save();

                // --- Tambahan khusus kendaraan ---
                VehicleDetail::create([
                    'item_id' => $item->id,
                    'license_plate' => $row['plat_nopol'],
                    'color' => $row['warna'] ?? null,
                    'engine_number' => $row['nomor_mesin'] ?? null,
                    'chassis_number' => $row['nomor_rangka'] ?? null,
                ]);

                $this->successCount++;

                return $item;
            });

        } catch (\Throwable $e) {
            $this->failures[] = [
                'row' => $currentRow,
                'name' => $row['nama'] ?? '-',
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
                // Kosongkan — notifikasi ditangani di ItemsTable
            },
        ];
    }
}
