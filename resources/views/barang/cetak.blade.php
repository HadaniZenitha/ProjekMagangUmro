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

        body {
            margin: 0;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        @media print {
            body {
                background: none;
            }

            button,
            .no-print {
                display: none !important;
            }

            #sticker {
                position: absolute;
                top: 0;
                left: 0;
                margin: 0 !important;
                border: 1px solid #000 !important;
                box-shadow: none !important;
            }

            * {
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }
        }

        .preview-container {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>

<body class="bg-gray-300">

    <div class="preview-container">
        <div id="sticker" style="
            width:10cm;
            height:6cm;
            border:1.5px solid #000;
            padding:0.4cm;
            border-radius:8px;
            display:flex;
            flex-direction:column;
            background:white;
            box-sizing: border-box;
        ">

            <div style="
                display:flex;
                align-items:center;
                justify-content:space-between;
                border-bottom:1.5px solid #000;
                padding-bottom:4px;
            ">
                <div style="display:flex; align-items:center; gap:0.2cm;">
                    <img src="{{ asset('images/icon.png') }}"
                        style="width:1.3cm; height:1.3cm; object-fit:contain; border-radius:8px;">
                    <div>
                        <p style="font-weight:bold; color:#0b3c5d; margin:0; line-height:1.2;">PLN</p>
                        <p style="font-size:12px; color:#ffca28; margin:0; line-height:1.2;">Nusantara Power</p>
                    </div>
                </div>

                <div style="height:1.1cm; border-left:1px solid #999;"></div>

                <div style="
                    font-size:9px;
                    line-height:1.3;
                    text-align:left;
                ">
                    <p style="font-weight:600; margin:0;">
                        UNIT MAINTENANCE REPAIR & OVERHAUL
                    </p>
                    <p style="margin:0;">
                        JL. Harun Tohir No. 1
                    </p>
                    <p style="margin:0;">
                        Kabupaten Gresik
                    </p>
                </div>
            </div>

            <div style="
                display:flex;
                flex:1;
                gap:0.3cm;
                margin-top:0.15cm;
            ">

                <div style="
                    width:3.2cm;
                    display:flex;
                    align-items:flex-end;
                ">
                    <div style="
                        width:100%;
                        aspect-ratio:1/1;
                        border:1.5px solid #000;
                        border-radius:6px;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        overflow: hidden;
                    ">
                        <canvas id="qrcode" style="width: 100% !important; height: auto !important;"></canvas>
                    </div>
                </div>

                <div style="
                    display:flex;
                    flex-direction:column;
                    flex:1;
                ">
                    <div style="margin-top:0.9cm;">
                        <h2 style="
                            font-weight:bold;
                            font-size:14px;
                            color:#0b3c5d;
                            margin:0;
                        ">
                            {{ $barang->nama_barang ?? 'NAMA BARANG CONTOH' }}
                        </h2>
                        <p style="
                            font-size:11px;
                            margin-top:2px;
                        ">
                            No: {{ $barang->kode_barang ?? 'BRG-2024-001' }}
                        </p>
                    </div>

                    <div id="tahunBox" style="
                        display:flex;
                        gap:0.1cm;
                        margin-top:auto;
                    "></div>
                </div>
            </div>
        </div>

        <div class="flex gap-2 no-print">
            <button onclick="window.print()" style="
                margin-top:12px;
                padding:8px 18px;
                background:#3b82f6;
                color:white;
                border:none;
                border-radius:6px;
                cursor:pointer;
            ">
                Cetak Langsung (Print)
            </button>
        </div>
    </div>

    <script>
        const barangId = "{{ $barang->id ?? '1' }}";
        const currentYear = new Date().getFullYear();
        const startYear = currentYear;
        const tahunBox = document.getElementById("tahunBox");

        // Generate Kotak Tahun
        for (let i = 0; i < 5; i++) {
            const box = document.createElement("div");
            box.style.flex = "1";
            box.style.height = "1.3cm";
            box.style.border = "0.5px solid #000";
            box.style.borderRadius = "4px";
            box.style.display = "flex";
            box.style.flexDirection = "column";

            const top = document.createElement("div");
            top.style.textAlign = "center";
            top.style.fontSize = "9px";
            top.style.fontWeight = "bold";
            top.style.padding = "2px";
            top.innerText = startYear + i;

            const line = document.createElement("div");
            line.style.borderBottom = "1px solid #000";
            line.style.margin = "0 4px";

            const bottom = document.createElement("div");
            bottom.style.flex = "1";

            top.appendChild(line);
            box.appendChild(top);
            box.appendChild(bottom);
            tahunBox.appendChild(box);
        }

        // Generate QR Code
        const qrValue = "{{ url('barang/detail') }}/" + barangId;
        QRCode.toCanvas(
            document.getElementById("qrcode"),
            qrValue,
            {
                width: 120,
                margin: 1,
                errorCorrectionLevel: 'H'
            }
        );
    </script>
</body>
</html>