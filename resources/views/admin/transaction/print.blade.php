<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Courier New', monospace;
            font-size: 12px;
            width: 80mm;
            margin: 0 auto;
            padding: 10px;
        }

        .receipt {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
        }

        .header {
            margin-bottom: 10px;
            border-bottom: 1px dashed #000;
            padding-bottom: 5px;
        }

        .header h3 {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .transaction-info {
            text-align: left;
            margin-bottom: 10px;
            border-bottom: 1px dashed #000;
            padding-bottom: 5px;
            font-size: 11px;
        }

        .transaction-info p {
            margin: 3px 0;
        }

        .items {
            margin-bottom: 10px;
            border-bottom: 1px dashed #000;
            padding-bottom: 5px;
        }

        .item {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
            font-size: 11px;
            text-align: left;
        }

        .item-name {
            flex: 1;
        }

        .item-qty {
            width: 40px;
            text-align: center;
        }

        .item-price {
            width: 60px;
            text-align: right;
        }

        .summary {
            margin-bottom: 10px;
            border-bottom: 1px dashed #000;
            padding-bottom: 5px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
            font-size: 11px;
        }

        .summary-row.total {
            font-weight: bold;
            font-size: 12px;
            border-top: 1px solid #000;
            padding-top: 5px;
        }

        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 10px;
        }

        .divider {
            border-bottom: 1px dashed #000;
            margin: 5px 0;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <h3>STRUK TRANSAKSI</h3>
            <p style="font-size: 10px;">Kasir Beauty</p>
        </div>

        <div class="transaction-info">
            <p><strong>No. Transaksi:</strong> {{ $trx->transaction_code }}</p>
            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($trx->created_at)->format('d-m-Y H:i') }}</p>
        </div>

        <div class="items">
            <div class="divider"></div>
            @foreach ($trx->items as $item)
                <div class="item">
                    <div class="item-name">{{ $item->product->name ?? 'Produk' }}</div>
                    <div class="item-qty">{{ $item->qty }}x</div>
                    <div class="item-price">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                </div>
                <div style="font-size: 10px; text-align: right; margin: 2px 0;">
                    Rp {{ number_format($item->qty * $item->price, 0, ',', '.') }}
                </div>
            @endforeach
            <div class="divider"></div>
        </div>

        <div class="summary">
            <div class="summary-row">
                <span>Subtotal:</span>
                <span>Rp {{ number_format($trx->total_price ?? ($trx->total ?? 0), 0, ',', '.') }}</span>
            </div>
            <div class="summary-row">
                <span>Diskon:</span>
                <span>Rp 0</span>
            </div>
            <div class="summary-row total">
                <span>TOTAL:</span>
                <span>Rp {{ number_format($trx->total_price ?? ($trx->total ?? 0), 0, ',', '.') }}</span>
            </div>
            @if ($trx->paid_amount)
                <div class="summary-row">
                    <span>Dibayar:</span>
                    <span>Rp {{ number_format($trx->paid_amount, 0, ',', '.') }}</span>
                </div>
                <div class="summary-row">
                    <span>Kembalian:</span>
                    <span>Rp {{ number_format($trx->change_amount ?? 0, 0, ',', '.') }}</span>
                </div>
            @endif
        </div>

        <div class="footer">
            <p>Terima kasih telah berbelanja!</p>
            <p>{{ date('d-m-Y H:i:s') }}</p>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>
