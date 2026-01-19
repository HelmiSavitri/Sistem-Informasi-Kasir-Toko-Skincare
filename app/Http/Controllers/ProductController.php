<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private function generateUniqueCode()
    {
        $last = Product::orderBy('id', 'DESC')->first();
        $number = $last ? intval(substr($last->unique_code, 4)) + 1 : 1;

        return 'PRD-' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    // INDEX
    public function index()
    {
        $products = Product::with(['category', 'brand'])->get();
        return view('admin.product.index', [
            'title' => 'Produk',
            'products' => $products
        ]);
    }

    // SHOW
    public function show($id)
    {
        return view('admin.product.show', [
            'title' => 'Detail Produk',
            'product' => Product::with(['category', 'brand'])->findOrFail($id)
        ]);
    }

    // CREATE FORM
    public function create()
    {
        return view('admin.product.create', [
            'categories' => Category::all(),
            'brands'     => Brand::all(),
            'unique_code' => $this->generateUniqueCode(),
            'title'      => 'Product'
        ]);
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'photo'       => 'image|mimes:jpg,png,jpeg|max:2048',
            'category_id' => 'nullable',
            'brand_id'    => 'nullable',
            'price'       => 'required|numeric',
            'stock'       => 'required|numeric',
        ]);

        $photoName = null;
        if ($request->hasFile('photo')) {
            $photoName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('photos'), $photoName);
        }

        Product::create([
            'unique_code' => $this->generateUniqueCode(),
            'name'        => $request->name,
            'photo'       => $photoName,
            'category_id' => $request->category_id,
            'brand_id'    => $request->brand_id,
            'price'       => $request->price,
            'stock'       => $request->stock,
        ]);

        return redirect()->route('product.index')->with('success', 'Produk berhasil ditambahkan');
    }

    // EDIT FORM
    public function edit($id)
    {
        return view('admin.product.edit', [
            'title' => 'Ubah Produk',
            'product' => Product::findOrFail($id),
            'categories' => Category::all(),
            'brands' => Brand::all(),
        ]);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'        => 'required',
            'photo'       => 'image|mimes:jpg,png,jpeg|max:2048',
            'category_id' => 'nullable',
            'brand_id'    => 'nullable',
            'price'       => 'required|numeric',
            'stock'       => 'required|numeric',
        ]);

        $photoName = $product->photo;

        if ($request->hasFile('photo')) {
            if ($product->photo && file_exists(public_path('photos/' . $product->photo))) {
                unlink(public_path('photos/' . $product->photo));
            }

            $photoName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('photos'), $photoName);
        }

        $product->update([
            'name'        => $request->name,
            'photo'       => $photoName,
            'category_id' => $request->category_id,
            'brand_id'    => $request->brand_id,
            'price'       => $request->price,
            'stock'       => $request->stock,
        ]);

        return redirect()->route('product.index')->with('success', 'Produk berhasil diperbarui');
    }

    // DELETE
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->photo && file_exists(public_path('photos/' . $product->photo))) {
            unlink(public_path('photos/' . $product->photo));
        }

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Produk berhasil dihapus');
    }
}
