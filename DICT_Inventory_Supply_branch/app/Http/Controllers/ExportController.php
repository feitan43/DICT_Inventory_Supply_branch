<?php
namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;


class ExportController extends Controller
{
    public function downloadExcelFile()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }


}
