<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Item Inventaris</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 20px;
            line-height: 1.5;
        }

        /* ===== HEADER KOP ===== */
        .kop-wrapper {
            width: 100%;
            border-bottom: 3px solid #000;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .kop-table {
            width: 100%;
            border: none !important;
        }

        .kop-table td {
            border: none !important;
            vertical-align: middle;
        }

        .logo-col {
            width: 90px;
        }

        .logo {
            width: 75px;
        }

        .kop-text {
            text-align: center;
        }

        .kop-text h2 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
        }

        .kop-text h3 {
            margin: 2px 0;
            font-size: 16px;
            font-weight: bold;
        }

        .kop-text p {
            margin: 2px 0;
            font-size: 11px;
        }

        /* ===== JUDUL ===== */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h3 {
            margin: 0;
            font-size: 16px;
            letter-spacing: 0.5px;
        }

        .header p {
            margin: 5px 0;
            font-size: 10px;
        }

        /* ===== TABLE ===== */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #333;
        }

        th {
            background-color: #e9ecef;
            font-weight: bold;
            text-align: center;
        }

        th, td {
            padding: 6px;
        }

        td {
            vertical-align: middle;
        }

        /* ===== ALIGNMENT ===== */
        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        /* ===== KOLOM ===== */
        .kondisi-col {
            width: 80px;
            text-align: center;
        }

        .tahun-col {
            width: 70px;
            text-align: center;
        }

        .no-col {
            width: 30px;
            text-align: center;
        }

        /* ===== STATUS ===== */
        .aktif {
            color: green;
            font-weight: bold;
        }

        .nonaktif {
            color: red;
            font-weight: bold;
        }

        /* ===== EMPTY ===== */
        .no-data {
            text-align: center;
            padding: 30px;
            font-style: italic;
        }

        /* ===== FOOTER ===== */
        .footer {
            margin-top: 40px;
            width: 100%;
        }

        .ttd {
            width: 250px;
            float: right;
            text-align: center;
        }

    </style>
</head>

<body>

    <!-- ===== KOP SURAT ===== -->
    <div class="kop-wrapper">

        <table class="kop-table">
            <tr>

                <!-- LOGO -->
                <td class="logo-col">
                    <img src="{{ public_path('images/icon.png') }}" class="logo">
                </td>

                <!-- TEXT -->
                <td class="kop-text">
                    <h2>PT PLN NUSANTARA POWER</h2>
                    <h3>UNIT MAINTENANCE REPAIR OVERHAUL GRESIK</h3>

                    <p>
                        SMART-UMRO | Smart Management of Assets and Resource Terintegrasi
                    </p>

                    <p>
                        Jl. Harun Thohir No.1, Pulopancikan, Kec. Gresik, Kabupaten Gresik
                    </p>

                    <p>
                        Telp: (031) 3981811 | Website: https://www.plnnusantarapower.co.id
                    </p>
                </td>

            </tr>
        </table>

    </div>

    <!-- ===== JUDUL ===== -->
    <div class="header">
        <h3>LAPORAN ITEM INVENTARIS</h3>

        <p>
            Periode: {{ $tahun_awal ?? 'Semua' }} - {{ $tahun_akhir ?? date('Y') }} <br>

            Dicetak: {{ date('d/F/Y H:i') }}

            @if(isset($filter['ruang']))
                | Ruangan: {{ $ruang->nama_ruang ?? '-' }}
            @endif
        </p>
    </div>

    @if($data->count() > 0)

    <table>
        <thead>
            <tr>
                <th class="no-col">No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Ruang</th>
                <th>PIC</th>
                <th class="tahun-col">Tahun</th>

                @foreach($tahun_list as $tahun)
                    <th class="kondisi-col">Kondisi {{ $tahun }}</th>
                @endforeach

                <th class="kondisi-col">Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach($data as $index => $b)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-left"><strong>{{ $b->kode_barang }}</strong></td>
                <td class="text-left">{{ $b->nama_barang }}</td>
                <td class="text-left">{{ $b->ruang->nama_ruang ?? '-' }}</td>
                <td class="text-left">{{ $b->pic->nama_pic ?? '-' }}</td>
                <td class="text-center">{{ $b->tahun_perolehan }}</td>

                @foreach($tahun_list as $tahun)
                    <td class="text-center">
                        {{ $b->kondisi_per_tahun[$tahun] ?? '-' }}
                    </td>
                @endforeach

                <td class="text-center">
                    @if($b->is_active)
                        <span class="aktif">Aktif</span>
                    @else
                        <span class="nonaktif">Nonaktif</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @else

        <div class="no-data">
            Tidak ada data Item yang ditemukan untuk filter ini.
        </div>

    @endif

    <!-- ===== FOOTER ===== -->
    <div class="footer">

        <div class="ttd">
            <p>
                Mengetahui,<br><br><br><br>

                ________________________<br>
                (Nama & Jabatan)
            </p>
        </div>

        <div style="clear: both;"></div>

        <p style="text-align:center; font-size:10px;">
            Dicetak oleh Sistem Inventaris - {{ date('d/F/Y') }}
        </p>

    </div>

</body>
</html>