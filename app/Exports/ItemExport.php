<?php
namespace App\Exports;

use BaconQrCode\Renderer\ImageRenderer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use BaconQrCode\Renderer\RendererStyle\RendererStyle as Style;
use BaconQrCode\Renderer\Image\GdImageBackEnd;
use BaconQrCode\Writer;
use BaconQrCode\Renderer\Image\QrCodeSum;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


// 1. Tambahkan ShouldAutoSize di sini
class ItemExport implements FromCollection, WithHeadings, WithDrawings, WithMapping, WithColumnFormatting, WithStyles, \Maatwebsite\Excel\Concerns\ShouldAutoSize
{
    protected $records;

    public function __construct($records)
    {
        $this->records = $records;
    }

    public function collection()
    {
        return $this->records;
    }

    public function map($item): array
    {
        return [
            $item->code,
            $item->name,
            $item->brand,
            $item->category?->name,
            $item->purchase_price,
            match ($item->condition) {
                'good' => 'Baik',
                'broken' => 'Rusak',
                default => $item->condition,
            },
            '', 
        ];
    }

    public function headings(): array
    {
        return ['Kode', 'Nama Barang', 'Merk', 'Kategori', 'Harga (IDR)', 'Kondisi', 'QR Code'];
    }

    public function drawings()
    {
        $drawings = [];
        foreach ($this->records as $index => $item) {
            $row = $index + 2; 
            $fileName = 'qr_' . $item->code . '.png';
            $path = storage_path('app/public/' . $fileName);
            $url = "https://quickchart.io/qr?text=" . urlencode($item->code) . "&size=150";

            try {
                $imageContent = @file_get_contents($url);
                if ($imageContent !== false) {
                    file_put_contents($path, $imageContent);
                    if (file_exists($path)) {
                        $drawing = new Drawing();
                        $drawing->setName('QR_' . $item->code);
                        $drawing->setPath($path);
                        $drawing->setHeight(85); // Sedikit lebih besar agar pas di baris 120
                        $drawing->setCoordinates('G' . $row);
                        $drawing->setOffsetX(1); // Kasih jarak sedikit dari kiri cell
                        $drawing->setOffsetY(1); // Kasih jarak sedikit dari atas cell
                        $drawings[] = $drawing;
                    }
                }
            } catch (\Exception $e) { continue; }
        }
        return $drawings;
    }

   public function styles(Worksheet $sheet)
{
    $highestRow = $this->records->count() + 1;
    $highestColumn = $sheet->getHighestColumn(); // Biasanya 'G'

    // 1. Set Tinggi Baris (Data)
    for ($i = 2; $i <= $highestRow; $i++) {
        $sheet->getRowDimension($i)->setRowHeight(70);
    }

    // 2. Set Lebar Kolom G (QR) secara manual
    $sheet->getColumnDimension('G')->setAutoSize(false);
    $sheet->getColumnDimension('G')->setWidth(25);

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
            'E' => '#,##0',
        ];
    }
}
