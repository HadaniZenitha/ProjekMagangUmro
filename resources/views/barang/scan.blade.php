@extends('layouts.dashboard')

@section('title', 'Scan QR')

@section('content')

<style>

/* WRAPPER */
.scan-wrapper {
    max-width: 500px;
    margin: auto;
}

/* CARD */
.scan-card {
    border-radius: 16px;
    padding: 20px;
    background: #ffffff;
    border: 1px solid var(--menu-bg);
    box-shadow: 0 6px 18px rgba(0,0,0,0.05);
    position: relative;
}

/* ACCENT LINE */
.scan-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    height: 5px;
    width: 100%;
    background: linear-gradient(90deg, var(--bg-sidebar), var(--pln-yellow));
}

/* TITLE */
.scan-title {
    color: var(--text-dark);
    font-weight: 600;
}

/* ICON */
.scan-icon {
    font-size: 32px;
    color: var(--bg-sidebar);
}

/* SCANNER */
#reader {
    width: 100%;
    border-radius: 12px;
    overflow: hidden;
    border: 2px dashed var(--menu-bg);
    background: #f9fcfc;
    padding: 6px;
}

/* RESULT */
.result-box {
    margin-top: 15px;
    padding: 12px;
    border-radius: 10px;
    background: var(--menu-active);
    border: 1px solid var(--menu-bg);
    font-size: 14px;
}

#result {
    color: var(--text-dark);
}

/* BUTTON */
.btn-back {
    border-radius: 10px;
    font-weight: 500;
    background: var(--bg-sidebar);
    color: white;
    border: none;
}

.btn-back:hover {
    background: #257e8c;
    color: white;
}

/* MOBILE */
@media (max-width: 576px) {
    .scan-card {
        padding: 15px;
    }
}

</style>

<div class="container py-4">
    <div class="scan-wrapper">

        <div class="scan-card text-center">

            {{-- ICON --}}
            <div class="mb-2">
                <i class="fa-solid fa-qrcode scan-icon"></i>
            </div>

            {{-- TITLE --}}
            <h5 class="scan-title mb-2">Scan QR Barang</h5>

            <p class="text-muted small mb-3">
                Arahkan kamera ke QR Code untuk melihat detail barang
            </p>

            {{-- SCANNER --}}
            <div id="reader"></div>

            {{-- RESULT --}}
            <div class="result-box mt-3">
                Hasil Scan:
                <div class="fw-bold mt-1" id="result">Belum ada hasil</div>
            </div>

            {{-- BUTTON --}}
            <div class="mt-3">
                <a href="{{ route('barang.index') }}" class="btn w-100 btn-back">
                    <i class="fa-solid fa-arrow-left me-1"></i> Kembali
                </a>
            </div>

        </div>

    </div>
</div>

<script src="https://unpkg.com/html5-qrcode"></script>

<script>
function onScanSuccess(decodedText) {

    document.getElementById('result').innerText = decodedText;

    setTimeout(() => {
        window.location.href = decodedText;
    }, 800);
}

let scanner = new Html5QrcodeScanner("reader", {
    fps: 10,
    qrbox: { width: 250, height: 250 }
});

scanner.render(onScanSuccess);
</script>

@endsection