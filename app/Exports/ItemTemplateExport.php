<?php
namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ItemTemplateExport implements FromCollection, WithHeadings, WithDrawings, WithMapping, WithColumnFormatting, WithStyles, WithTitle, WithEvents, ShouldAutoSize
{
    protected $records;

    // Kolom Main Sheet => Kolom Reference Sheet
    protected const DROPDOWN_MAP = [
        'C' => 'A', // Perusahaan
        'D' => 'B', // Kategori
        'H' => 'C', // PIC
        'I' => 'D', // Kategori Lokasi
        'J' => 'E', // Lokasi
        'M' => 'F', // Kondisi
    ];

    protected const YELLOW_COLS = ['C', 'D', 'H', 'I', 'J', 'M'];
    protected const BLUE_COLS   = ['E', 'F', 'G', 'K', 'L', 'N'];

    public function __construct($records)
    {
        $this->records = $records;
    }

    public function title(): string
    {
        return 'Main Sheet';
    }

    public function collection()
    {
        return $this->records->filter(fn($item) => $item->category?->slug !== 'kendaraan')->values();
    }

    public function map($item): array
    {
        return [
            // $item->public_uuid,
            $item->code,
            $item->company?->company_name,
            $item->category?->name,
            $item->name,
            $item->brand,
            $item->specification['seri'] ?? '-',
            $item->pic?->name ?? '-',
            $item->location?->locationCategory?->name,
            $item->location?->name,
            $item->purchase_price,
            $item->purchase_date ? Carbon::parse($item->purchase_date)->format('d-m-Y') : '-',
            match ($item->condition) {
                'good'   => 'Baik',
                'broken' => 'Rusak',
                default  => $item->condition,
            },
            '',
        ];
    }

    public function headings(): array
    {
        return [
            // 'UUID Kode Unik',  // A
            'Kode',            // B
            'Perusahaan',      // C ← dropdown
            'Kategori',        // D ← dropdown
            'Nama Barang',     // E
            'Merk',            // F
            'Seri',            // G
            'PIC',             // H ← dropdown
            'Kategori Lokasi', // I ← dropdown
            'Lokasi',          // J ← dropdown
            'Harga (IDR)',     // K
            'Tanggal_Beli',    // L
            'Kondisi',         // M ← dropdown
            'Deskripsi',       // N
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $mainSheet = $event->sheet->getDelegate();
                $workbook  = $mainSheet->getParent();
                $refSheet  = $workbook->getSheetByName('Reference Sheet');

                if (! $refSheet) {
                    return;
                }

                // ----------------------------------------------------------------
                // 1. Hitung jumlah baris aktual per kolom di Reference Sheet
                // ----------------------------------------------------------------
                $lastRows = [];
                foreach (array_unique(array_values(self::DROPDOWN_MAP)) as $refCol) {
                    $lastRow = 1;
                    $row     = 2;
                    while (true) {
                        $val = $refSheet->getCell("{$refCol}{$row}")->getValue();
                        if ($val === null || $val === '') {
                            break;
                        }
                        $lastRow = $row;
                        $row++;
                    }
                    $lastRows[$refCol] = $lastRow;
                }

                // ----------------------------------------------------------------
                // 2. Pasang DataValidation (dropdown) per kolom
                //    getCell('X2')->getDataValidation() lalu setSqref('X2:X1048576')
                //    adalah cara resmi PhpSpreadsheet untuk validasi per kolom
                // ----------------------------------------------------------------
                foreach (self::DROPDOWN_MAP as $mainCol => $refCol) {
                    $lastRefRow = $lastRows[$refCol] ?? 2;
                    $formula    = "'Reference Sheet'!\${$refCol}\$2:\${$refCol}\${$lastRefRow}";

                    $dv = $mainSheet->getCell("{$mainCol}2")->getDataValidation();
                    $dv->setType(DataValidation::TYPE_LIST);
                    $dv->setErrorStyle(DataValidation::STYLE_INFORMATION);
                    $dv->setAllowBlank(true);
                    $dv->setShowDropDown(false);   // false = TAMPILKAN panah dropdown
                    $dv->setShowInputMessage(true);
                    $dv->setShowErrorMessage(true);
                    $dv->setPromptTitle('Pilih nilai');
                    $dv->setPrompt('Pilih dari daftar yang tersedia.');
                    $dv->setFormula1($formula);
                    $dv->setSqref("{$mainCol}2:{$mainCol}1048576");
                }

                // ----------------------------------------------------------------
                // 3. Warna kolom (preview 100 baris)
                // ----------------------------------------------------------------
                $yellowFill = [
                    'fillType'   => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'FFF2CC'],
                ];
                $blueFill = [
                    'fillType'   => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'DDEEFF'],
                ];

                foreach (self::YELLOW_COLS as $col) {
                    $mainSheet->getStyle("{$col}2:{$col}100")->getFill()->applyFromArray($yellowFill);
                }
                foreach (self::BLUE_COLS as $col) {
                    $mainSheet->getStyle("{$col}2:{$col}100")->getFill()->applyFromArray($blueFill);
                }
            },
        ];
    }

    public function drawings()
    {
        return [];
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = max($this->records->count() + 1, 2);

        return [
            1 => [
                'font'      => ['bold' => true],
                'alignment' => [
                    'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],
            "A2:N{$highestRow}" => [
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }

    public function columnFormats(): array
    {
        return [
            'K' => '#,##0',
        ];
    }
}