@extends('layouts.dashboard')

@section('title', 'Scan QR')

@section('content')
<div class="container text-center">
    <h5 class="mb-3">Scan QR Item</h5>

    <div id="reader" style="width: 100%; max-width: 400px; margin:auto;"></div>

    <p class="mt-3">Hasil: <strong id="result">-</strong></p>
</div>

<script src="https://unpkg.com/html5-qrcode"></script>

<script>
function onScanSuccess(decodedText) {
    console.log(decodedText); // debug
    window.location.href = decodedText;
}
let scanner = new Html5QrcodeScanner("reader", {
    fps: 10,
    qrbox: 250
});

scanner.render(onScanSuccess);
</script>
@endsection