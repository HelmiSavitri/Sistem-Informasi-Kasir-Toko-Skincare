@extends('admin.layouts.app')

@section('css')
    {{-- CSS Tambahan --}}
@endsection

@section('content')

<div class="card">
    <div class="card-body">

        <h5 class="card-title fw-semibold mb-4">Ubah Data {{ $title }}</h5>

        <div class="card">
            <div class="card-body">

                <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nama Supplier --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Supplier</label>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               name="name" id="name"
                               placeholder="Nama Supplier"
                               value="{{ old('name', $supplier->name) }}">

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
                               value="{{ old('phone', $supplier->phone) }}">

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
                                  placeholder="Alamat Supplier">{{ old('address', $supplier->address) }}</textarea>

                        @error('address')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Brands --}}
                    <div class="mb-3">
                        <label class="form-label">Brands</label>
                        <div class="form-check">
                            @foreach($brands as $brand)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="brand_ids[]" value="{{ $brand->id }}" id="brand_{{ $brand->id }}" {{ in_array($brand->id, old('brand_ids', $supplier->brands->pluck('id')->toArray())) ? 'checked' : '' }}>
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
``
