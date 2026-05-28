<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class AbsensiExportController extends Controller
{
    // =========================
    // EXPORT EXCEL
    // =========================
    public function excel(Request $request)
    {
        $data = Absensi::with('user')
            ->orderBy('tanggal', 'desc')
            ->get();

        return Excel::download(
            new \App\Exports\AbsensiExport($data),
            'data-absensi.xlsx'
        );
    }

    // =========================
    // EXPORT PDF
    // =========================
    public function pdf(Request $request)
    {
        $data = Absensi::with('user')
            ->orderBy('tanggal', 'desc')
            ->get();

        $pdf = Pdf::loadView('operator.absensi.pdf', [
            'absensi' => $data
        ]);

        return $pdf->download('data-absensi.pdf');
    }
}
