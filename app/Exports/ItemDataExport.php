<?php
namespace App\Exports;

use App\Models\Company;
use App\Models\ItemCategory;
use App\Models\LocationCategory;
use App\Models\Location;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ItemDataExport implements FromArray, WithHeadings, WithStyles, WithTitle, ShouldAutoSize
{
    // Data di-resolve sekali, disimpan agar bisa diakses di styles()
    protected array $companies;
    protected array $categories;
    protected array $pics;
    protected array $locationCategories;
    protected array $locations;
    protected array $conditions;

    public function __construct()
    {
        $this->companies          = Company::orderBy('code')->pluck('code')->toArray();
        $this->categories         = ItemCategory::where('slug', '!=', 'kendaraan')->orderBy('name')->pluck('name')->toArray();
        $this->pics               = User::where('role', 'staf')->orderBy('name')->pluck('name')->toArray();
        $this->locationCategories = LocationCategory::orderBy('name')->pluck('name')->toArray();
        $this->locations          = Location::orderBy('name')->pluck('name')->toArray();
        $this->conditions         = ['Baik', 'Rusak'];
    }

    public function title(): string
    {
        return 'Reference Sheet';
    }

    public function array(): array
    {
        $maxRows = max(
            count($this->companies),
            count($this->categories),
            count($this->pics),
            count($this->locationCategories),
            count($this->locations),
            count($this->conditions),
        );

        $rows = [];
        for ($i = 0; $i < $maxRows; $i++) {
            $rows[] = [
                $this->companies[$i]          ?? '',
                $this->categories[$i]         ?? '',
                $this->pics[$i]               ?? '',
                $this->locationCategories[$i] ?? '',
                $this->locations[$i]          ?? '',
                $this->conditions[$i]         ?? '',
            ];
        }

        return $rows;
    }

    public function headings(): array
    {
        return [
            'Perusahaan',     // A
            'Kategori',       // B
            'PIC',            // C
            'Kategori Lokasi',// D
            'Lokasi',         // E
            'Kondisi',        // F
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow    = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        // Warna header per kolom agar mudah dibaca
        $headerColors = [
            'A' => 'D9EAD3', // hijau muda  — Perusahaan
            'B' => 'CFE2F3', // biru muda   — Kategori
            'C' => 'FFF2CC', // kuning      — PIC
            'D' => 'FCE5CD', // oranye muda — Kategori Lokasi
            'E' => 'EAD1DC', // pink muda   — Lokasi
            'F' => 'D9D2E9', // ungu muda   — Kondisi
        ];

        $styles = [
            1 => [
                'font'      => ['bold' => true],
                'alignment' => [
                    'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],
            "A2:{$highestColumn}{$highestRow}" => [
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
        ];

        // Terapkan warna header per kolom
        foreach ($headerColors as $col => $rgb) {
            $sheet->getStyle("{$col}1")
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB($rgb);
        }

        return $styles;
    }
}