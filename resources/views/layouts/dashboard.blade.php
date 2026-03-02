<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>i-Row | Sistem Inventarisasi UNIT UMRO</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
:root {
    --bg-sidebar: #309FB0;
    --pln-yellow: #FACC15;
    --menu-bg: #B2D8DB;
    --menu-active: #D1E9EB;
    --text-dark: #1F3A56;
}

body {
    min-height: 100vh;
    background-color: #E0E7E9;
    font-family: 'Segoe UI', sans-serif;
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
}

/* BRANDING PLN */
.sidebar-brand {
    padding: 15px 20px;
    display: flex;
    align-items: center;
    gap: 10px;
    flex-shrink: 0;
}

.sidebar-header {
    padding: 15px 20px;
    color: white;
    border-bottom: 1px solid rgba(255,255,255,0.2);
    flex-shrink: 0;
}

.menu-container {
    flex: 1;
    overflow-y: auto;
    padding: 10px 0;
}

/* custom scrollbar */
.menu-container::-webkit-scrollbar {
    width: 6px;
}
.menu-container::-webkit-scrollbar-thumb {
    background: rgba(0,0,0,0.3);
    border-radius: 10px;
}

.sidebar a {
    color: var(--text-dark);
    text-decoration: none;
    padding: 12px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: var(--menu-bg);
    margin-bottom: 5px;
    font-weight: bold;
    font-size: 0.85rem;
    text-transform: uppercase;
    transition: 0.2s;
    border-left: 5px solid transparent;
}

.sidebar a:hover {
    background: var(--menu-active);
    padding-left: 25px;
}

.sidebar a.active,
.nav-link-collapse:not(.collapsed) a {
    background: var(--menu-active) !important;
    border-left: 5px solid var(--pln-yellow);
}

.sub-menu {
    background: rgba(255,255,255,0.2);
}

.sub-menu a {
    padding-left: 45px !important;
    font-size: 0.8rem !important;
    background: transparent !important;
}

.sub-menu a.active-sub {
    background: var(--pln-yellow) !important;
}

.rotate-icon {
    transition: transform 0.3s;
    font-size: 0.7rem !important;
    margin-left: auto;
    margin-right: 15px;
}

.nav-link-collapse:not(.collapsed) .rotate-icon {
    transform: rotate(90deg);
}

.logout-container {
    padding: 20px;
    background: rgba(0,0,0,0.1);
    flex-shrink: 0;
}

.btn-logout-pln {
    background: var(--pln-yellow);
    border: none;
    width: 100%;
    padding: 10px;
    font-weight: bold;
    border-radius: 5px;
    box-shadow: 0 4px 0 #b39400;
}

.btn-logout-pln:hover {
    background: #f0c000;
    transform: translateY(-2px);
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
    background: linear-gradient(rgba(255,255,255,0.7), rgba(255,255,255,0.7)),
    url('https://www.toptal.com/designers/subtlepatterns/patterns/factory.png');
    height: 120px;
    padding: 20px 40px;
}

.content-card {
    background: white;
    margin: -40px 30px 30px;
    border-radius: 8px;
    padding: 25px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* ================= RESPONSIVE ================= */

.mobile-toggle { display: none; cursor: pointer; font-size: 20px; }
.overlay { display: none; }

@media (max-width: 991px) {

    .sidebar { transform: translateX(-100%); }
    .sidebar.show { transform: translateX(0); }

    .main-wrapper { margin-left: 0; }

    .mobile-toggle { display: inline-block; }

    .overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.4);
        z-index: 900;
        display: none;
    }

    .overlay.show { display: block; }

    .search-box { width: 180px; }
}

</style>
</head>

<body>

<div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

