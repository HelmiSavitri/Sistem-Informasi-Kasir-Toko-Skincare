@extends('admin.layouts.app')

{{-- css --}}
@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
    <style>
        .bg-light-warning {
            background-color: #fff9e6;
            color: #ffc107;
        }

        .bg-light-danger {
            background-color: #ffe6e6;
            color: #dc3545;
        }

        .text-warning-star {
            color: #ffc107;
        }
    </style>
@endsection

{{-- Konten Utama --}}
@section('content')
    <div class="row">
        {{-- Total Product --}}
        <div class="col-lg-4">
            <div class="card dashboard-card card-secondary mb-3">
                <div class="card-body">
                    <div class="row align-items-start">
                        <div class="col-8">
                            <h5 class="card-title mb-9 fw-semibold">Total Product</h5>
                            <h4 class="fw-semibold mb-3">{{ $total_product }}</h4>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-end">
                                <div
                                    class="dash-icon gradient-secondary text-white d-flex align-items-center justify-content-center">
                                    <i class="ti ti-box"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Brand --}}
        <div class="col-lg-4">
            <div class="card dashboard-card card-primary mb-3">
                <div class="card-body">
                    <div class="row align-items-start">
                        <div class="col-8">
                            <h5 class="card-title mb-9 fw-semibold">Total Brand</h5>
                            <h4 class="fw-semibold mb-3">{{ $total_brand }}</h4>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-end">
                                <div
                                    class="dash-icon gradient-primary text-white d-flex align-items-center justify-content-center">
                                    <i class="ti ti-brand-appgallery"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- BARU: Rata-rata Rating --}}
        <div class="col-lg-4">
            <div class="card dashboard-card mb-3"
                style="background: linear-gradient(45deg, #ff9a9e 0%, #fecfef 99%, #fecfef 100%); border: none;">
                <div class="card-body">
                    <div class="row align-items-start text-white">
                        <div class="col-8">
                            <h5 class="card-title mb-9 fw-semibold text-white">Rating Kepuasan</h5>
                            <h4 class="fw-semibold mb-3">{{ number_format($avg_rating, 1) }} / 5.0 ⭐</h4>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-end">
                                <div
                                    class="dash-icon bg-white text-danger d-flex align-items-center justify-content-center shadow-sm">
                                    <i class="ti ti-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Stok Menipis --}}
        <div class="col-lg-6">
            <div class="card dashboard-card card-warning mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3 fw-semibold">Stok Menipis</h5>
                    @if (isset($low_stock_products) && $low_stock_products->isEmpty())
                        <p class="text-muted small">Tidak ada produk dengan stok menipis.</p>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach ($low_stock_products as $product)
                                <li class="d-flex justify-content-between align-items-center list-group-item border-0 px-0">
                                    <span class="small">{{ $product->name }}</span>
                                    <span class="badge rounded-pill bg-warning text-dark px-3">sisa
                                        {{ $product->stock }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        {{-- Stok Habis --}}
        <div class="col-lg-6">
            <div class="card dashboard-card card-danger mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3 fw-semibold">Stok Habis</h5>
                    @if (isset($out_of_stock_products) && $out_of_stock_products->isEmpty())
                        <p class="text-muted small">Tidak ada produk yang habis.</p>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach ($out_of_stock_products as $product)
                                <li class="d-flex justify-content-between align-items-center list-group-item border-0 px-0">
                                    <span class="small">{{ $product->name }}</span>
                                    <span class="badge rounded-pill bg-danger text-white px-3">Habis</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        {{-- Barang Terlaris --}}
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm border-0" style="border-radius: 15px; border-left: 5px solid #ff69b4 !important;">
                <div class="card-body">
                    <h6 class="text-muted fw-semibold">Barang Terlaris</h6>
                    <hr class="my-2">
                    @if ($terlaris && $terlaris->product)
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="fw-bold mb-0" style="color: #d63384;">{{ $terlaris->product->name }}</h5>
                                <small class="text-muted">Terjual {{ $terlaris->total_qty }} pcs</small>
                            </div>
                            <span class="badge bg-light-danger text-danger p-2 px-3">Best Seller</span>
                        </div>
                    @else
                        <p class="text-muted mb-0 small italic">Belum ada data penjualan.</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Barang Jarang Dibeli --}}
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm border-0" style="border-radius: 15px; border-left: 5px solid #f0ad4e !important;">
                <div class="card-body">
                    <h6 class="text-muted fw-semibold">Barang Jarang Dibeli</h6>
                    <hr class="my-2">
                    @if ($jarang_dibeli && $jarang_dibeli->product)
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="fw-bold mb-0" style="color: #856404;">{{ $jarang_dibeli->product->name }}</h5>
                                <small class="text-muted">Hanya terjual {{ $jarang_dibeli->total_qty }} pcs</small>
                            </div>
                            <span class="badge bg-light-warning text-warning p-2 px-3">Slow Moving</span>
                        </div>
                    @else
                        <p class="text-muted mb-0 small italic">Belum ada data penjualan.</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- BARU: Daftar Ulasan Terbaru --}}
        <div class="col-md-12 mb-3">
            <div class="card shadow-sm border-0" style="border-radius: 15px;">
                <div class="card-body">
                    <h6 class="fw-semibold mb-3">Rating Pelayanan Kasir</h6>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="small fw-bold">Tanggal</th>
                                    <th class="small fw-bold">Kode Transaksi</th>
                                    <th class="small fw-bold">Rating</th>
                                    <th class="small fw-bold">Komentar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recent_ratings as $rating)
                                    <tr>
                                        <td class="small">{{ $rating->created_at->format('d/m/Y') }}</td>
                                        <td class="small fw-bold text-primary">
                                            {{ $rating->transaction->transaction_code ?? 'TRX-N/A' }}</td>
                                        <td class="text-warning-star small">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="{{ $i <= $rating->score ? 'fas' : 'far' }} fa-star"></i>
                                            @endfor
                                        </td>
                                        <td class="small italic">"{{ Str::limit($rating->comment, 60) }}"</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted small py-4">Belum ada ulasan dari
                                            pelanggan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- Javascript --}}
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
@endsection
