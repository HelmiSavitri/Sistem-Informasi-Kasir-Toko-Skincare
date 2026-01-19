<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    protected $title = 'Dashboard';

    protected $menu = 'dashboard';

    protected $directory = 'admin.dashboard';



    public function index()

    {

        // Menyiapkan array untuk dikirim ke view

        $data['title'] = $this->title;

        $data['menu'] = $this->menu;



        // Mengambil data dari database
        $data['total_product'] = Product::count();
        $data['total_brand'] = Brand::count();

        // Threshold stok menipis (ubah sesuai kebutuhan)
        $threshold = 5;

        // Produk stok menipis (stock > 0 && <= threshold)
        $data['low_stock_products'] = Product::where('stock', '>', 0)
            ->where('stock', '<=', $threshold)
            ->orderBy('stock', 'asc')
            ->get();

        // Produk habis (stock == 0)
        $data['out_of_stock_products'] = Product::where('stock', 0)->get();



        // Me-return view beserta data

        return view($this->directory . '.index', $data);
    }
}
