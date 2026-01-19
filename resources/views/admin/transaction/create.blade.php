@extends('admin.layouts.app')

@section('content')

<div class="card">
    <div class="card-body">

        <h4>Transaksi Kasir</h4>
        <hr>

        {{-- SCAN / INPUT KODE PRODUK --}}
        <form id="searchForm">
            <label>Kode Produk</label>
            <input type="text" id="product_code" class="form-control" autofocus>
            <small class="text-muted">Scan barcode atau ketik manual</small>
        </form>

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
                    <input type="number" name="qty" value="1" min="1" id="qty" class="form-control">
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
                </tr>
            </thead>

            <tbody>
                @php $total = 0; @endphp
                @foreach (session('cart', []) as $c)
                    @php $total += $c['subtotal']; @endphp
                    <tr>
                        <td>{{ $c['code'] }}</td>
                        <td>{{ $c['name'] }}</td>
                        <td>Rp {{ number_format($c['price']) }}</td>
                        <td>{{ $c['qty'] }}</td>
                        <td>Rp {{ number_format($c['subtotal']) }}</td>
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
<script>
    // Fungsi Notifikasi yang Diperbarui (Tengah) 
    function showNotification(type, message) {
        const colors = { 
            success: 'alert-success', 
            error: 'alert-danger', 
            warning: 'alert-warning', 
            info: 'alert-info' 
        };
        
        let container = document.getElementById('notifContainer');
        if (!container) {
            container = document.createElement('div');
            container.id = 'notifContainer';
            // CSS untuk memposisikan di tengah layar (sebagai popup)
            container.style.position = 'fixed';
            container.style.top = '50%';
            container.style.left = '50%';
            container.style.transform = 'translate(-50%, -50%)';
            container.style.zIndex = '9999';
            container.style.display = 'flex';
            container.style.flexDirection = 'column';
            container.style.alignItems = 'center';
            container.style.gap = '10px';
            container.style.width = '90%';
            container.style.maxWidth = '420px';
            document.body.appendChild(container);
        }

        const alert = document.createElement('div');
        alert.className = 'alert ' + (colors[type] || 'alert-info') + ' shadow-lg text-center border-2';
        alert.style.marginBottom = '0';
        alert.style.padding = '16px 20px';
        alert.style.opacity = '0';
        alert.style.transition = 'opacity 0.25s ease, transform 0.25s ease';
        alert.style.transform = 'scale(0.8)'; // Efek muncul dari kecil ke besar
        
        // Menambahkan ikon agar lebih jelas
        let icon = type === 'warning' ? '⚠️ ' : (type === 'error' ? '❌ ' : 'ℹ️ ');
        alert.innerHTML = `<strong>${icon} ${message}</strong>`; 

        // Masukkan di paling atas sehingga notifikasi terbaru muncul di atas
        container.insertBefore(alert, container.firstChild);

        // Memicu animasi muncul (zoom in)
        setTimeout(() => {
            alert.style.opacity = '1';
            alert.style.transform = 'scale(1)';
        }, 10);

        // Menghilang otomatis setelah 4 detik (zoom out dan hilang)
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transform = 'scale(0.8)';
            setTimeout(() => {
                alert.remove();
                if (container.childNodes.length === 0) container.remove();
            }, 250);
        }, 4000);
    }

    // Map of product_id => qty currently in cart (from session)
    let cartQuantities = @json(collect(session('cart', []))->pluck('qty','product_id')) || {};

    // AJAX CARI PRODUK
    document.getElementById('product_code').addEventListener('keyup', function () {
        let code = this.value;
        if (code.length < 3) return;

        fetch("{{ route('find.product') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ code })
        })
        .then(res => res.json())
        .then(data => {
            if(!data.status) return;

            let p = data.product;
            document.getElementById('product_id').value = p.id;
            document.getElementById('product_name').value = p.name;
            document.getElementById('product_price').value = p.price;
            document.getElementById('product_stock').value = p.stock;

            let qtyInput = document.getElementById('qty');
            qtyInput.max = p.stock;
            qtyInput.value = 1;
            qtyInput.focus();
        });
    });

    // Validasi Sisi Klien sebelum Tambah ke Keranjang
    document.getElementById('addToCartForm').addEventListener('submit', function (e) {
        let stock = parseInt(document.getElementById('product_stock').value) || 0;
        let qty = parseInt(document.getElementById('qty').value) || 0;
        let pid = parseInt(document.getElementById('product_id').value) || null;

        if (!pid) {
            e.preventDefault();
            showNotification('warning', 'Produk belum dipilih!');
            return;
        }

        let existing = cartQuantities[pid] ? parseInt(cartQuantities[pid]) : 0;

        if (qty + existing > stock) {
            e.preventDefault();
            // Notifikasi ini sekarang akan muncul di tengah layar
            showNotification('warning', `Stok Tidak Cukup! Stok tersedia: ${stock}.`);
            return;
        }
    });

    // Menampilkan pesan flash server-side
    @if(session('error')) showNotification('error', "{{ session('error') }}"); @endif
   // @if(session('success')) showNotification('success', "{{ session('success') }}"); @endif
</script>
@endsection
