<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Masukkan Nomor Meja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="height:100vh">
    <div class="card shadow-lg p-4" style="width: 350px;">
        <h4 class="text-center mb-3">Masukkan Nomor Meja</h4>
        <form action="{{ route('table.set') }}" method="POST">
            @csrf
            <input type="number" name="table_number" class="form-control mb-3" placeholder="Contoh: 3" required>
            <button type="submit" class="btn btn-primary w-100">Lanjutkan</button>
        </form>
    </div>
</body>
</html>
