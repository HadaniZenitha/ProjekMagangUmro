<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Stiker Barang</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* UKURAN STIKER (bisa disesuaikan) */
        .stiker {
            width: 300px;
            border: 2px solid #000;
            padding: 15px;
            text-align: center;
            background: #fff;
        }

        .title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .info {
            font-size: 12px;
            margin-bottom: 4px;
        }

        .kode {
            font-weight: bold;
            background: #000;
            color: #fff;
            padding: 3px 6px;
            display: inline-block;
            margin-bottom: 5px;
        }

        /* QR */
        .qr {
            margin-top: 10px;
        }

        /* HANYA UNTUK PRINT */
        @media print {
            body {
                margin: 0;
            }

            .wrapper {
                height: auto;
            }

            .no-print {
                display: none;
            }

            .stiker {
                border: 2px solid #000;
                box-shadow: none;
            }
        }
    </style>
</head>

<body>

<div class="wrapper">

    <div class="stiker">

        <div class="title">
            {{ $barang->nama_barang }}
        </div>

        <div class="kode">
            {{ $barang->kode_barang }}
        </div>

        <div class="info">
            Lokasi: {{ $barang->ruang->nama_ruang ?? '-' }}
        </div>

        <div class="info">
            Tahun: {{ $barang->tahun_perolehan }}
        </div>

        <div class="info">
            Kondisi: {{ $barang->kondisi ?? '-' }}
        </div>

        <div class="qr">
            {!! QrCode::size(120)->generate(route('barang.scan', $barang->kode_barang)) !!}
        </div>

    </div>

</div>

{{-- Tombol --}}
<div class="text-center mt-3 no-print">
    <button onclick="window.print()" style="padding:10px 20px; font-size:14px;">
        Cetak Stiker
    </button>
</div>

</body>
</html>