<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Brand';
        $data['brands'] = Brand::all();
        return view('admin.brand.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create', [
            'title' => 'Brand'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:brands,name'
        ]);

        Brand::create([
            'name' => $request->name
        ]);

        return redirect()->route('brand.index')->with('success', 'Brand berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        $data['title'] = 'Brand';
        $data['brand'] = $brand;
        return view('admin.brand.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $brand->update($request->all());
        return redirect()->route('brand.index')->with('success', 'Brand berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('brand.index')->with('success', 'Brand berhasil dihapus');
    }
}