<!-- ================= SIDEBAR ================= -->
<div class="sidebar">

    <div class="sidebar-brand">
        <img src="{{ asset('images/pln.jpeg') }}" height="40">
        <div>
            <div style="font-weight:700; font-size:18px; color:#005697; letter-spacing:12px;">PLN</div>
            <div style="font-size:13px; color:#FFD500; letter-spacing:3px;">NUSANTARA POWER</div>
        </div>
    </div>

    <div class="sidebar-header">
        <h4 class="fw-bold">i - Noni</h4>
        <small>Sistem Inventarisasi</small>
    </div>

    <div class="menu-container">
         <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            DASHBOARD <i class="fa-solid fa-house"></i>
        </a>

        <div class="nav-link-collapse {{ request()->routeIs(['divisi.*', 'pic.*']) ? '' : 'collapsed' }}" 
            data-bs-toggle="collapse" data-bs-target="#menuKaryawan">
            <a href="javascript:void(0)">
                MASTER KARYAWAN 
                <i class="fa-solid fa-chevron-right rotate-icon"></i>
                <i class="fa-solid fa-people-group"></i>
            </a>
        </div>
        <div class="collapse {{ request()->routeIs(['divisi.*', 'pic.*']) ? 'show' : '' }} sub-menu" id="menuKaryawan">
            <a href="{{ route('divisi.index') }}" class="{{ request()->routeIs('divisi.*') ? 'active-sub' : '' }}">BIDANG</a>
            <a href="{{ route('pic.index') }}" class="{{ request()->routeIs('pic.*') ? 'active-sub' : '' }}">KARYAWAN</a>
        </div>

        <div class="nav-link-collapse {{ request()->routeIs(['gedung.*', 'lantai.*', 'jenis-ruangan.*', 'ruangs.*']) ? '' : 'collapsed' }}" 
            data-bs-toggle="collapse" data-bs-target="#menuLokasi">
            <a href="javascript:void(0)">
                MASTER LOKASI 
                <i class="fa-solid fa-chevron-right rotate-icon"></i>
                <i class="fa-solid fa-building-user"></i>
            </a>
        </div>
        <div class="collapse {{ request()->routeIs(['gedung.*', 'lantai.*', 'jenis-ruangan.*', 'ruangs.*']) ? 'show' : '' }} sub-menu" id="menuLokasi">
            <a href="{{ route('gedung.index') }}" class="{{ request()->routeIs('gedung.*') ? 'active-sub' : '' }}">GEDUNG</a>
            <a href="{{ route('lantai.index') }}" class="{{ request()->routeIs('lantai.*') ? 'active-sub' : '' }}">LANTAI</a>
            <a href="{{ route('jenis-ruangan.index') }}" class="{{ request()->routeIs('jenis-ruangan.*') ? 'active-sub' : '' }}">JENIS RUANGAN</a>
            <a href="{{ route('ruangs.index') }}" class="{{ request()->routeIs('ruangs.*') ? 'active-sub' : '' }}">RUANG</a>
        </div>

        <div class="nav-link-collapse {{ request()->routeIs(['kelompok.*', 'jenis.*', 'subjenis.*']) ? '' : 'collapsed' }}" 
            data-bs-toggle="collapse" data-bs-target="#menuBarang">
            <a href="javascript:void(0)">
                MASTER BARANG 
                <i class="fa-solid fa-chevron-right rotate-icon"></i>
                <i class="fa-solid fa-cubes"></i>
            </a>
        </div>
        <div class="collapse {{ request()->routeIs(['kelompok.*', 'jenis.*', 'subjenis.*']) ? 'show' : '' }} sub-menu" id="menuBarang">
            <a href="{{ route('kelompok.index') }}" class="{{ request()->routeIs('kelompok.*') ? 'active-sub' : '' }}">KELOMPOK BARANG</a>
            <a href="{{ route('jenis.index') }}" class="{{ request()->routeIs('jenis.*') ? 'active-sub' : '' }}">JENIS BARANG</a>
            <a href="{{ route('subjenis.index') }}" class="{{ request()->routeIs('subjenis.*') ? 'active-sub' : '' }}">SUB JENIS</a>
        </div>

        <div class="nav-link-collapse {{ request()->routeIs(['barang.*']) ? '' : 'collapsed' }}" 
            data-bs-toggle="collapse" data-bs-target="#menuInventaris">
            <a href="javascript:void(0)">
                INVENTARIS 
                <i class="fa-solid fa-chevron-right rotate-icon"></i>
                <i class="fa-solid fa-box"></i>
            </a>
        </div>
        <div class="collapse {{ request()->routeIs(['barang.*']) ? 'show' : '' }} sub-menu" id="menuInventaris">
            <a href="{{ route('barang.index') }}" class="{{ request()->routeIs('barang.*') ? 'active-sub' : '' }}">DATA BARANG</a>
            <a href="#">KEBUTUHAN</a>
        </div>
        @yield('sidebar')
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
                <input type="text" class="search-box" placeholder="Search....">
            </div>
        </div>

        <div class="d-flex align-items-center gap-4 text-muted">
            <i class="fa-regular fa-bell fs-5"></i>
            <i class="fa-regular fa-user fs-5"></i>
            <i class="fa-regular fa-circle-question fs-5"></i>
        </div>
    </div>

    <div class="banner-header">
        <h2 class="fw-bold">@yield('title')</h2>
    </div>

    <div class="content-card">
        @yield('content')
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('show');
    document.getElementById('overlay').classList.toggle('show');
}
</script>

</body>
</html>