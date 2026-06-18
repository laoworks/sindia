<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class AbsensiExportController extends Controller
{
    private function filteredQuery(Request $request)
    {
        return Absensi::with('user')
            ->when($request->filled('tanggal'), function ($query) use ($request) {
                $query->whereDate('tanggal', $request->tanggal);
            })
            ->when($request->filled('user_id'), function ($query) use ($request) {
                $query->where('user_id', $request->user_id);
            })
            ->orderBy('tanggal', 'desc');
    }

    // =========================
    // EXPORT EXCEL
    // =========================
    public function excel(Request $request)
    {
        $data = $this->filteredQuery($request)->get();

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
        $data = $this->filteredQuery($request)->get();

        $pdf = Pdf::loadView('operator.absensi.pdf', [
            'absensi' => $data
        ]);

        return $pdf->download('data-absensi.pdf');
    }
}
