<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Inventaris - {{ $barang->kode_barang }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        body { background-color: #f0f2f5; font-family: 'Inter', -apple-system, sans-serif; }
        .header-brand { background-color: #0097a7; padding: 20px 0; border-bottom: 4px solid #ffc107; margin-bottom: 25px; }
        .card { border: none; border-radius: 8px; overflow: hidden; }
        .card-header-custom { background-color: #ffffff; border-bottom: 1px solid #edf2f7; padding: 15px 20px; }
        .header-title { color: #2d3748; font-weight: 700; font-size: 1.1rem; margin-bottom: 0; }
        .img-container { background: #f8f9fa; border: 1px dashed #cbd5e0; border-radius: 8px; height: 200px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; }
        .img-container img { max-width: 100%; max-height: 100%; object-fit: contain; }
        .info-row { display: flex; padding: 12px 0; border-bottom: 1px solid #edf2f7; }
        .info-row:last-child { border-bottom: none; }
        .info-label { width: 40%; color: #718096; font-size: 0.75rem; text-transform: uppercase; font-weight: 600; }
        .info-value { width: 60%; color: #1a202c; font-weight: 500; font-size: 0.9rem; word-break: break-all; }
        .footer-text { color: #a0aec0; font-size: 0.7rem; margin-top: 30px; }
    </style>
</head>
<body>

<div class="header-brand text-center shadow-sm">
    <h5 class="text-white fw-bold mb-0">SMART-UMRO</h5>
    <small class="text-white-50">Sistem Manajemen Aset Terintegrasi</small>
</div>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            
            <div class="card shadow-sm">
                <div class="card-header-custom">
                    <h6 class="header-title"><i class="fa-solid fa-circle-info me-2 text-warning"></i>Detail Inventaris</h6>
                </div>
                
                <div class="card-body p-4">
                    <div class="img-container shadow-sm p-2">
                        @if ($barang->foto)
                            <img src="{{ asset('storage/' . $barang->foto) }}" alt="{{ $barang->nama_barang }}">
                        @else
                            <div class="text-center text-muted">
                                <i class="fa-solid fa-image fa-3x mb-2 opacity-25"></i>
                                <p class="small mb-0">Foto tidak tersedia</p>
                            </div>
                        @endif
                    </div>

                    @if(!$barang->is_active)
                    <div class="alert alert-danger border-0 shadow-sm mb-4">
                        <h6 class="fw-bold mb-1" style="font-size: 0.85rem;">
                            <i class="fa-solid fa-circle-exclamation me-2"></i>Barang Nonaktif
                        </h6>
                        <p class="mb-0 small italic">
                            "{{ $barang->catatan_nonaktif ?? 'Tidak ada catatan alasan penonaktifan.' }}"
                        </p>
                    </div>
                    @endif

                    <div class="info-table mt-2">
                        <div class="info-row">
                            <div class="info-label">Kode Barang</div>
                            <div class="badge bg-dark">{{ $barang->kode_barang }}</div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Nama Barang</div>
                            <div class="info-value">{{ $barang->nama_barang }}</div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Lokasi & PIC</div>
                            <div class="info-value">
                                <span class="d-block text-capitalize">{{ $barang->ruang->nama_ruang ?? '-' }}</span>
                                <small class="text-muted">Oleh: {{ $barang->pic->nama_pic ?? '-' }}</small>
                            </div>
                        </div>

                        <div class="info-row align-items-center">
                            <div class="info-label">Status Kondisi</div>
                            <div class="info-value">
                                <span class="badge bg-{{ $barang->kondisi == 'baik' ? 'success' : ($barang->kondisi == 'perlu perbaikan' ? 'warning' : 'danger') }} px-2 py-1">
                                    {{ ucfirst($barang->kondisi) }}
                                </span>
                                <span class="badge bg-{{ $barang->is_active ? 'info' : 'secondary' }} text-white px-2 py-1 ms-1">
                                    {{ $barang->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Tahun Perolehan</div>
                            <div class="info-value">{{ $barang->tahun_perolehan }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center footer-text">
                <p class="mb-1 fw-bold text-secondary">PLN Nusantara Power</p>
                <p class="mb-0 small">Sistem Inventaris Unit Maintenance Repair And Overhaul</p>
                <hr class="w-25 mx-auto">
                <p class="small italic">Diakses: {{ now()->timezone('Asia/Jakarta')->format('d M Y H:i') }} WIB</p>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>