<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use App\Models\Rating; 
use App\Models\TransactionItem;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected $title = 'Dashboard';
    protected $menu = 'dashboard';
    protected $directory = 'admin.dashboard';

    public function index()
    {
        // Statistik Dasar
        $total_product = Product::count();
        $total_brand = Brand::count();

        // Logika Stok
        $low_stock_products = Product::where('stock', '<=', 10)->where('stock', '>', 0)->get();
        $out_of_stock_products = Product::where('stock', 0)->get();

        // DATA RATING
        // Menggunakan with('transaction') agar relasi terangkut
        $recent_ratings = Rating::with('transaction')->latest()->take(5)->get();
        $avg_rating = Rating::avg('score') ?? 0;

        // Produk Terlaris & Jarang Dibeli
        $terlaris = TransactionItem::with('product')
            ->select('product_id', DB::raw('SUM(qty) as total_qty'))
            ->groupBy('product_id')
            ->orderBy('total_qty', 'desc')
            ->first();

        $jarang_dibeli = TransactionItem::with('product')
            ->select('product_id', DB::raw('SUM(qty) as total_qty'))
            ->groupBy('product_id')
            ->orderBy('total_qty', 'asc')
            ->first();

        return view('admin.dashboard.index', compact(
            'total_product',
            'total_brand',
            'low_stock_products',
            'out_of_stock_products',
            'recent_ratings',
            'avg_rating',
            'terlaris',
            'jarang_dibeli'
        ));
    }
} // Pastikan hanya ada satu kurung penutup di sini