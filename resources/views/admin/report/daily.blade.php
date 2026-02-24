@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="mb-3">Laporan Penjualan</h5>

            <form method="GET" class="row g-2 mb-3" action="{{ route('report.pdf') }}" target="_blank">
                <div class="col-md-2">
                    <select name="type" id="reportType" class="form-select">
                        <option value="custom" {{ isset($type) && $type == 'custom' ? 'selected' : '' }}>Rentang Tanggal
                        </option>
                        <option value="daily" {{ isset($type) && $type == 'daily' ? 'selected' : '' }}>Harian</option>
                        <option value="monthly" {{ isset($type) && $type == 'monthly' ? 'selected' : '' }}>Bulanan</option>
                    </select>
                </div>

                <div class="col-md-5 d-flex align-items-center gap-2" id="inputRange">
                    <input type="date" name="start_date"
                        value="{{ $start_date ?? \Carbon\Carbon::today()->toDateString() }}" class="form-control">
                    <span>s/d</span>
                    <input type="date" name="end_date" value="{{ $end_date ?? \Carbon\Carbon::today()->toDateString() }}"
                        class="form-control">
                </div>

                <div class="col-md-3 d-none" id="inputDate">
                    <input type="date" name="date" value="{{ $date ?? \Carbon\Carbon::today()->toDateString() }}"
                        class="form-control">
                </div>

                <div class="col-md-3 d-none" id="inputMonth">
                    <input type="month" name="month" value="{{ $month ?? \Carbon\Carbon::now()->format('Y-m') }}"
                        class="form-control">
                </div>

                <div class="col-md-3">
                    <button type="submit" name="action" value="view" class="btn btn-primary"
                        onclick="this.form.target='_self';">Tampilkan</button>
                    <button type="submit" name="action" value="pdf" class="btn btn-danger ms-2"
                        onclick="this.form.target='_blank';">Cetak PDF</button>
                </div>
            </form>

            <hr>
        
        @section('js')
            <script>
                document.getElementById('reportType').addEventListener('change', function() {
                    const type = this.value;

                    // Sembunyikan semua input dulu
                    document.getElementById('inputRange').classList.add('d-none');
                    document.getElementById('inputDate').classList.add('d-none');
                    document.getElementById('inputMonth').classList.add('d-none');

                    // Tampilkan yang dipilih
                    if (type === 'custom') {
                        document.getElementById('inputRange').classList.remove('d-none');
                    } else if (type === 'daily') {
                        document.getElementById('inputDate').classList.remove('d-none');
                    } else if (type === 'monthly') {
                        document.getElementById('inputMonth').classList.remove('d-none');
                    }
                });
            </script>
        @endsection
