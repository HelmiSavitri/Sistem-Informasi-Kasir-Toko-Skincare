@extends('admin.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
@endsection

@section('content')
<div class="card dashboard-card card-secondary mb-3">
    <div class="card-body">

        <div class="d-flex align-items-center justify-content-between mb-4">
            <h5 class="card-title fw-semibold mb-0">Data {{ $title }}</h5>
            <a href="{{ route('supplier.create') }}" class="btn btn-primary btn-sm">Tambah Data {{ $title }}</a>
        </div>

        <div class="table-responsive">
            <table id="datatable" class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Supplier</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Brands</th>
                        <th width="120px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($suppliers as $supplier)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->phone }}</td>
                        <td>{{ $supplier->address }}</td>
                        <td>
                            @if($supplier->brands->count())
                                @foreach($supplier->brands as $b)
                                    <span class="badge rounded-pill bg-secondary text-white px-2 me-1 mb-2">{{ $b->name }}</span>
                                @endforeach
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('supplier.edit', $supplier->id) }}"
                               class="btn btn-warning btn-sm mb-2">
                                Ubah
                            </a>

                            <form id="deleteForm{{ $supplier->id }}"
                                  action="{{ route('supplier.destroy', $supplier->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button type="button"
                                        class="btn btn-danger btn-sm"
                                        onclick="confirmDelete({{ $supplier->id }})">
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
    $(document).ready(function () {
        $('#datatable').DataTable();
    });

    function confirmDelete(id) {
        swal({
            title: "Apakah Anda yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                document.getElementById('deleteForm' + id).submit();
            } else {
                swal("Data batal dihapus!", { icon: "error" });
            }
        });
    }
</script>
@endsection
