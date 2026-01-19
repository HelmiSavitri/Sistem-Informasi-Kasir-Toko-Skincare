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
    public function index()
    {
        $transactions = Transaction::latest()->get();

        return view('admin.transaction.index', [
            'title'         => 'Transaksi',
            'transactions'  => $transactions
        ]);
    }

    /**
     * Halaman create kasir.
     */
    public function create()
    {
        // Do not clear cart here so added items persist across redirects from addToCart
        return view('admin.transaction.create', [
            'title' => 'Transaksi Kasir'
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
    public function show($id)
    {
        $trx = Transaction::with('items.product')->findOrFail($id);

        return view('admin.transaction.show', [
            'title' => 'Detail Transaksi',
            'trx'   => $trx
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
}
