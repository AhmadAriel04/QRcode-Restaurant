<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
        }
        .qr-box {
            page-break-after: always;
            margin-top: 50px;
        }
        img {
            width: 250px;
            height: 250px;
        }
    </style>
</head>
<body>

@foreach ($tables as $table)
    <div class="qr-box">
        <h2>QR Code Meja {{ $table->table_number }}</h2>
    
    <img src="data:image/png;base64,{{ $table->qr_base64 }}" width="200">

        
        <p>Scan untuk memesan makanan</p>
    </div>
@endforeach

</body>
</html>
