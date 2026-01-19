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
                    <form action="{{ route('transaction.update', $trx->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Kode Transaksi --}}
                        <div class="mb-3">
                            <label for="transaction_code" class="form-label">Kode Transaksi</label>
                            <input type="text"
                                   class="form-control @error('transaction_code') is-invalid @enderror"
                                   name="transaction_code"
                                   id="transaction_code"
                                   value="{{ old('transaction_code', $trx->transaction_code) }}"
                                   placeholder="Masukkan Kode Transaksi">
                            @error('transaction_code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Total Harga --}}
                        <div class="mb-3">
                            <label for="total_price" class="form-label">Total Harga</label>
                            <input type="number"
                                   class="form-control @error('total_price') is-invalid @enderror"
                                   name="total_price"
                                   id="total_price"
                                   value="{{ old('total_price', $trx->total_price ?? $trx->total) }}"
                                   placeholder="Masukkan Total Harga">
                            @error('total_price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Uang Bayar --}}
                        <div class="mb-3">
                            <label for="paid_amount" class="form-label">Uang Bayar</label>
                            <input type="number"
                                   class="form-control @error('paid_amount') is-invalid @enderror"
                                   name="paid_amount"
                                   id="paid_amount"
                                   value="{{ old('paid_amount', $trx->paid_amount) }}"
                                   placeholder="Masukkan Uang Bayar">
                            @error('paid_amount')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Tombol --}}
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('transaction.index') }}" class="btn btn-warning">Kembali</a>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    {{-- JS Tambahan --}}
@endsection
