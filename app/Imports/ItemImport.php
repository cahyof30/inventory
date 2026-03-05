<?php

namespace App\Imports;

use App\Models\Company;
use App\Models\Item;
use App\Models\ItemCategory; // Pastikan model ini diimport
use App\Models\Location; // Pastikan model ini diimport
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ItemImport implements ToModel, WithHeadingRow
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        // Cari ID Perusahaan berdasarkan Slug
        $company = Company::where('slug', $row['pemilik'])->first();

        // Cari ID Kategori berdasarkan Slug
        $category = ItemCategory::where('name', $row['kategori'])->first();

        // Cari lokasi secara terpisah agar bisa divalidasi
        $location = Location::where('slug', $row['lokasi'])->first();
        // Jika perusahaan atau kategori tidak ditemukan,
        // Anda bisa return null (skip baris ini) atau beri logika error
        if (! $company || ! $category) {
            return null;
        }

        $conditionMap = [
            'baik' => 'good',
            'rusak' => 'broken',
        ];

        // Ambil input dari excel, ubah ke lowercase untuk pencocokan
        $inputCondition = strtolower(trim($row['kondisi']));

        // Cari nilainya, jika tidak ada di map maka default ke 'good'
        $finalCondition = $conditionMap[$inputCondition] ?? 'good';

        $item = new Item([
            // 'nama_kolom_di_db' => $row['nama_header_di_excel']
            'company_id' => $company->id,
            'category_id' => $category->id,
            'name' => $row['nama'],
            'brand' => $row['merk'],
            'purchase_price' => $row['harga_beli'],
            'purchase_date' => \Carbon\Carbon::parse($row['tanggal_beli'])->format('Y-m-d'),
            'condition' => $finalCondition, // isi: good/broken
            'description' => $row['deskripsi'],
            'location_id' => $location?->id,         
            ]);
              // PAKSA GENERATE KODE SEKARANG (Sebelum Save/Observer)
        // Karena Observer butuh $item->code untuk dikirim ke Google Sheets
        $item->generateInventoryCode();
        $item->qr_code = $item->code;

        return $item;
    }
}
