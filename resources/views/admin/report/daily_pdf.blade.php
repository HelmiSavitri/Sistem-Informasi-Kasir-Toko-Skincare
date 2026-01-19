<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan Harian</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 5px;
        }
        .tanggal {
            text-align: center;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #000;
            padding: 6px;
        }
        table th {
            background: #f2f2f2;
        }
        .total {
            margin-top: 15px;
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h2>LAPORAN PENJUALAN</h2>
    <div class="tanggal">
        {{ $label ?? '' }}
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $trx)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $trx->transaction_code ?? $trx->kode_transaksi ?? '-' }}</td>
                <td>Rp {{ number_format($trx->total_price ?? $trx->total ?? $trx->total_harga ?? 0, 0, ',', '.') }}</td>
                <td>{{ $trx->created_at->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Total Penjualan:
        Rp {{ number_format($total, 0, ',', '.') }}
    </div>

</body>
</html>
