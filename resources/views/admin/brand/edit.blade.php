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
                    <form action="{{ route('brand.update', $brand->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Nama Brand --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Brand</label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   name="name" id="name" 
                                   placeholder="Nama Brand" 
                                   value="{{ old('name', $brand->name) }}">

                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        {{-- Tombol --}}
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('brand.index') }}" class="btn btn-warning">Kembali</a>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    {{-- JS Tambahan --}}
@endsection
