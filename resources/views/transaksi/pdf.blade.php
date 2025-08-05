<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Transaksi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Data Transaksi</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Toko</th>
                <th>Nominal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $t)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $t->kode_toko }}</td>
                    <td>Rp {{ number_format($t->nominal_transaksi, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
