<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangSewaExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function ($d, $i) {
            return [
                'No' => $i + 1,
                'Kode' => $d->kode_barang,
                'PIC' => $d->pic->nama_pic ?? '-',
                'Fungsi' => $d->divisi->nama_divisi ?? '-',
                'Nama Item' => $d->nama_barang,
                'Lokasi' => $d->ruang->nama_ruang ?? '-',
                'Tahun' => $d->tahun,
                'Kondisi' => $d->kondisi,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode',
            'PIC',
            'Fungsi',
            'Nama Item',
            'Lokasi',
            'Tahun',
            'Kondisi'
        ];
    }
}