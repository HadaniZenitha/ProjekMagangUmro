@extends('layouts.dashboard')

@section('title', 'Scan QR')

@section('content')
<div class="container text-center">
    <h5 class="mb-3">Scan QR Item</h5>

<style>

/* BACKGROUND */
body {
    background: linear-gradient(135deg, #f8f9fa, #eef2ff);
}

/* WRAPPER */
.scan-wrapper {
    max-width: 500px;
    margin: auto;
}

/* CARD */
.scan-card {
    border: none;
    border-radius: 18px;
    padding: 20px;
    background: #ffffff;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    position: relative;
    overflow: hidden;
}

/* ACCENT TOP BAR */
.scan-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    height: 5px;
    width: 100%;
    background: linear-gradient(90deg, #ffc107, #ff9800);
}

/* TITLE */
.scan-title {
    font-weight: 700;
    color: #333;
}

/* ICON */
.scan-icon {
    font-size: 36px;
    color: #ffc107;
}

/* SCANNER BOX */
#reader {
    width: 100%;
    border-radius: 12px;
    overflow: hidden;
    border: 2px dashed #ffc107;
    background: #fffdf5;
    padding: 5px;
}

/* RESULT BOX */
.result-box {
    margin-top: 15px;
    padding: 12px;
    border-radius: 10px;
    background: #fff3cd;
    border: 1px solid #ffe69c;
    font-size: 14px;
}

/* RESULT TEXT */
#result {
    color: #856404;
}

/* BUTTON */
.btn-back {
    border-radius: 10px;
    font-weight: 500;
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
                <a href="{{ route('barang.index') }}" class="btn btn-outline-dark w-100 btn-back">
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