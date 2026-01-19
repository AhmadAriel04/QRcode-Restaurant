<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>QR Meja {{ $table }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: white;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .card {
            width: 320px;
            margin: 40px auto;
            border: 2px solid #000;
            padding: 20px;
            border-radius: 16px;
        }

        h1 {
            margin-bottom: 5px;
            font-size: 28px;
        }

        .subtitle {
            font-size: 14px;
            margin-bottom: 15px;
        }

        .qr-box {
            margin: 20px 0;
        }

        .footer {
            font-size: 13px;
            margin-top: 10px;
        }

        .brand {
            margin-top: 15px;
            font-weight: bold;
        }

        @media print {
            body {
                margin: 0;
            }
        }
    </style>
</head>
<body>

<div class="card">
    <h1>MEJA {{ $table }}</h1>
    <div class="subtitle">Scan untuk melihat menu & pesan</div>

    <div class="qr-box">
        {!! QrCode::size(250)->generate($url) !!}
    </div>

    <div class="footer">
        📱 Scan QR untuk memesan <br>
        💳 Bayar langsung di kasir / QRIS
    </div>

    <div class="brand">
        🍜 RESTO KAMU
    </div>
</div>

</body>
</html>
