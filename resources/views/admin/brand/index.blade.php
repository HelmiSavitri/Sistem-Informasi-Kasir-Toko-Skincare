@extends('admin.layouts.app')

@section('css')
   <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
@endsection

@section('content')
    {{-- Konten Utama --}}
    <div class="card dashboard-card card-secondary mb-3">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h5 class="card-title fw-semibold mb-0">Data {{ $title }}</h5>
                <a href="{{ route('brand.create') }}" class="btn btn-primary btn-sm">Tambah Data {{ $title }}</a>
            </div>

            <div class="table-responsive">
                <table id="datatable" class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Brand</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $brand)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $brand->name }}</td>

                            

                            <td>
                                <a href="{{ route('brand.edit', $brand->id) }}"
                                    class="btn btn-warning btn-sm">Ubah</a>

                                <form id="deleteForm{{ $brand->id }}"
                                      action="{{ route('brand.destroy', $brand->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button"
                                            class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $brand->id }})">
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
            title: "Apakah anda yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $('#deleteForm' + id).submit();
            } else {
                swal("Data tidak jadi dihapus!", { icon: "error" });
            }
        });
    }
</script>
@endsection
