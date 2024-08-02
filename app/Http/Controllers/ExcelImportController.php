<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ExcelImportController extends Controller
{
    public function collection(Collection $rows)
    {
        return $rows;
    }
}
