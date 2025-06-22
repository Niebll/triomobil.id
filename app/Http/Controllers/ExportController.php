<?php

namespace App\Http\Controllers;
use App\Models\Car;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportCarPDF($id)
    {
        $car = Car::findOrFail($id); // ambil satu mobil berdasarkan ID

        $pdf = Pdf::loadView('admin.pdf.car_detail', compact('car'));
        return $pdf->download('car-' . $car->id . '.pdf');
    }

}
