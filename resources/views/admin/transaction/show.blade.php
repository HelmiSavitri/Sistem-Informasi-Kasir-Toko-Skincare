@extends('admin.layouts.app')

@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Detail Transaksi</h5>

            <div class="row">
                <div class="col-md-6">
                    <table class="table table-striped table-bordered-0">
                        <tbody>
                            <tr>
                                <th>Kode Transaksi</th>
                                <td>{{ $trx->transaction_code ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td>Rp {{ number_format($trx->total_price ?? ($trx->total ?? 0), 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Uang Bayar</th>
                                <td>Rp {{ number_format($trx->paid_amount ?? 0, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Kembalian</th>
                                <td>Rp {{ number_format($trx->change_amount ?? 0, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>{{ $trx->created_at->timezone(config('app.timezone'))->format('d F Y H:i') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6">
                    <h5 class="card-title fw-semibold mb-4">Item Transaksi</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trx->items as $item)
                                <tr>
                                    <td>{{ $item->product->name ?? '-' }}</td>
                                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Tambahkan di bawah bagian Item Transaksi --}}
            <div class="card mt-4">
                <div class="card-header bg-light">
                    @if (Auth::user()->role == 'Kasir')
                    <h6 class="mb-0">Rating & Ulasan Pelayanan</h6>
                </div>
                <div class="card-body">
                    @if ($transaction->rating)
                        <div class="alert alert-info">
                            <strong>Penilaian:</strong>
                            @if ($transaction->rating->score >= 4)
                                Puas 😊
                            @elseif($transaction->rating->score == 3)
                                Cukup 😐
                            @else
                                Tidak Puas ☹️
                            @endif
                            ({{ $transaction->rating->score }} / 5)
                            <br>
                            <strong>Catatan:</strong> {{ $transaction->rating->comment ?? '-' }}
                        </div>
                    @else
                        <form action="{{ route('ratings.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                            <div class="row align-items-end">
                                <div class="col-md-4">
                                    <label class="form-label">Tingkat Kepuasan</label>
                                    <select name="score" class="form-select" required>
                                        <option value="5">Sangat Puas</option>
                                        <option value="4">Puas</option>
                                        <option value="3">Cukup</option>
                                        <option value="2">Kurang</option>
                                        <option value="1">Kecewa</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Komentar</label>
                                    <input type="text" name="comment" class="form-control"
                                        placeholder="Masukan ulasan singkat...">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
             @endif

            <div class="row mt-3">
                <div class="col-md-6">
                    <a href="{{ route('transaction.index') }}" class="btn btn-warning">Kembali</a>
                    <a href="{{ route('transaction.print', $trx->id) }}" target="_blank"
                        class="btn btn-secondary ms-2">Cetak Struk</a>
                </div>

                <div class="col-md-6">
                    <div id="receipt" class="card p-3" style="max-width:360px; margin-left:auto;">
                        <div style="font-family: 'Courier New', monospace; font-size:12px;">

                        </div>
                    </div>
                </div>

        @endsection

        @section('js')
            <script>
                function printReceipt() {
                    const receipt = document.getElementById('receipt');
                    if (!receipt) return alert('Tidak ada struk untuk dicetak.');

                    const w = window.open('', '_blank');
                    const styles = `
                <style>
                    body{ font-family: 'Courier New', monospace; font-size:12px; padding:10px }
                    .receipt{ max-width:360px; margin:0 auto }
                    hr{ border:none; border-bottom:1px dashed #000; margin:8px 0 }
                </style>
            `;

                }
            </script>
        @endsection
