<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TransactionItem;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /**
     * Halaman daftar transaksi.
     */
    // Cari function index di TransactionController
    public function index()
    {
        // Mengambil data transaksi beserta ratingnya
        $transactions = \App\Models\Transaction::with('rating')->latest()->get();

        return view('admin.transaction.index', [
            'title' => 'Pembayaran',
            'transactions' => $transactions
        ]);
    }
    /**
     * Halaman create kasir.
     */
    public function create()
    {
        $products = Product::where('stock', '>', 0)->orderBy('name', 'asc')->get();

        return view('admin.transaction.create', [
            'title'    => 'Transaksi Kasir',
            'products' => $products // Kirim data produk ke view
        ]);
    }

    /**
     * Cari produk berdasarkan kode (AJAX).
     */
    public function findProduct(Request $request)
    {
        // products use `unique_code` as the barcode/code field
        $product = Product::where('unique_code', $request->code)->first();

        if (!$product) {
            return response()->json(['status' => false, 'message' => 'Produk tidak ditemukan']);
        }

        return response()->json([
            'status'  => true,
            'product' => $product
        ]);
    }

    /**
     * Tambahkan produk ke keranjang (session).
     */
    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);
        $qty = $request->qty;

        if (!$product) {
            return back()->with('error', 'Produk tidak ditemukan!');
        }

        if ($qty > $product->stock) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        $cart = session()->get('cart', []);

        $cart[] = [
            'product_id' => $product->id,
            'code'       => $product->unique_code,
            'name'       => $product->name,
            'price'      => $product->price,
            'qty'        => $qty,
            'subtotal'   => $product->price * $qty
        ];

        session()->put('cart', $cart);

        return back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    /**
     * Proses pembayaran.
     */
    public function store(Request $request)
    {
        $cart = session('cart', []);

        if (count($cart) == 0) {
            return back()->with('error', 'Keranjang masih kosong!');
        }

        // validate paid_amount
        $request->validate([
            'paid_amount' => 'required|numeric|min:0',
        ]);

        $total = collect($cart)->sum('subtotal');
        $paid  = (int) $request->paid_amount;

        if ($paid < $total) {
            return back()->with('error', 'Pembayaran kurang!');
        }

        $change = $paid - $total;

        // Generate transaction code
        $last = Transaction::orderBy('id', 'desc')->first();
        $number = $last && $last->transaction_code ? intval(substr($last->transaction_code, 4)) + 1 : 1;
        $transaction_code = 'TRX-' . str_pad($number, 4, '0', STR_PAD_LEFT);

        // Simpan transaksi (store both `total` for legacy and `total_price` for views)
        $transaction = Transaction::create([
            'transaction_code' => $transaction_code,
            'total'            => $total,
            'total_price'      => $total,
            'paid_amount'      => $paid,
            'change_amount'    => $change
        ]);

        // Simpan item transaksi
        foreach ($cart as $item) {
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id'     => $item['product_id'],
                'qty'            => $item['qty'],
                'price'          => $item['price'],
                'subtotal'       => $item['subtotal']
            ]);

            // Update stok
            Product::where('id', $item['product_id'])
                ->decrement('stock', $item['qty']);
        }

        session()->forget('cart');

        return redirect()->route('transaction.show', $transaction->id)
            ->with('success', 'Transaksi berhasil disimpan!');
    }

    /**
     * Tampilkan detail transaksi.
     */
    /**
     * Tampilkan detail transaksi.
     */
    public function show($id)
    {
        // 1. Ambil data dengan eager loading relasi yang dibutuhkan
        $data = Transaction::with(['items.product', 'rating'])->findOrFail($id);

        // 2. Kirim ke view dengan dua nama variabel (trx dan transaction)
        return view('admin.transaction.show', [
            'title'       => 'Detail Transaksi',
            'trx'         => $data,         // Untuk tabel & item (baris 31)
            'transaction' => $data,         // Untuk bagian rating
        ]);
    }
    /**
     * Halaman edit transaksi (opsional).
     */
    public function edit($id)
    {
        $trx = Transaction::findOrFail($id);

        return view('admin.transaction.edit', [
            'title' => 'Edit Transaksi',
            'trx'   => $trx
        ]);
    }

    /**
     * Update transaksi.
     */
    public function update(Request $request, $id)
    {
        $trx = Transaction::findOrFail($id);

        $request->validate([
            'transaction_code' => 'nullable|string|unique:transactions,transaction_code,' . $trx->id,
            'total_price' => 'required|numeric|min:0',
            'paid_amount' => 'nullable|numeric|min:0'
        ]);

        $trx->transaction_code = $request->transaction_code;
        $trx->total_price = (int) $request->total_price;
        $trx->total = (int) $request->total_price; // keep legacy field in sync
        $trx->paid_amount = $request->paid_amount ? (int) $request->paid_amount : null;
        $trx->change_amount = $trx->paid_amount ? ($trx->paid_amount - $trx->total_price) : null;

        $trx->save();

        return redirect()->route('transaction.show', $trx->id)->with('success', 'Transaksi berhasil diperbarui!');
    }

    /**
     * Hapus transaksi.
     */
    public function destroy($id)
    {
        Transaction::findOrFail($id)->delete();

        return back()->with('success', 'Transaksi berhasil dihapus!');
    }


    /**
     * Cetak struk transaksi (PDF).
     */
    public function print($id)
    {
        $trx = Transaction::with('items.product')->findOrFail($id);

        return view('admin.transaction.print', [
            'title' => 'Cetak Struk',
            'trx'   => $trx
        ]);
    }

    /**
     * Hapus produk dari keranjang (session).
     */
    public function removeFromCart($index)
    {
        $cart = session()->get('cart', []);

        // Cek apakah index tersebut ada di dalam array keranjang
        if (isset($cart[$index])) {
            unset($cart[$index]);

            // Re-index array agar index tetap berurutan (mencegah error di foreach)
            $cart = array_values($cart);

            session()->put('cart', $cart);
            return back()->with('success', 'Produk dihapus dari keranjang!');
        }

        return back()->with('error', 'Produk tidak ditemukan di keranjang!');
    }

    public function storeRating(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'score'          => 'required|numeric|min:1|max:5',
            'comment'        => 'nullable|string'
        ]);

        \App\Models\Rating::updateOrCreate(
            ['transaction_id' => $request->transaction_id],
            [
                'score'   => $request->score,
                'comment' => $request->comment,
            ]
        );

        return back()->with('success', 'Rating berhasil disimpan!');
    }
}
