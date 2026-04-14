<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Inventaris Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 20px;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
        }
        .header h3 {
            margin: 0;
            font-size: 18px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #333;
        }
        th, td {
            padding: 7px 6px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }
        .kondisi-col {
            width: 90px;
            text-align: center;
        }
        .no-data {
            text-align: center;
            padding: 30px;
            font-style: italic;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h3>LAPORAN INVENTARIS BARANG</h3>
        <p>Periode: {{ $tahun_awal ?? 'Semua' }} - {{ $tahun_akhir ?? date('Y') }} | Dicetak: {{ date('d-m-Y H:i') }} - Filter : @if(isset($filter['ruang'])) Ruangan: {{ $ruang->nama_ruang ?? '-' }} @endif</p>
    </div>

    @if($data->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Ruang</th>
                    <th>PIC</th>
                    <th>Tahun Perolehan</th>
                    @foreach($tahun_list as $tahun)
                        <th class="kondisi-col">Kondisi {{ $tahun }}</th>
                    @endforeach
                    <th>Status Saat Ini</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $index => $b)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $b->kode_barang }}</strong></td>
                    <td>{{ $b->nama_barang }}</td>
                    <td>{{ $b->ruang->nama_ruang ?? '-' }}</td>
                    <td>{{ $b->pic->nama_pic ?? '-' }}</td>
                    <td>{{ $b->tahun_perolehan }}</td>
                    
                    <!-- Kolom Kondisi per Tahun -->
                    @foreach($tahun_list as $tahun)
                        <td class="kondisi-col">
                            {{ $b->kondisi_per_tahun[$tahun] ?? '-' }}
                        </td>
                    @endforeach
                    
                    <td>{{ $b->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">
            <p>Tidak ada data Item yang ditemukan untuk filter ini.</p>
        </div>
    @endif

    <div class="footer">
        <p>Mengetahui,<br><br><br><br>________________________<br>(Nama & Jabatan)</p>
        <p>Dicetak oleh Sistem Inventaris - {{ date('d-m-Y') }}</p>
    </div>

</body>
</html>