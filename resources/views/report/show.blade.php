<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Pendapatan</title>
</head>
<body>
    <h1>Pendapatan</h1>
    <p>Tanggal: {{ $tanggal_awal }} hingga {{ $tanggal_akhir }}</p>
    <p>Total Pendapatan: Rp {{ number_format($pendapatan, 0, ',', '.') }}</p>
</body>
</html>