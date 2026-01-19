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
                <a href="{{ route('category.create') }}" class="btn btn-primary btn-sm">Tambah Data {{ $title }}</a>
            </div>

            <div class="table-responsive">
                <table id="datatable" class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td><a href="{{ route('category.edit', $item->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                    <form id="deleteForm{{ $item->id }}"
                                        action="{{ route('category.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $item->id }})">Hapus</button>
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
    {{-- JS Tambahan --}}

    <script>
        $(document).ready(function() {
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
                        // Jika pengguna menekan "OK", submit form
                        $('#deleteForm' + id).submit();
                    } else {
                        // Jika pengguna menekan "Cancel"
                        swal("Data tidak jadi dihapus!", {
                            icon: "error",
                        });
                    }
                });
        }
    </script>

@endsection
