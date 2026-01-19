@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="mb-3">Laporan Penjualan</h5>

        <form method="GET" class="row g-2 mb-3" action="{{ route('report.pdf') }}" target="_blank">
            <div class="col-md-2">
                <select name="type" id="reportType" class="form-select">
                    <option value="daily" {{ (isset($type) && $type=='daily') ? 'selected' : '' }}>Harian</option>
                    <option value="weekly" {{ (isset($type) && $type=='weekly') ? 'selected' : '' }}>Mingguan</option>
                    <option value="monthly" {{ (isset($type) && $type=='monthly') ? 'selected' : '' }}>Bulanan</option>
                </select>
            </div>

            <div class="col-md-3" id="inputDate">
                <input type="date" name="date" value="{{ $date ?? \Carbon\Carbon::today()->toDateString() }}" class="form-control">
            </div>

            <div class="col-md-3 d-none" id="inputMonth">
                <input type="month" name="month" value="{{ $month ?? \Carbon\Carbon::now()->format('Y-m') }}" class="form-control">
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary">Tampilkan</button>
                <button type="submit" class="btn btn-danger ms-2">Cetak PDF</button>
            </div>
        </form>

        <hr>

        <div class="mb-3"><strong>{{ $label ?? 'Harian' }}</strong></div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Transaksi</th>
                    <th>Total Harga</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $trx)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $trx->transaction_code ?? $trx->kode_transaksi ?? '-' }}</td>
                    <td>Rp {{ number_format($trx->total_price ?? $trx->total ?? $trx->total_harga ?? 0, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($trx->created_at)->format('d-m-Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada transaksi</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <h5 class="mt-3">
            Total Penjualan:
            <strong>
                Rp {{ number_format($total, 0, ',', '.') }}
            </strong>
        </h5>
    </div>
</div>
@endsection

@section('js')
<script>
    document.getElementById('reportType').addEventListener('change', function () {
        const type = this.value;
        document.getElementById('inputDate').classList.toggle('d-none', type === 'monthly');
        document.getElementById('inputMonth').classList.toggle('d-none', type !== 'monthly');
    });
</script>
@endsection