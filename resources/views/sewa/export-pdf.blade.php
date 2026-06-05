```html
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
            line-height: 1.5;
        }

        /* ===== KOP SURAT ===== */
        .kop-wrapper {
            position: relative;
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

        .logo-kiri,
        .logo.kanan {
            width: 200px;
        }

        .logo-kanan {
            text-align: right;
        }

        .logo-danantara {
            width: 170px;
            height: auto;
        }

        .logo-pln {
            width: 170px;
            height: auto;
        }

        .kop-text {
            text-align: center;
        }

        .kop-text h2 {
            margin: 0;
            font-size: 22px;
            font-weight: bold;
            line-height: 1.2;
        }

        .kop-text h3 {
            margin: 3px 0;
            font-size: 17px;
            font-weight: bold;
            line-height: 1.2;
        }

        .kop-text p {
            margin: 2px 0;
            font-size: 11px;
            line-height: 1.3;
        }

        /* ===== HEADER ===== */
        .header {
            text-align: center;
            margin-bottom: 15px;
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
        }

        table,
        th,
        td {
            border: 1px solid #333;
        }

        th {
            background: #e9ecef;
            text-align: center;
            font-weight: bold;
        }

        th,
        td {
            padding: 6px;
        }

        td {
            vertical-align: middle;
            line-height: 1.4;
        }

        /* ===== ALIGNMENT ===== */
        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        /* ===== KONDISI ===== */
        .baik,
        .perbaikan,
        .rusak {
            color: black;
            font-weight: normal;
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

        .no-data {
            text-align: center;
            padding: 20px;
            font-style: italic;
        }
    </style>
</head>

<body>

    @php
        \Carbon\Carbon::setLocale('id');
    @endphp

    <!-- ===== KOP SURAT ===== -->
    <div class="kop-wrapper">

        <table class="kop-table">
            <tr>
            
            <!-- LOGO DANANTARA -->
            <td width="220" style="text-align:left; vertical-align:top;">
                <img src="{{ public_path('images/Danantara_Logo.png') }}"
                    style="width:150px; margin-top: -30px">
            </td>

                <!-- TEXT -->
                <td class="kop-text">
                    <h2>PT PLN NUSANTARA POWER</h2>
                    <h3>UNIT MAINTENANCE REPAIR & OVERHAUL</h3>

                    <p>
                        SMART-UMRO | Smart Management of Assets and Resource Terintegrasi
                    </p>

                </td>

            <!-- LOGO PLN-->
            <td width="200" style="text-align:right; vertical-align:top;">
                <img src="{{ public_path('images/Logo-PLN.png') }}" 
                    style="width:200px; margin-top:-35px;">
            </td>


            </tr>
        </table>

    </div>

    <!-- ===== HEADER ===== -->
    <div class="header">
        <h3>LAPORAN ITEM SEWA</h3>

        <p>
            Periode:
            {{ $tahun_awal ?? 'Semua' }}
            -
            {{ $tahun_akhir ?? date('Y') }}
            <br>

            Dicetak: {{ date('d/F/Y H:i') }}
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

                        <td class="text-center">
                            {{ $i + 1 }}
                        </td>

                        <td class="text-left">
                            {{ $d->kode_barang }}
                        </td>

                        <td class="text-left">
                            {{ $d->pic->nama_pic ?? '-' }}
                        </td>

                        <td class="text-left">
                            {{ $d->divisi->nama_divisi ?? '-' }}
                        </td>

                        <td class="text-left">
                            {{ $d->nama_barang }}
                        </td>

                        <td class="text-left">
                            {{ $d->ruang->nama_ruang ?? '-' }}
                        </td>

                        <td class="text-left">
                            {{ $d->tahun }}
                        </td>

                        <td class="text-left">

                            @if($d->kondisi == 'Baik')
                                <span class="baik">Baik</span>

                            @elseif($d->kondisi == 'Perlu Perbaikan')
                                <span class="perbaikan">
                                    Perlu Perbaikan
                                </span>

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