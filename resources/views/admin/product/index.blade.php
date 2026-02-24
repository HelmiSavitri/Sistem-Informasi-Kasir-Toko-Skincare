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
                @if (Auth::user()->role == 'Admin')
                    <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm">Tambah Data {{ $title }}</a>
                @endif
            </div>

            <div class="table-responsive">
                <table id="datatable" class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Produk</th>
                            <th>Foto</th>
                            <th>Kategori</th>
                            <th>Brand</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            @if (Auth::user()->role == 'Admin')
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $product->unique_code ?? '-' }}</td>

                                <td>{{ $product->name }}</td>

                                <td>
                                    @if ($product->photo)
                                        <img src="{{ asset('photos/' . $product->photo) }}" class="product-image"
                                            alt="{{ $product->name }}">
                                    @else
                                        <span class="text-muted">Tidak ada foto</span>
                                    @endif
                                </td>



                                <td>{{ $product->category->name ?? '-' }}</td>
                                <td>{{ $product->brand->name ?? '-' }}</td>

                                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td><span class="badge rounded-pill bg-info text-white px-3">{{ $product->stock }}</span>
                                </td>
                                @if (Auth::user()->role == 'Admin')
                                    <td>
                                        <a href="{{ route('product.show', $product->id) }}"
                                            class="btn btn-info btn-sm mb-2">Detail</a>

                                        <form id="deleteForm{{ $product->id }}"
                                            action="{{ route('product.destroy', $product->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $product->id }})">Hapus</button>
                                        </form>
                                    </td>
                                @endif
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
                        swal("Data tidak jadi dihapus!", {
                            icon: "error"
                        });
                    }
                });
        }
    </script>
@endsection
