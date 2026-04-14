<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMART-UMRO | Smart Management of Assets and Resource Terintegrasi UMRO</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>

        html, body {
        height: 100%;
    }

        :root {
            --bg-sidebar: #309FB0;
            --pln-yellow: #FACC15;
            --pln-red: #E57373;
            --menu-bg: #B2D8DB;
            --menu-active: #D1E9EB;
            --text-dark: #1F3A56;
        }

        body {
            min-height: 100vh;
            background-color: #E0E7E9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        /* ================= SIDEBAR ================= */

        .sidebar {
            width: 280px;
            height: 100vh;
            background: var(--bg-sidebar);
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            z-index: 1000;
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
            justify-content: space-between;
        }

        /* SIDEBAR CLOSED */
        .sidebar.closed {
            transform: translateX(-100%);
        }

        .sidebar-brand {
            background: var(--bg-sidebar);
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;

            /* garis dibuat lebih halus */
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-header {
            padding: 20px;
            color: white;
        }

        .sidebar-header h3 {
            font-weight: bold;
            margin-bottom: 0;
        }

        .sidebar-header p {
            font-size: 0.85rem;
            margin-bottom: 0;
            opacity: 0.9;
        }

        .menu-container {
            flex: 1;
            overflow-y: auto;
            padding: 10px 8px;
        }

        /* MENU */
        .sidebar a {
            color: var(--text-dark);
            text-decoration: none;
            padding: 12px 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;

            background: var(--menu-bg);

            /* jarak lebih halus */
            margin-bottom: 2px;

            font-weight: bold;
            font-size: 0.85rem;
            text-transform: uppercase;

            transition: all 0.2s ease-in-out;

            border-left: 5px solid transparent;

            /* membuat menu lebih smooth */
            border-radius: 6px;
        }

        .sidebar a:hover {
            background: var(--menu-active);
            color: var(--text-dark);
            padding-left: 22px;
        }

        /* ACTIVE MENU */
        .sidebar a.active,
        .nav-link-collapse:not(.collapsed) a {
            background: var(--menu-active) !important;
            border-left: 5px solid var(--pln-yellow);
            color: var(--text-dark);
        }

        /* SUB MENU */
        .sub-menu {
            background: rgba(255, 255, 255, 0.15);
            margin-bottom: 0;
            border-radius: 6px;
        }

        .sub-menu a {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center;

            padding-left: 42px !important;

            font-size: 0.8rem !important;
            background: transparent !important;

            border-left: 3px solid transparent;
            margin-bottom: 0;
        }

        .sub-menu a.active-sub {
            color: var(--text-dark) !important;
            background: var(--pln-yellow) !important;
            border-left: 3px solid var(--text-dark);
        }

        .sub-menu a:hover {
            background: rgba(255, 255, 255, 0.08) !important;
            padding-left: 46px !important;
        }

        /* ICON ROTATE */
        .rotate-icon {
            transition: transform 0.3s;
            font-size: 0.7rem !important;
            margin-left: auto;
            margin-right: 15px;
        }

        .nav-link-collapse:not(.collapsed) .rotate-icon {
            transform: rotate(90deg);
        }

        /* LOGOUT */
        .logout-container {
            padding: 20px;
            background: var(--bg-sidebar);
            border-top: 1px solid rgba(255,255,255,0.08);
            margin-top: auto;
        }

        .btn-logout-pln {
            background: var(--pln-yellow);
            color: var(--text-dark) !important;
            border: none;
            width: 100%;
            padding: 10px;
            font-weight: bold;
            border-radius: 6px;
            text-transform: uppercase;

            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;

            box-shadow: 0 4px 0 #b39400;
        }

        .btn-logout-pln:hover {
            background: #f0c000;
            box-shadow: 0 6px 0 #b39400;
            transform: translateY(-2px);
        }

        .btn-logout-pln:active {
            transform: translateY(2px);
            box-shadow: none;
        }

        /* Style Badge Status */
        .badge-status {
            padding: 5px 12px;
            border-radius: 50px; /* Membuat bentuk kapsul */
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }
        
        .bg-status-aktif {
            background-color: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }
        
        .bg-status-nonaktif {
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }

        /* ================= MAIN ================= */

        .main-wrapper {
            margin-left: 280px;
            min-height: 100vh;
            transition: margin-left 0.3s ease-in-out;
        }

        .top-navbar {
            background: white;
            padding: 10px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }

        .search-box {
            background: #F0F0F0;
            border-radius: 20px;
            padding: 5px 15px;
            border: none;
            width: 300px;
        }

        .banner-header {
            background: linear-gradient(rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.7)),
                url('https://www.toptal.com/designers/subtlepatterns/patterns/factory.png');
            height: 120px;
            padding: 20px 40px;
        }

        .content-card {
            background: white;
            margin: -40px 30px 30px;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* ================= RESPONSIVE ================= */

        .mobile-toggle {
            display: none;
            cursor: pointer;
            font-size: 20px;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.4);
            z-index: 999;
            display: none;
        }

        /* Prevent Laravel pagination SVG arrows from stretching in non-Tailwind pages */
        .pagination svg {
            width: 1rem;
            height: 1rem;
        }

        .date-mobile {
            display: none;
        }

        @media (max-width: 576px) {
            .date-desktop {
                display: none;
            }

            .date-mobile {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                white-space: nowrap;
                font-size: 12px;
            }
        }

        @media (max-width: 991px) {

            /* ===== SIDEBAR ===== */
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 1000;
                width: 260px;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            /* ===== MAIN ===== */
            .main-wrapper {
                margin-left: 0 !important;
                width: 100%;
            }

            /* ===== NAVBAR ===== */
            .top-navbar {
                padding: 10px 12px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                flex-wrap: nowrap;
                gap: 8px;
            }

            .top-navbar .d-flex.align-items-center.gap-3 {
                display: flex;
                align-items: center;
                gap: 8px;
                flex-shrink: 0;
            }

            /* HAMBURGER */
            .mobile-toggle {
                display: inline-block !important;
                font-size: 18px;
                flex-shrink: 0; /* 🔥 biar ga hilang */
                cursor: pointer;
            }

            /* SEARCH */
            .search-box {
                width: 100%;
                max-width: 180px;
            }

            /* ICON TOP */
            .icon-top {
                gap: 10px !important;
            }

            .icon-top i {
                font-size: 18px;
            }

            /* ===== HEADER ===== */
            .banner-header {
                padding: 15px 20px;
                height: auto;
            }

            .banner-header h2 {
                font-size: 18px;
            }

            /* ===== CONTENT ===== */
            .content-card {
                margin: -20px 10px 20px;
                padding: 15px;
                border-radius: 10px;
            }

            /* ===== FIX AGAR GA NGECIL ===== */
            body, html {
                width: 100%;
                overflow-x: hidden;
            }

            /* ===== OVERLAY ===== */
            .overlay.show {
                display: block;
            }
        }
    </style>
</head>

<body>

    <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

    <!-- ================= SIDEBAR ================= -->
    <div class="sidebar">

        <div class="sidebar-brand d-flex align-items-center gap-2">

            <!-- Tombol back hanya muncul di mobile -->
            <i class="fa-solid fa-arrow-left d-lg-none me-2"
                onclick="toggleSidebar()"
                style="font-size:20px;color:white;cursor:pointer;"></i>

            <img src="{{ asset('images/icon.png') }}" height="40" alt="Logo PLN">

            <div>
                <div style="font-weight:700; font-size:18px; color:#005697; letter-spacing:12px;">PLN</div>
                <div style="font-weight:400; font-size:13px; color:#FFD500; letter-spacing:3px;">NUSANTARA POWER</div>
            </div>

        </div>
        <div class="sidebar-header">
            <h3>SMART-UMRO</h3>
            <p>Smart Management of Assets and Resource Terintegrasi UMRO</p>
        </div>

        <div class="menu-container">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                DASHBOARD <i class="fa-solid fa-house"></i>
            </a>

            @if(!auth()->user()->hasRole('timinventarisasi'))
                <!-- Master Karyawan -->
                <div class="nav-link-collapse {{ request()->routeIs(['divisi.*','pic.*']) ? '' : 'collapsed' }}"
                    data-bs-toggle="collapse" data-bs-target="#menuKaryawan">
                    <a href="javascript:void(0)">
                        MASTER KARYAWAN
                        <i class="fa-solid fa-chevron-right rotate-icon"></i>
                        <i class="fa-solid fa-people-group"></i>
                    </a>
                </div>
                <div class="collapse {{ request()->routeIs(['divisi.*','pic.*']) ? 'show' : '' }} sub-menu" id="menuKaryawan">
                    <a href="{{ route('divisi.index') }}" class="{{ request()->routeIs('divisi.*') ? 'active-sub' : '' }}">FUNGSI <i class="fa-solid fa-building"></i></a>
                    <a href="{{ route('pic.index') }}" class="{{ request()->routeIs('pic.*') ? 'active-sub' : '' }}">KARYAWAN <i class="fa-solid fa-user-tie ms-2"></i></a>
                </div>

                <!-- Master Lokasi -->
                <div class="nav-link-collapse {{ request()->routeIs(['gedung.*','lantai.*','jenis-ruangan.*','ruangs.*']) ? '' : 'collapsed' }}"
                    data-bs-toggle="collapse" data-bs-target="#menuLokasi">
                    <a href="javascript:void(0)">
                        MASTER LOKASI
                        <i class="fa-solid fa-chevron-right rotate-icon"></i>
                        <i class="fa-solid fa-building-user"></i>
                    </a>
                </div>
                <div class="collapse {{ request()->routeIs(['gedung.*','lantai.*','jenis-ruangan.*','ruangs.*']) ? 'show' : '' }} sub-menu" id="menuLokasi">
                    <a href="{{ route('gedung.index') }}" class="{{ request()->routeIs('gedung.*') ? 'active-sub' : '' }}">GEDUNG <i class="fa-solid fa-city"></i></a>
                    <a href="{{ route('lantai.index') }}" class="{{ request()->routeIs('lantai.*') ? 'active-sub' : '' }}">LANTAI <i class="fa-solid fa-layer-group"></i></a>
                    <a href="{{ route('jenis-ruangan.index') }}" class="{{ request()->routeIs('jenis-ruangan.*') ? 'active-sub' : '' }}">JENIS RUANGAN <i class="fa-solid fa-map-pin"></i></a>
                    <a href="{{ route('ruangs.index') }}" class="{{ request()->routeIs('ruangs.*') ? 'active-sub' : '' }}">RUANG <i class="fa-solid fa-door-open"></i></a>
                </div>

                <!-- Master Barang -->
                <div class="nav-link-collapse {{ request()->routeIs(['kelompok.*','jenis.*','subjenis.*']) ? '' : 'collapsed' }}"
                    data-bs-toggle="collapse" data-bs-target="#menuBarang">
                    <a href="javascript:void(0)">
                        MASTER BARANG
                        <i class="fa-solid fa-chevron-right rotate-icon"></i>
                        <i class="fa-solid fa-cubes"></i>
                    </a>
                </div>
                <div class="collapse {{ request()->routeIs(['kelompok.*','jenis.*','subjenis.*']) ? 'show' : '' }} sub-menu" id="menuBarang">
                    <a href="{{ route('kelompok.index') }}" class="{{ request()->routeIs('kelompok.*') ? 'active-sub' : '' }}">KELOMPOK ITEM <i class="fa-solid fa-box-archive"></i></a>
                    <a href="{{ route('jenis.index') }}" class="{{ request()->routeIs('jenis.*') ? 'active-sub' : '' }}">JENIS ITEM <i class="fa-solid fa-tags"></i></a>
                    <a href="{{ route('subjenis.index') }}" class="{{ request()->routeIs('subjenis.*') ? 'active-sub' : '' }}">SUB JENIS <i class="fa-solid fa-folder-tree"></i></a>
                </div>
            @endif

            <!-- Inventaris -->
            <div class="nav-link-collapse {{ request()->routeIs(['barang.*']) ? '' : 'collapsed' }}"
                data-bs-toggle="collapse" data-bs-target="#menuInventaris">
                <a href="javascript:void(0)">
                    INVENTARIS
                    <i class="fa-solid fa-chevron-right rotate-icon"></i>
                    <i class="fa-solid fa-box"></i>
                </a>
            </div>
            <div class="collapse {{ request()->routeIs(['barang.*']) ? 'show' : '' }} sub-menu" id="menuInventaris">
                <a href="{{ route('barang.index') }}" class="{{ request()->routeIs('barang.*') ? 'active-sub' : '' }}">
                    ITEM INVENTARISASI <i class="fa-solid fa-database"></i>
                </a>
                <a href="{{ route('barang-sewa.index') }}">ITEM SEWA<i class="fa-solid fa-list-check"></i></a>
            </div>

            <!-- Management Akun (Only for Superadmin) -->
            @if(Auth::user()->hasRole('superadmin'))
            <div class="nav-link-collapse {{ request()->routeIs(['users.*']) ? '' : 'collapsed' }}"
                data-bs-toggle="collapse" data-bs-target="#menuManagementAkun">
                <a href="javascript:void(0)">
                    MANAGEMENT AKUN
                    <i class="fa-solid fa-chevron-right rotate-icon"></i>
                    <i class="fa-solid fa-user-lock"></i>
                </a>
            </div>
            <div class="collapse {{ request()->routeIs(['users.*']) ? 'show' : '' }} sub-menu" id="menuManagementAkun">
                <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active-sub' : '' }}">AKUN <i class="fa-solid fa-user"></i></a>
            </div>
            @endif
        </div>

        <div class="logout-container">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout-pln">
                    LOGOUT <i class="fa-solid fa-right-from-bracket"></i>
                </button>
            </form>
        </div>

    </div>

    <!-- ================= MAIN ================= -->
    <div class="main-wrapper">

        <div class="top-navbar">

            <div class="d-flex align-items-center gap-3">

                <i class="fa-solid fa-bars mobile-toggle" onclick="toggleSidebar()"></i>

                <div class="d-flex align-items-center">

                    <i class="fa-solid fa-magnifying-glass me-2 text-muted"></i>

                    <div style="position:relative;">

                        <input type="text"
                            id="liveSearch"
                            class="search-box"
                            placeholder="Search ...">

                        <div id="searchResults"
                            style="
                                position:absolute;
                                top:35px;
                                left:0;
                                width:300px;
                                background:white;
                                border-radius:6px;
                                box-shadow:0 5px 15px rgba(0,0,0,0.15);
                                display:none;
                                max-height:300px;
                                overflow:auto;
                                z-index:999;">
                        </div>

                    </div>
                </div>

            </div>

            <div class="d-flex align-items-center gap-4 text-muted icon-top">

                <!-- TANGGAL -->
                <div class="date-desktop small text-muted">
                    <i class="fa-regular fa-calendar me-1"></i>
                    {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                </div>

                <div class="date-mobile small text-muted">
                    <i class="fa-regular fa-calendar me-1"></i>
                    {{\Carbon\Carbon::now()->format('d/m/y')}}
                </div>

                <!-- NOTIFIKASI -->
                <i class="fa-regular fa-bell"
                    data-bs-toggle="modal"
                    data-bs-target="#notifModal"></i>

                <!-- USER -->
                <i class="fa-regular fa-user"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#userPanel"></i>

                <!-- INFO -->
                <i class="fa-solid fa-circle-info"
                    data-bs-toggle="modal"
                    data-bs-target="#infoModal"></i>

            </div>
        </div>

        <div class="banner-header">

            <h2 class="fw-bold">@yield('title')</h2>

        </div>

        <div class="content-card">

            @yield('content')

            <hr>

            <footer class="d-flex justify-content-between align-items-center mt-3">

                <div class="text-muted small">
                    © 2026 PLN Nusantara Power — Sistem Inventarisasi Unit Maintenance Repair And Overhoul
                </div>

                <div class="small text-muted">
                    <i class="fa-solid fa-code me-1"></i>
                    Developed by SMART UMRO
                </div>

            </footer>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {

            if (window.innerWidth <= 991) {

                document.querySelector('.sidebar').classList.toggle('show');
                document.getElementById('overlay').classList.toggle('show');

            }

        }
        window.addEventListener('resize', function() {

            if (window.innerWidth > 991) {

                document.querySelector('.sidebar').classList.remove('show');
                document.getElementById('overlay').classList.remove('show');

            }

        });
    </script>
    <!-- ================= MODAL INFORMASI ================= -->
    <div class="modal fade" id="infoModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-header" style="background:#309FB0; color:white;">
                    <h5 class="modal-title">
                        <i class="fa-solid fa-circle-info me-2"></i>
                        Informasi Sistem
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <!-- HEADER -->
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/icon.png') }}" height="70" alt="Logo">
                        <h4 class="mt-3 fw-bold">SMART - UMRO</h4>
                        <p class="text-muted mb-0">Sistem Manajemen Aset Terintegrasi</p>
                        <small class="text-muted">Versi 1.0.0</small>
                    </div>

                    <hr class="opacity-10">

                    <!-- DESKRIPSI SISTEM -->
                    <h6 class="fw-bold text-primary">Tentang Sistem</h6>
                    <p style="text-align: justify;">
                        SMART-UMRO (Sistem Manajemen Aset Terintegrasi) adalah aplikasi digital yang digunakan untuk mengelola data inventaris secara terpusat, mulai dari pencatatan barang, lokasi, PIC (penanggung jawab), hingga kondisi aset. Sistem ini dilengkapi fitur QR Code untuk mempermudah identifikasi dan pengecekan barang secara cepat dan akurat, sehingga meningkatkan efisiensi, transparansi, dan kontrol dalam pengelolaan aset.
                    </p>

                    <hr class="opacity-10">

                    <!-- FITUR UTAMA -->
                <div class="mb-4">
                    <h6 class="fw-bold text-primary mb-3">
                        <i class="fa-solid fa-star me-2"></i>Fitur Utama Sistem
                    </h6>
                    <div class="row g-3 text-center">
                        <div class="col-md-4 col-6">
                            <div class="p-3 border rounded shadow-sm h-100 bg-white">
                                <i class="fa-solid fa-sitemap fa-2x text-info mb-2"></i>
                                <h6 class="fw-bold mb-1 small">Manajemen Fungsi</h6>
                                <small class="text-muted d-block" style="font-size: 11px;">Data divisi</small>
                            </div>
                        </div>
                        <div class="col-md-4 col-6">
                            <div class="p-3 border rounded shadow-sm h-100 bg-white">
                                <i class="fa-solid fa-user-tie fa-2x text-success mb-2"></i>
                                <h6 class="fw-bold mb-1 small">Manajemen PIC</h6>
                                <small class="text-muted d-block" style="font-size: 11px;">Penanggung jawab</small>
                            </div>
                        </div>
                        <div class="col-md-4 col-6">
                            <div class="p-3 border rounded shadow-sm h-100 bg-white">
                                <i class="fa-solid fa-building fa-2x text-warning mb-2"></i>
                                <h6 class="fw-bold mb-1 small">Manajemen Lokasi</h6>
                                <small class="text-muted d-block" style="font-size: 11px;">Gedung & ruangan</small>
                            </div>
                        </div>
                        <div class="col-md-4 col-6">
                            <div class="p-3 border rounded shadow-sm h-100 bg-white">
                                <i class="fa-solid fa-box fa-2x text-danger mb-2"></i>
                                <h6 class="fw-bold mb-1 small">Inventaris Barang</h6>
                                <small class="text-muted d-block" style="font-size: 11px;">Data aset</small>
                            </div>
                        </div>
                        <div class="col-md-4 col-6">
                            <div class="p-3 border rounded shadow-sm h-100 bg-white">
                                <i class="fa-solid fa-qrcode fa-2x text-dark mb-2"></i>
                                <h6 class="fw-bold mb-1 small">QR Code</h6>
                                <small class="text-muted d-block" style="font-size: 11px;">Scan identifikasi</small>
                            </div>
                        </div>
                        <div class="col-md-4 col-6">
                            <div class="p-3 border rounded shadow-sm h-100 bg-white">
                                <i class="fa-solid fa-file-export fa-2x text-primary mb-2"></i>
                                <h6 class="fw-bold mb-1 small">Laporan & Export</h6>
                                <small class="text-muted d-block" style="font-size: 11px;">Excel & PDF</small>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="opacity-10">

                    <!-- PANDUAN SINGKAT -->
                    <h6 class="fw-bold text-primary">Panduan Singkat Penggunaan</h6>
                    <ol style="font-size: 14px;">
                        <li>Gunakan menu di sidebar untuk memilih modul yang diinginkan.</li>
                        <li>Tambahkan data melalui tombol <strong>Tambah</strong> pada setiap halaman.</li>
                        <li>Gunakan fitur edit untuk memperbarui data yang sudah ada.</li>
                        <li>Pastikan data lokasi dan karyawan telah dibuat sebelum menambahkan inventaris.</li>
                        <li>Gunakan fitur pencarian pada bagian atas untuk menemukan data dengan cepat.</li>
                    </ol>

                    <hr>

                    <!-- PENGEMBANG -->
                    <h6 class="fw-bold text-primary">Pengembang Sistem</h6>
                    <p class="mb-1"><strong>Nama :</strong> Hwanzelnuts n Team</p>
                    <p class="mb-1"><strong>Unit :</strong> UNIT UMRO</p>
                    <p class="mb-0"><strong>Tahun Pengembangan :</strong> 2026</p>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>

            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {

            document.querySelector('.sidebar').classList.toggle('show');
            document.getElementById('overlay').classList.toggle('show');

        }

        /* ================= LIVE SEARCH ================= */

        const searchInput = document.getElementById('liveSearch');
        const resultsBox = document.getElementById('searchResults');

        searchInput.addEventListener('keyup', function() {

            let keyword = this.value.trim();

            if (keyword.length < 2) {
                resultsBox.style.display = 'none';
                resultsBox.innerHTML = '';
                return;
            }

            fetch(`/search?q=${keyword}`)
                .then(res => res.json())
                .then(data => {

                    let html = '';

                    /* BARANG */

                    if (data.barang && data.barang.length > 0) {

                        html += `<div class="search-category">Barang</div>`;

                        data.barang.forEach(item => {
                            html += `
                            <a href="/barang/${item.id}" class="search-item">
                            <i class="fa-solid fa-box text-primary"></i>
                            <div>
                            <div class="search-title">${item.nama_barang}</div>
                            <small class="text-muted">${item.kode_barang}</small>
                            </div>
                            </a>
                            `;
                        });

                    }

                    /* RUANG */

                    if (data.ruang && data.ruang.length > 0) {

                        html += `<div class="search-category">Ruang</div>`;

                        data.ruang.forEach(item => {
                            html += `
                            <a href="/ruangs/${item.id}" class="search-item">
                            <i class="fa-solid fa-door-open text-success"></i>
                            <div>
                            <div class="search-title">${item.nama_ruang}</div>
                            </div>
                            </a>
                            `;
                        });

                    }

                    /* KARYAWAN */

                    if (data.karyawan && data.karyawan.length > 0) {

                        html += `<div class="search-category">Karyawan</div>`;

                        data.karyawan.forEach(item => {
                            html += `
                            <a href="/pic/${item.id}" class="search-item">
                            <i class="fa-solid fa-user text-warning"></i>
                            <div>
                            <div class="search-title">${item.nama_pic}</div>
                            </div>
                            </a>
                            `;
                        });

                    }

                    /* GEDUNG */

                    if (data.gedung && data.gedung.length > 0) {

                        html += `<div class="search-category">Gedung</div>`;

                        data.gedung.forEach(item => {
                            html += `
                            <a href="/gedung/${item.id}" class="search-item">
                            <i class="fa-solid fa-building text-danger"></i>
                            <div>
                            <div class="search-title">${item.nama_gedung}</div>
                            </div>
                            </a>
                            `;
                        });

                    }

                    /* JIKA TIDAK ADA DATA */

                    if (html === '') {
                        html = `
                    <div style="padding:12px;text-align:center;color:#888">
                    Tidak ada hasil ditemukan
                    </div>
                    `;
                    }

                    resultsBox.innerHTML = html;
                    resultsBox.style.display = 'block';

                });

        });


        /* ================= CLOSE RESULT ================= */

        document.addEventListener('click', function(e) {

            if (!searchInput.contains(e.target) && !resultsBox.contains(e.target)) {
                resultsBox.style.display = 'none';
            }

        });

        function showEditProfile() {
            document.getElementById("profileView").style.display = "none";
            document.getElementById("profileEdit").style.display = "block";
        }

        function cancelEditProfile() {
            document.getElementById("profileView").style.display = "block";
            document.getElementById("profileEdit").style.display = "none";
        }
    </script>

    <!-- ================= MODAL INFORMASI SISTEM ================= -->
    <div class="modal fade" id="infoModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">

                <!-- HEADER -->
                <div class="modal-header text-white"
                    style="background: linear-gradient(135deg,#309FB0,#1F7A88);">

                    <h5 class="modal-title fw-bold">
                        <i class="fa-solid fa-circle-info me-2"></i>
                        Informasi Sistem
                    </h5>

                    <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <!-- LOGO + TITLE -->
                    <div class="text-center mb-4">

                        <img src="{{ asset('images/pln.jpeg') }}"
                            height="70"
                            class="mb-2">

                        <h3 class="fw-bold mb-1">i - Noni</h3>

                        <p class="text-muted mb-0">
                            Sistem Inventarisasi UNIT MAINTENANCE REPAIR AND OVERHAUL
                        </p>

                        <span class="badge bg-secondary mt-2">
                            Versi 1.0.0
                        </span>

                    </div>

                    <hr>

                    <!-- TENTANG SISTEM -->
                    <div class="mb-4">

                        <h6 class="fw-bold text-primary mb-2">
                            <i class="fa-solid fa-circle-info me-2"></i>
                            Tentang Sistem
                        </h6>

                        <p style="text-align: justify;">
                            i-Noni merupakan sistem inventarisasi yang dirancang untuk membantu
                            pengelolaan data aset dan barang secara terstruktur, terintegrasi,
                            dan mudah diakses. Sistem ini mendukung pengelolaan data karyawan,
                            lokasi (gedung, lantai, ruangan), serta data inventaris sehingga
                            proses monitoring aset menjadi lebih efektif, akurat, dan transparan.
                        </p>

                    </div>

                    <hr>

                    <!-- FITUR UTAMA -->
                    <div class="mb-4">

                        <h6 class="fw-bold text-primary mb-3">
                            <i class="fa-solid fa-star me-2"></i>
                            Fitur Utama Sistem
                        </h6>

                        <div class="row text-center">

                            <div class="col-md-4 mb-3">

                                <i class="fa-solid fa-users fa-2x text-info mb-2"></i>

                                <h6 class="fw-bold mb-1">Manajemen Karyawan</h6>

                                <small class="text-muted">
                                    Mengelola data fungsi dan karyawan
                                </small>

                            </div>

                            <div class="col-md-4 mb-3">

                                <i class="fa-solid fa-building fa-2x text-success mb-2"></i>

                                <h6 class="fw-bold mb-1">Manajemen Lokasi</h6>

                                <small class="text-muted">
                                    Mengelola gedung, lantai, dan ruangan
                                </small>

                            </div>

                            <div class="col-md-4 mb-3">

                                <i class="fa-solid fa-box fa-2x text-warning mb-2"></i>

                                <h6 class="fw-bold mb-1">Inventaris Barang</h6>

                                <small class="text-muted">
                                    Pengelolaan data barang dan aset
                                </small>

                            </div>

                        </div>

                    </div>

                    <hr>

                    <!-- PANDUAN -->
                    <div>

                        <h6 class="fw-bold text-primary mb-2">
                            <i class="fa-solid fa-book me-2"></i>
                            Panduan Singkat
                        </h6>

                        <ol style="font-size:14px; padding-left:18px;">

                            <li>Gunakan menu sidebar untuk memilih modul sistem.</li>
                            <li>Tambahkan data melalui tombol <b>Tambah</b>.</li>
                            <li>Gunakan fitur <b>Edit</b> untuk memperbarui data.</li>
                            <li>Pastikan data lokasi dan karyawan tersedia sebelum menambahkan inventaris.</li>
                            <li>Gunakan fitur <b>Search</b> untuk menemukan data dengan cepat.</li>

                        </ol>

                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer d-flex justify-content-between align-items-center bg-light">

                    <div class="text-muted small">

                        <i class="fa-solid fa-code me-1"></i>
                        Developed by <b>SMART UMRO</b> • UNIT MAINTENANCE REPAIR AND OVERHAUL • 2026

                    </div>

                    <button class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Tutup
                    </button>

                </div>

            </div>
        </div>
    </div>
    <!-- ================= MODAL NOTIFIKASI ================= -->
    <div class="modal fade" id="notifModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header" style="background:#309FB0; color:white;">
                    <h5 class="modal-title">
                        <i class="fa-solid fa-bell me-2"></i>
                        Notifikasi
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="text-center text-muted">
                        <i class="fa-regular fa-bell fa-3x mb-3"></i>
                        <p>Belum ada notifikasi terbaru.</p>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>

            </div>
        </div>
    </div>
    <!-- ================= PANEL USER ================= -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="userPanel">

        <div class="offcanvas-header" style="background: linear-gradient(135deg, #309FB0 0%, #1b6b7a 100%); color:white; padding: 20px;">
            <div>
                <h5 class="offcanvas-title mb-1">
                    <i class="fa-solid fa-user me-2"></i>
                    Profil Pengguna
                </h5>
                <small style="opacity: 0.9;">Kelola informasi akun Anda</small>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>

        <div class="offcanvas-body p-4">

            <!-- PROFIL VIEW -->
            <div id="profileView">

                <!-- Avatar Card -->
                <div style="background: linear-gradient(135deg, #309FB0 0%, #42b5d8 100%); border-radius: 20px; padding: 30px 20px; margin-bottom: 25px; box-shadow: 0 8px 25px rgba(48, 159, 176, 0.2);">
                    <div style="width: 100px; height: 100px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; backdrop-filter: blur(10px); border: 3px solid rgba(255,255,255,0.3);">
                        <i class="fa-solid fa-user fa-3x text-white"></i>
                    </div>
                    <h5 class="fw-bold text-white mb-1">{{ Auth::user()->name }}</h5>
                    <!-- <small class="text-white" style="opacity: 0.9;">
                        <i class="fa-regular fa-envelope me-2"></i>{{ Auth::user()->email }}
                    </small> -->
                </div>

                <!-- Info Cards -->
                <div class="row g-3 mb-4">
                    <!-- Role Card -->
                    <div class="col-6">
                        <div style="background: linear-gradient(135deg, #E3F2FD 0%, #F3E5F5 100%); border-radius: 12px; padding: 15px; border: 1px solid #e0e0e0;">
                            <div style="color: #309FB0; font-size: 14px; font-weight: 600; margin-bottom: 8px;">
                                <i class="fa-solid fa-shield-halved me-1"></i> Role
                            </div>
                            <div style="font-size: 18px; font-weight: 700; color: #1b3a4a;">
                                {{ Auth::user()->role ?? 'Admin' }}
                            </div>
                        </div>
                    </div>

                    <!-- Status Card -->
                    <div class="col-6">
                        <div style="background: linear-gradient(135deg, #E8F5E9 0%, #FFF3E0 100%); border-radius: 12px; padding: 15px; border: 1px solid #e0e0e0;">
                            <div style="color: #4CAF50; font-size: 14px; font-weight: 600; margin-bottom: 8px;">
                                <i class="fa-solid fa-circle-check me-1"></i> Status
                            </div>
                            <div style="font-size: 18px; font-weight: 700; color: #2e7d32;">
                                Aktif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Join Date Card -->
                <div style="background: #f8f9fa; border-radius: 12px; padding: 15px; margin-bottom: 25px; border-left: 4px solid #309FB0;">
                    <small style="color: #6c757d; font-weight: 600;">AKTIF SEJAK</small>
                    <div style="font-size: 16px; font-weight: 700; color: #1b3a4a; margin-top: 5px;">
                        <i class="fa-regular fa-calendar me-2" style="color: #309FB0;"></i>
                        {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-grid gap-2">

                    <button class="btn" style="background: linear-gradient(135deg, #309FB0 0%, #42b5d8 100%); color: white; border: none; padding: 12px; font-weight: 600; border-radius: 10px; transition: all 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(48, 159, 176, 0.3)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'"
                        onclick="showEditProfile()">
                        <i class="fa-solid fa-user-pen me-2"></i>
                        Edit Profil
                    </button>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn w-100" style="background: linear-gradient(135deg, #f44336 0%, #e91e63 100%); color: white; border: none; padding: 12px; font-weight: 600; border-radius: 10px; transition: all 0.3s ease;"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(244, 67, 54, 0.3)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                            <i class="fa-solid fa-right-from-bracket me-2"></i>
                            Logout
                        </button>
                    </form>

                </div>

            </div>


            <!-- FORM EDIT PROFILE -->
            <div id="profileEdit" style="display:none;">

                <div style="background: linear-gradient(135deg, #E3F2FD 0%, #F3E5F5 100%); border-radius: 15px; padding: 20px; margin-bottom: 25px; border-left: 4px solid #309FB0;">
                    <h6 style="font-weight: 700; color: #1b3a4a; margin-bottom: 5px;">
                        <i class="fa-solid fa-user-pen me-2"></i> Edit Informasi Profil
                    </h6>
                    <small style="color: #6c757d;">Perbarui data pribadi Anda di bawah ini</small>
                </div>

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-600" style="color: #1b3a4a; font-weight: 600;">Nama Lengkap</label>
                        <input type="text"
                            name="name"
                            class="form-control"
                            style="border: 2px solid #e0e0e0; border-radius: 8px; padding: 10px 15px; transition: all 0.3s ease;"
                            onmouseover="this.style.borderColor='#309FB0'; this.style.boxShadow='0 0 0 3px rgba(48, 159, 176, 0.1)'"
                            onmouseout="this.style.borderColor='#e0e0e0'; this.style.boxShadow='none'"
                            onfocus="this.style.borderColor='#309FB0'; this.style.boxShadow='0 0 0 3px rgba(48, 159, 176, 0.1)'"
                            onblur="this.style.borderColor='#e0e0e0'; this.style.boxShadow='none'"
                            value="{{ Auth::user()->name }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-600" style="color: #1b3a4a; font-weight: 600;">Email</label>
                        <input type="email"
                            name="email"
                            class="form-control"
                            style="border: 2px solid #e0e0e0; border-radius: 8px; padding: 10px 15px; transition: all 0.3s ease;"
                            onmouseover="this.style.borderColor='#309FB0'; this.style.boxShadow='0 0 0 3px rgba(48, 159, 176, 0.1)'"
                            onmouseout="this.style.borderColor='#e0e0e0'; this.style.boxShadow='none'"
                            onfocus="this.style.borderColor='#309FB0'; this.style.boxShadow='0 0 0 3px rgba(48, 159, 176, 0.1)'"
                            onblur="this.style.borderColor='#e0e0e0'; this.style.boxShadow='none'"
                            value="{{ Auth::user()->email }}"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-600" style="color: #1b3a4a; font-weight: 600;">Password Baru</label>
                        <input type="password"
                            name="password"
                            class="form-control"
                            style="border: 2px solid #e0e0e0; border-radius: 8px; padding: 10px 15px; transition: all 0.3s ease;"
                            onmouseover="this.style.borderColor='#309FB0'; this.style.boxShadow='0 0 0 3px rgba(48, 159, 176, 0.1)'"
                            onmouseout="this.style.borderColor='#e0e0e0'; this.style.boxShadow='none'"
                            onfocus="this.style.borderColor='#309FB0'; this.style.boxShadow='0 0 0 3px rgba(48, 159, 176, 0.1)'"
                            onblur="this.style.borderColor='#e0e0e0'; this.style.boxShadow='none'"
                            placeholder="Kosongkan jika tidak diubah">
                        <small style="color: #6c757d; display: block; margin-top: 5px;">
                            <i class="fa-solid fa-circle-info me-1"></i> Biarkan kosong jika tidak ingin mengubah password
                        </small>
                    </div>

                    <div class="d-flex gap-2">

                        <button type="button"
                            class="btn w-50"
                            style="background: #f0f0f0; color: #1b3a4a; border: 2px solid #e0e0e0; padding: 10px; font-weight: 600; border-radius: 8px; transition: all 0.3s ease; cursor: pointer;"
                            onmouseover="this.style.background='#e0e0e0'; this.style.transform='translateY(-2px)'"
                            onmouseout="this.style.background='#f0f0f0'; this.style.transform='translateY(0)'"
                            onclick="cancelEditProfile()">
                            <i class="fa-solid fa-times me-1"></i> Batal
                        </button>

                        <button type="submit"
                            class="btn w-50"
                            style="background: linear-gradient(135deg, #309FB0 0%, #42b5d8 100%); color: white; border: none; padding: 10px; font-weight: 600; border-radius: 8px; transition: all 0.3s ease; cursor: pointer;"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(48, 159, 176, 0.3)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                            <i class="fa-solid fa-check me-1"></i> Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>

        </div>

        <div class="text-center small text-muted pb-3" style="border-top: 1px solid #f0f0f0; padding-top: 20px; margin-top: 25px;">
            <i class="fa-solid fa-shield-alt me-1"></i>
            Sistem Inventaris UMRO
        </div>
    </div>
@yield('scripts')
</body>

</html>