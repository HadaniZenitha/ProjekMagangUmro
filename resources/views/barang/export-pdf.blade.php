<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h3 {
            margin: 0;
            font-size: 18px;
        }
        .header p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
        }
        .no-data {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h3>Laporan Inventaris Barang</h3>
        <p>Dibuat pada: {{ date('d-m-Y H:i:s') }}</p>
    </div>

    @if($data->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Divisi</th>
                    <th>PIC</th>
                    <th>Ruang</th>
                    <th>Tahun</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $b)
                <tr>
                    <td>{{ $b->kode_barang }}</td>
                    <td>{{ $b->nama_barang }}</td>
                    <td>{{ $b->divisi->nama_divisi ?? '-' }}</td>
                    <td>{{ $b->pic->nama_pic ?? '-' }}</td>
                    <td>{{ $b->ruang->nama_ruang ?? '-' }}</td>
                    <td>{{ $b->tahun_perolehan }}</td>
                    <td>{{ $b->is_active ? 'Aktif':'Nonaktif' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">
            <p>Tidak ada data barang yang ditemukan.</p>
        </div>
    @endif

    <table style="border:0;width:100%">

        <tr style="border:0">
        
        <td style="border:0;text-align:right">
        
        Mengetahui,<br><br><br><br>
        
        ________________________
        
        </td>

        </tr>

    </table>
    
    <div class="footer">
        <p>Dicetak oleh Sistem Inventaris - {{ date('d-m-Y') }}</p>
    </div>
</body>
</html>