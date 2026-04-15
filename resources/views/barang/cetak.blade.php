<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Cetak Stiker Inventaris</title>

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>

<style>
@page {
    size: 10cm 6cm;
    margin: 0;
}

body{
    margin:0;
}

@media print{
    body{
        background:white;
    }
}
</style>
</head>

<body class="bg-gray-300 flex items-center justify-center min-h-screen">

<div id="sticker"
class="w-[10cm] h-[6cm] bg-white rounded-2xl border-2 border-black p-3 flex flex-col justify-between">

    <!-- ================= HEADER ================= -->
    <div class="flex justify-between items-center border-b border-black pb-1">

        <!-- LOGO -->
        <div class="flex items-center gap-10">
            <img src="{{ asset('images/icon.png') }}"
                 alt="Logo PLN"
                 class="w-20 h-auto object-contain">
        </div>

        <!-- UNIT -->
        <div class="text-[10px] text-left leading-tight">
            <p class="font-semibold">
                UNIT MAINTENANCE REPAIR & OVERHAUL
            </p>
            <p>JL. Harun Tohir No.1, Gresik</p>
            <p>Jawa Timur</p>
        </div>

    </div>

    <!-- ================= CONTENT ================= -->
    <div class="flex gap-3 flex-1 mt-2">

        <!-- QR -->
        <div class="w-[110px] h-[110px] border border-black flex items-center justify-center rounded">
            <canvas id="qrcode"></canvas>
        </div>

        <!-- INFO -->
        <div class="flex flex-col justify-between flex-1">

            <div>
                <h2 class="font-bold text-blue-900 text-sm leading-snug">
                    {{ $barang->nama_barang ?? '-' }}
                </h2>

                <p class="font-semibold mt-2 text-sm">
                    No: {{ $barang->kode_barang ?? '-' }}
                </p>
            </div>

            <!-- Tahun -->
            <div id="tahunBox"
            class="grid grid-cols-5 gap-1 mt-3 text-center text-xs font-bold">
            </div>

        </div>
    </div>

</div>

<script>

// ================= DATA DARI LARAVEL =================
const barangId = "{{ $barang->id ?? '' }}";

// ================= SET TAHUN OTOMATIS =================
const tahunContainer = document.getElementById("tahunBox");
const startYear = new Date().getFullYear();

for(let i=0; i<5; i++){
    const div = document.createElement("div");
    div.className = "border border-black py-1";
    div.innerText = startYear + i;
    tahunContainer.appendChild(div);
}

// ================= QR VALUE =================
// arahkan ke halaman detail Laravel
const qrValue = "{{ url('barang/detail') }}/" + barangId;

// ================= GENERATE QR =================
QRCode.toCanvas(
    document.getElementById("qrcode"),
    qrValue,
    { width:100, margin:1 },
    function (error) {
        if (error) console.error(error)
    }
);

</script>

</body>
</html>