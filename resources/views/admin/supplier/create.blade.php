@extends('admin.layouts.app')

@section('css')
    {{-- CSS Tambahan --}}
@endsection

@section('content')

<div class="card">
    <div class="card-body">

        <h5 class="card-title fw-semibold mb-4">Tambah Data {{ $title }}</h5>

        <div class="card">
            <div class="card-body">

                <form action="{{ route('supplier.store') }}" method="POST">
                    @csrf

                    {{-- Nama Supplier --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Supplier</label>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               name="name" id="name"
                               placeholder="Nama Supplier"
                               value="{{ old('name') }}">

                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Telepon --}}
                    <div class="mb-3">
                        <label for="phone" class="form-label">Telepon</label>
                        <input type="text"
                               class="form-control @error('phone') is-invalid @enderror"
                               name="phone" id="phone"
                               placeholder="Nomor Telepon"
                               value="{{ old('phone') }}">

                        @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea class="form-control @error('address') is-invalid @enderror"
                                  name="address" id="address"
                                  rows="3"
                                  placeholder="Alamat Supplier">{{ old('address') }}</textarea>

                        @error('address')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Brands --}}
                    <div class="mb-3">
                        <label class="form-label">Brand</label>
                        <div class="form-check">
                            @foreach($brands as $brand)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="brand_ids[]" value="{{ $brand->id }}" id="brand_{{ $brand->id }}">
                                    <label class="form-check-label" for="brand_{{ $brand->id }}">{{ $brand->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        @error('brand_ids')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Tombol --}}
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('supplier.index') }}" class="btn btn-warning">Kembali</a>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection

@section('js')
    {{-- JS Tambahan --}}
@endsection
