<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class AbsensiExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithEvents
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Guru',
            'Tanggal',
            'Jam Masuk',
            'Foto Masuk',
            'Jam Pulang',
            'Foto Pulang',
            'Status Masuk',
            'Status Pulang',
        ];
    }

    public function map($item): array
    {
        static $no = 0;
        $no++;

        // Format tanggal (tanpa 00:00:00)
        $tanggal = Carbon::parse($item->tanggal)->format('Y-m-d');

        // Format jam masuk
        $jamMasuk = $item->waktu_masuk
            ? Carbon::parse($item->waktu_masuk)->format('H:i:s')
            : '-';

        // Format jam pulang
        $jamPulang = $item->waktu_pulang
            ? Carbon::parse($item->waktu_pulang)->format('H:i:s')
            : '-';

        // URL Foto Masuk (untuk hyperlink)
        $fotoMasuk = $item->foto_masuk
            ? asset('storage/' . $item->foto_masuk)
            : '-';

        // URL Foto Pulang (untuk hyperlink)
        $fotoPulang = $item->foto_pulang
            ? asset('storage/' . $item->foto_pulang)
            : '-';

        return [
            $no,
            $item->user->name ?? '-',
            $tanggal,
            $jamMasuk,
            $fotoMasuk,
            $jamPulang,
            $fotoPulang,
            $item->status_masuk ?? '-',
            $item->status_pulang ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Header bold dengan background
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4F46E5'], // Indigo
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            // Border semua cell
            'A1:I' . ($this->data->count() + 1) => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => 'D1D5DB'],
                    ],
                ],
            ],
            // Kolom foto dijadikan link (biru bergaris bawah)
            'E2:E' . ($this->data->count() + 1) => [
                'font' => [
                    'color' => ['rgb' => '2563EB'],
                    'underline' => true,
                ],
            ],
            'G2:G' . ($this->data->count() + 1) => [
                'font' => [
                    'color' => ['rgb' => '2563EB'],
                    'underline' => true,
                ],
            ],
        ];
    }

    // ============================================
    // MEMBUAT HYPERLINK DI EXCEL
    // ============================================
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $rowCount = $this->data->count() + 1;

                // Buat hyperlink di kolom E (Foto Masuk)
                for ($row = 2; $row <= $rowCount; $row++) {
                    $cell = $sheet->getCell('E' . $row);
                    $value = $cell->getValue();

                    if ($value && $value != '-') {
                        // Buat hyperlink
                        $sheet->setCellValue('E' . $row, '📷 Lihat Foto');
                        $sheet->getCell('E' . $row)->getHyperlink()->setUrl($value);

                        // Warna dan underline
                        $sheet->getStyle('E' . $row)->applyFromArray([
                            'font' => [
                                'color' => ['rgb' => '2563EB'],
                                'underline' => true,
                            ],
                        ]);
                    }
                }

                // Buat hyperlink di kolom G (Foto Pulang)
                for ($row = 2; $row <= $rowCount; $row++) {
                    $cell = $sheet->getCell('G' . $row);
                    $value = $cell->getValue();

                    if ($value && $value != '-') {
                        // Buat hyperlink
                        $sheet->setCellValue('G' . $row, '📷 Lihat Foto');
                        $sheet->getCell('G' . $row)->getHyperlink()->setUrl($value);

                        // Warna dan underline
                        $sheet->getStyle('G' . $row)->applyFromArray([
                            'font' => [
                                'color' => ['rgb' => '2563EB'],
                                'underline' => true,
                            ],
                        ]);
                    }
                }

                // Set lebar kolom
                $sheet->getColumnDimension('A')->setWidth(5);
                $sheet->getColumnDimension('B')->setWidth(25);
                $sheet->getColumnDimension('C')->setWidth(15);
                $sheet->getColumnDimension('D')->setWidth(15);
                $sheet->getColumnDimension('E')->setWidth(18);
                $sheet->getColumnDimension('F')->setWidth(15);
                $sheet->getColumnDimension('G')->setWidth(18);
                $sheet->getColumnDimension('H')->setWidth(15);
                $sheet->getColumnDimension('I')->setWidth(15);
            },
        ];
    }
}
