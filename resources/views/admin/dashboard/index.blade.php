@extends('admin.layouts.app')

{{--css--}}
@section('css')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
@endsection

{{--Konten Utama--}}
@section('content')
<div class="row">
    {{--Total Siswa--}}
    <div class="col-lg-6">
        <div class="card dashboard-card card-secondary mb-3">
            <div class="card-body">
                <div class="row align-items-start">
                    <div class="col-8">
                        <h5 class="card-title mb-9 fw-semibold">Total Product</h5>
                        <h4 class="fw-semibold mb-3">{{ $total_product }}</h4>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-end">
                            <div class="dash-icon gradient-secondary text-white d-flex align-items-center justify-content-center">
                                <i class="ti ti-box"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--Total Item--}}
    <div class="col-lg-6">
        <div class="card dashboard-card card-primary mb-3">
            <div class="card-body">
                <div class="row align-items-start">
                    <div class="col-8">
                        <h5 class="card-title mb-9 fw-semibold">Total Brand</h5>
                        <h4 class="fw-semibold mb-3">{{ $total_brand }}</h4>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-end">
                            <div class="dash-icon gradient-primary text-white d-flex align-items-center justify-content-center">
                                <i class="ti ti-brand-appgallery"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Stok Menipis --}}
    <div class="col-lg-6">
        <div class="card dashboard-card card-warning mb-3">
            <div class="card-body">
                <h5 class="card-title mb-9 fw-semibold">Stok Menipis</h5>
                @if(isset($low_stock_products) && $low_stock_products->isEmpty())
                    <p class="text-muted">Tidak ada produk dengan stok menipis.</p>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach($low_stock_products as $product)
                        <li class="d-flex justify-content-between align-items-center list-group-item-hover">
                            {{ $product->name }}
                            <span class="badge rounded-pill bg-warning text-dark px-3">sisa {{ $product->stock }}</span>
                        </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

    {{-- Stok Habis --}}
    <div class="col-lg-6">
        <div class="card dashboard-card card-danger mb-3">
            <div class="card-body">
                <h5 class="card-title mb-9 fw-semibold">Stok Habis</h5>
                @if(isset($out_of_stock_products) && $out_of_stock_products->isEmpty())
                    <p class="text-muted">Tidak ada produk yang habis.</p>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach($out_of_stock_products as $product)
                        <li class="d-flex justify-content-between align-items-center list-group-item-hover mb-3">
                            {{ $product->name }}
                            <span class="badge rounded-pill bg-danger text-white px-3">Habis</span>
                        </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection

{{--Javascript--}}
@section('js')
@endsection
