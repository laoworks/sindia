<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsensiExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function ($item) {
            return [
                'nama_guru'    => $item->user->name ?? '-',
                'tanggal'      => $item->tanggal,
                'jam_masuk'    => $item->waktu_masuk,
                'jam_pulang'   => $item->waktu_pulang,
                'status_masuk' => $item->status_masuk,
                'status_pulang' => $item->status_pulang,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Guru',
            'Tanggal',
            'Jam Masuk',
            'Jam Pulang',
            'Status Masuk',
            'Status Pulang',
        ];
    }
}
