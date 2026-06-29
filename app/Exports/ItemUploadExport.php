<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ItemUploadExport implements WithMultipleSheets
{
    protected $records;

    public function __construct($records)
    {
        $this->records = $records;
    }

    public function sheets(): array
    {
        return [
            new ItemTemplateExport($this->records), // Sheet 1: Main Sheet
            new ItemDataExport(),                   // Sheet 2: DB Sheet
        ];
    }
}