<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Item Sewa</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h3 {
            margin: 0;
            font-size: 16px;
        }

        .header p {
            margin: 4px 0;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #333;
        }

        th, td {
            padding: 6px;
        }

        th {
            background: #f0f0f0;
            text-align: center;
        }

        td {
            vertical-align: middle;
        }

        .text-center {
            text-align: center;
        }

        .baik {
            color: green;
            font-weight: bold;
        }

        .perbaikan {
            color: orange;
            font-weight: bold;
        }

        .rusak {
            color: red;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            font-style: italic;
        }
    </style>
</head>

<body>

    <div class="header">
        <h3>LAPORAN ITEM SEWA</h3>
        <p>
            Periode: {{ $tahun_awal ?? 'Semua' }} - {{ $tahun_akhir ?? date('Y') }} |
            Dicetak: {{ date('d-F-Y H:i') }}
        </p>
    </div>

    @if($data->count() > 0)

    <table>
        <thead>
            <tr>
                <th width="30">No</th>
                <th>Kode</th>
                <th>PIC</th>
                <th>Fungsi</th>
                <th>Nama Item</th>
                <th>Lokasi</th>
                <th width="60">Tahun</th>
                <th width="90">Kondisi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($data as $i => $d)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td>{{ $d->kode_barang }}</td>
                <td>{{ $d->pic->nama_pic ?? '-' }}</td>

                {{-- 🔥 FIX DI SINI --}}
                <td>{{ $d->divisi->nama_divisi ?? '-' }}</td>

                <td>{{ $d->nama_barang }}</td>
                <td>{{ $d->ruang->nama_ruang ?? '-' }}</td>
                <td class="text-center">{{ $d->tahun }}</td>

                <td class="text-center">
                    @if($d->kondisi == 'Baik')
                        <span class="baik">Baik</span>
                    @elseif($d->kondisi == 'Perlu Perbaikan')
                        <span class="perbaikan">Perlu Perbaikan</span>
                    @else
                        <span class="rusak">Rusak</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @else
        <div class="no-data">
            Tidak ada data Item Sewa
        </div>
    @endif

    <div class="footer">
        <p>
            Mengetahui,<br><br><br><br>
            ________________________<br>
            (Nama & Jabatan)
        </p>

        <p>Dicetak oleh Sistem Inventaris - {{ date('d/m/Y') }}</p>
    </div>

</body>
</html>