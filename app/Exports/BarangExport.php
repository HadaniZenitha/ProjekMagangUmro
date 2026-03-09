<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function ($b) {
            return [
                'Kode'   => $b->kode_barang,
                'Nama'   => $b->nama_barang,
                'Divisi' => $b->divisi->nama_divisi ?? '-',
                'PIC'    => $b->pic->nama_pic ?? '-',
                'Ruang'  => $b->ruang->nama_ruang ?? '-',
                'Tahun'  => $b->tahun_perolehan,
                'Status' => $b->is_active ? 'Aktif' : 'Nonaktif',
                'Catatan'=> $b->catatan_nonaktif ?? '-'
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Kode','Nama','Divisi','PIC',
            'Ruang','Tahun','Status','Catatan', 'QR Code'
        ];
    }
}
