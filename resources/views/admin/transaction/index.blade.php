@extends('admin.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
@endsection

@section('content')
    {{-- Konten Utama --}}
    <div class="card dashboard-card card-secondary mb-3">
        <div class="card-body">

            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="card-title fw-semibold mb-0">Data {{ $title }}</h5>
                <div class="d-flex align-items-center gap-2">
                    @if (Auth::user()->role == 'Kasir')
                        <a href="{{ route('transaction.create') }}" class="btn btn-primary btn-sm">
                            Tambah Data {{ $title }}
                        </a>
                    @endif

                    <form method="GET" action="{{ route('report.pdf') }}" target="_blank"
                        class="d-flex align-items-center gap-2 m-0">

                        <input type="hidden" name="type" value="custom" />

                        <div class="input-group input-group-sm">
                            <input type="date" name="start_date"
                                value="{{ request('start_date', \Carbon\Carbon::today()->toDateString()) }}"
                                class="form-control" title="Tanggal Awal" />

                            <span class="input-group-text bg-light text-muted">s/d</span>

                            <input type="date" name="end_date"
                                value="{{ request('end_date', \Carbon\Carbon::today()->toDateString()) }}"
                                class="form-control" title="Tanggal Akhir" />
                        </div>

                        <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center">
                            Cetak PDF
                        </button>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table id="datatable" class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Total Harga</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($transactions as $trx)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <span class="fw-bold">
                                        {{ $trx->transaction_code ?? ($trx->kode_transaksi ?? '-') }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge rounded-pill bg-success text-white px-3">
                                        Rp
                                        {{ number_format($trx->total_price ?? ($trx->total ?? ($trx->total_harga ?? 0)), 0, ',', '.') }}
                                    </span>
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($trx->created_at)->format('d-m-Y') }}
                                </td>
                                <td>
                                    <a href="{{ route('transaction.show', $trx->id) }}"
                                        class="btn btn-info btn-sm me-1 mb-1">Detail</a>
                                    <a href="{{ route('transaction.edit', $trx->id) }}"
                                        class="btn btn-warning btn-sm me-1 mb-1">Ubah</a>

                                    <form id="deleteForm{{ $trx->id }}"
                                        action="{{ route('transaction.destroy', $trx->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm me-1 mb-1"
                                            onclick="confirmDelete({{ $trx->id }})">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection



@section('js')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });

        function openRatingModal(id) {
            $('#modal_transaction_id').val(id);
            $('#ratingModal').modal('show');
        }

        function confirmDelete(id) {
            swal({
                    title: "Apakah anda yakin?",
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        document.getElementById('deleteForm' + id).submit();
                    } else {
                        swal("Data tidak jadi dihapus!", {
                            icon: "error"
                        });
                    }


                });
        }
    </script>
@endsection

