<!doctype html>
<html>
<head>
    <title>Info Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
    <h3>Informasi Barang</h3>

    <div class="card">
        <div class="card-body">
            <h5>{{ $barang->nama_barang }}</h5>
            <p><b>Kode:</b> {{ $barang->kode_barang }}</p>
            <p><b>Lokasi:</b> {{ $barang->ruang->nama_ruang }}</p>
            <p><b>Tahun Masuk:</b> {{ $barang->tahun_perolehan }}</p>
            <p><b>Keterangan:</b> {{ $barang->keterangan }}</p>
        </div>
    </div>
</div>

</body>
</html>
