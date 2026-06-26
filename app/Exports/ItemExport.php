<?php
namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use Milon\Barcode\DNS1D;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use \Maatwebsite\Excel\Concerns\ShouldAutoSize;


// 1. Tambahkan ShouldAutoSize di sini
class ItemExport implements FromCollection, WithHeadings, WithDrawings, WithMapping, WithColumnFormatting, WithStyles, ShouldAutoSize
{
    protected $records;

    public function __construct($records)
    {
        $this->records = $records;
    }

    public function collection()
    {
         return $this->records->filter(function ($item) {
        return $item->category?->slug !== 'kendaraan';
    })->values();
    }

    public function map($item): array
    {
        return [
            $item->public_uuid,
            $item->code,
            $item->company?->company_name,
            $item->category?->name,
            $item->name,
            $item->brand,
            $item->specification['seri'] ?? '-',
            $item->pic?->name ?? '-',
            // $item->location?->locationCategory?->name,
            $item->location?->name,
            $item->purchase_price,
            $item->purchase_date ? Carbon::parse($item->purchase_date)->format('d-m-Y') : '-',
            match ($item->condition) {
                'good' => 'Baik',
                'broken' => 'Rusak',
                default => $item->condition,
            },
            '', 
            '', 
        ];
    }

    public function headings(): array
    {
        return ['UUID Kode Unik', 'Kode', 'Perusahaan','Kategori', 'Nama Barang', 'Merk', 'Seri', 'PIC', 'Lokasi', 'Harga (IDR)', 'Tanggal_Beli', 'Kondisi', 'Deskripsi'
        // 'QR Code', 'Barcode'
        ];
    }

   public function drawings()
{
    $drawings = [];

    foreach ($this->records as $index => $item) {
        $row = $index + 2;

        /*
        |--------------------------------------------------------------------------
        | QR CODE (Kolom H)
        |--------------------------------------------------------------------------
        */

        // $qrFile = 'qr_' . $item->code . '.png';
        // $qrPath = storage_path('app/public/' . $qrFile);
        // $qrUrl = "https://quickchart.io/qr?text=" . urlencode($item->code) . "&size=150";

        // try {
        //     $imageContent = @file_get_contents($qrUrl);
        //     if ($imageContent !== false) {
        //         file_put_contents($qrPath, $imageContent);

        //         if (file_exists($qrPath)) {
        //             $qrDrawing = new Drawing();
        //             $qrDrawing->setName('QR_' . $item->code);
        //             $qrDrawing->setPath($qrPath);
        //             $qrDrawing->setHeight(70);
        //             $qrDrawing->setCoordinates('I' . $row);
        //             $drawings[] = $qrDrawing;
        //         }
        //     }
        // } catch (\Exception $e) {
        //     continue;
        // }

        /*
        |--------------------------------------------------------------------------
        | BARCODE (Kolom I)
        |--------------------------------------------------------------------------
        */

        // try {
        //     $dns = new DNS1D();
        //     $dns->setStorPath(storage_path('framework/barcode/'));

        //     $barcodeBase64 = $dns->getBarcodePNG($item->code, 'C128', 2, 60);

        //     $barcodeFile = 'barcode_' . $item->code . '.png';
        //     $barcodePath = storage_path('app/public/' . $barcodeFile);

        //     file_put_contents(
        //         $barcodePath,
        //         base64_decode($barcodeBase64)
        //     );

        //     if (file_exists($barcodePath)) {
        //         $barcodeDrawing = new Drawing();
        //         $barcodeDrawing->setName('BARCODE_' . $item->code);
        //         $barcodeDrawing->setPath($barcodePath);
        //         $barcodeDrawing->setHeight(35);
        //         $barcodeDrawing->setCoordinates('J' . $row);
        //         $drawings[] = $barcodeDrawing;
        //     }

        // } catch (\Exception $e) {
        //     continue;
        // }
    }

    return $drawings;
}

   public function styles(Worksheet $sheet)
{
    $highestRow = $this->records->count() + 1;
    $highestColumn = $sheet->getHighestColumn(); // Biasanya 'G'

    // 1. Set Tinggi Baris (Data)
    // for ($i = 2; $i <= $highestRow; $i++) {
    //     $sheet->getRowDimension($i)->setRowHeight(70);
    // }

    // 2. Set Lebar Kolom G (QR) secara manual
    // $sheet->getColumnDimension('I')->setAutoSize(false);
    // $sheet->getColumnDimension('I')->setWidth(10);
    // 2. Set Lebar Kolom G (QR) secara manual
    // $sheet->getColumnDimension('J')->setAutoSize(false);
    // $sheet->getColumnDimension('J')->setWidth(40);

    // 3. Styling Header & Perataan Tengah (Vertical Alignment)
    return [
        // Header: Bold & Center
        1 => [
            'font' => ['bold' => true],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ],
        // Semua Range Data: Middle Align
        "A2:{$highestColumn}{$highestRow}" => [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ],
    ];
}


    public function columnFormats(): array 
    {
        return [
            'J' => '#,##0',
        ];
    }
}
