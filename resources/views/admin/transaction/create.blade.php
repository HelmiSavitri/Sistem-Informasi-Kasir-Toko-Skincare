@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">

            <h4>Transaksi Kasir</h4>
            <hr>

            {{-- SCAN / INPUT KODE PRODUK --}}
            {{-- PENCARIAN NAMA PRODUK --}}
            <div class="mb-3">
                <label class="form-label">Cari Nama/Kode Produk</label>
                <select id="product_select" class="form-control">
                    <option value="">-- Ketik Nama atau Scan Barcode --</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->unique_code }}" data-id="{{ $product->id }}"
                            data-name="{{ $product->name }}" data-price="{{ $product->price }}"
                            data-stock="{{ $product->stock }}">
                            {{ $product->unique_code }} - {{ $product->name }} (Stok: {{ $product->stock }})
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">Gunakan keyboard untuk mencari nama produk</small>
            </div>

            <br>

            {{-- DATA PRODUK --}}
            <form id="addToCartForm" action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" id="product_id" name="product_id">

                <div class="row">
                    <div class="col-md-4">
                        <label>Nama Produk</label>
                        <input type="text" id="product_name" class="form-control">
                    </div>

                    <div class="col-md-2">
                        <label>Harga</label>
                        <input type="text" id="product_price" class="form-control" readonly>
                    </div>

                    <div class="col-md-2">
                        <label>Stok</label>
                        <input type="text" id="product_stock" class="form-control" readonly>
                    </div>

                    <div class="col-md-2">
                        <label>Qty</label>
                        <input type="number" name="qty" value="1" min="1" id="qty"
                            class="form-control">
                    </div>

                    <div class="col-md-2 d-flex align-items-end">
                        <button class="btn btn-primary w-100">Tambah</button>
                    </div>
                </div>
            </form>

            <hr>

            {{-- KERANJANG --}}
            <h5>Keranjang</h5>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                        <th>Aksi</th> {{-- Tambah Header --}}
                    </tr>
                </thead>

                <tbody>
                    @php $total = 0; @endphp
                    @foreach (session('cart', []) as $id => $c)
                        {{-- Tambahkan $id --}}
                        @php $total += $c['subtotal']; @endphp
                        <tr>
                            <td>{{ $c['code'] }}</td>
                            <td>{{ $c['name'] }}</td>
                            <td>Rp {{ number_format($c['price']) }}</td>
                            <td>{{ $c['qty'] }}</td>
                            <td>Rp {{ number_format($c['subtotal']) }}</td>
                            <td class="text-center">
                                {{-- Tombol Hapus --}}
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="ti ti-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h4>Total: <b>Rp {{ number_format($total) }}</b></h4>

            <hr>

            {{-- PEMBAYARAN --}}
            <form action="{{ route('transaction.pay') }}" method="POST">
                @csrf

                <label>Uang Bayar</label>
                <input type="number" class="form-control" name="paid_amount" required>

                <br>
                <button class="btn btn-success w-100">Proses Bayar</button>
            </form>

        </div>
    </div>
@endsection

@section('js')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // 1. Inisialisasi Select2
            $('#product_select').select2({
                placeholder: "-- Cari Produk --",
                allowClear: true,
                width: '100%'
            });

            // 2. Event saat produk dipilih (Menggantikan fungsi keyup lama)
            $('#product_select').on('change', function() {
                const selected = $(this).find(':selected');

                if (this.value === "") return;

                // Ambil data dari atribut data- di dalam option
                const id = selected.data('id');
                const name = selected.data('name');
                const price = selected.data('price');
                const stock = selected.data('stock');

                // Isi Form Data Produk secara otomatis
                document.getElementById('product_id').value = id;
                document.getElementById('product_name').value = name;
                document.getElementById('product_price').value = price;
                document.getElementById('product_stock').value = stock;

                // Atur Max Qty dan Fokus ke Qty
                let qtyInput = document.getElementById('qty');
                qtyInput.max = stock;
                qtyInput.value = 1;
                qtyInput.focus();
            });
        });

        // --- Sisanya tetap gunakan fungsi showNotification dan Validasi Form milikmu ---
        function showNotification(type, message) {
            // ... kode notification kamu ...
        }

        let cartQuantities = @json(collect(session('cart', []))->pluck('qty', 'product_id')) || {};

        document.getElementById('addToCartForm').addEventListener('submit', function(e) {
            // ... kode validasi submit kamu ...
        });

        @if (session('error'))
            showNotification('error', "{{ session('error') }}");
        @endif
        @if (session('success'))
            showNotification('success', "{{ session('success') }}");
        @endif
    </script>
@endsection
