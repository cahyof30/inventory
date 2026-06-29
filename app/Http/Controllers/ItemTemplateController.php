<?php

namespace App\Http\Controllers;

use App\Exports\ItemUploadExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;

class ItemTemplateController extends Controller
{
    public function download()
    {
        // Kirim collection kosong agar Main Sheet hanya berisi header (template kosong)
        $emptyRecords = collect();
 
        return FacadesExcel::download(
            new ItemUploadExport($emptyRecords),
            'Template_Import_Peralatan_' . now()->format('Ymd') . '.xlsx'
        );
    }
}
