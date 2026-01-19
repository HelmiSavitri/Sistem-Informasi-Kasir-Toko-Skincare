@extends('admin.layouts.app')

@section('content')
    <div class="card dashboard-card card-secondary mb-3">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Detail Produk</h5>

            <div class="row">
                <div class="col-md-4">
                    @if ($product->photo)
                        <img src="{{ asset('photos/' . $product->photo) }}" class="img-fluid" alt="{{ $product->name }}">
                    @else
                        <div class="text-muted">Tidak ada foto</div>
                    @endif
                </div>

                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tr>
                            <th>Kode</th>
                            <td>{{ $product->unique_code ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Nama Produk</th>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>{{ $product->category->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Brand</th>
                            <td>{{ $product->brand->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Stok</th>
                            <td><span class="badge rounded-pill bg-info text-white px-3">{{ $product->stock }}</span></td>
                        </tr>
                    </table>

                    <a href="{{ route('product.index') }}" class="btn btn-warning">Kembali</a>
                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary ms-2">Ubah</a>
                </div>
            </div>
        </div>
    </div>
@endsection
