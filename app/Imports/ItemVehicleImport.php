<?php

namespace App\Imports;

use App\Models\Company;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\Location;
use App\Models\VehicleDetail;
use Illuminate\Support\Facades\DB; // Tambahkan ini
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ItemVehicleImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Bungkus dalam transaksi manual agar aman
        return DB::transaction(function () use ($row) {
            $company = Company::where('slug', $row['pemilik'])->first();
            $category = ItemCategory::where('slug', 'kendaraan')->first();
            $location = Location::where('slug', $row['lokasi'])->first();

            if (!$company || !$category) {
                return null;
            }

            $conditionMap = [
                'baik' => 'good',
                'rusak' => 'broken',
            ];
            $inputCondition = strtolower(trim($row['kondisi'] ?? ''));
            $finalCondition = $conditionMap[$inputCondition] ?? 'good';

            $item = new Item([
                'company_id'     => $company->id,
                'category_id'    => $category->id,
                'name'           => $row['nama'],
                'brand'          => $row['merk'],
                'purchase_price' => $row['harga_beli'],
                'purchase_date'  => \Carbon\Carbon::parse($row['tanggal_beli'])->format('Y-m-d'),
                'condition'      => $finalCondition,
                'description'    => $row['deskripsi'],
                'location_id'    => $location?->id,         
            ]);

            $item->generateInventoryCode();
            $item->qr_code = $item->code;
            $item->save();

            VehicleDetail::create([
                'item_id'        => $item->id,
                'license_plate'  => $row['nopol'],
                'engine_number'  => $row['nomor_mesin'] ?? null,
                'chassis_number' => $row['nomor_rangka'] ?? null,
            ]);

            return null; 
        });
    }
}
