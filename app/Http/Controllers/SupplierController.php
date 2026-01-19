<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Supplier';
        $data['suppliers'] = Supplier::all();
        return view('admin.supplier.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = \App\Models\Brand::all();
        return view('admin.supplier.create', ['title' => 'Supplier', 'brands' => $brands]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'brand_ids' => 'nullable|array',
            'brand_ids.*' => 'exists:brands,id'
        ]);

        $supplier = Supplier::create($request->only(['name','phone','address']));

        if ($request->filled('brand_ids')) {
            $supplier->brands()->sync($request->brand_ids);
        }

        return redirect()->route('supplier.index')->with('success','Supplier berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return view('admin.supplier.show', ['supplier' => $supplier, 'title' => 'Supplier']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        $brands = \App\Models\Brand::all();
        return view('admin.supplier.edit', ['supplier' => $supplier, 'title' => 'Supplier', 'brands' => $brands]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'brand_ids' => 'nullable|array',
            'brand_ids.*' => 'exists:brands,id'
        ]);

        $supplier->update($request->only(['name','phone','address']));

        if ($request->has('brand_ids')) {
            $supplier->brands()->sync($request->brand_ids);
        } else {
            // If no brand_ids provided, detach all brands
            $supplier->brands()->sync([]);
        }

        return redirect()->route('supplier.index')->with('success','Supplier berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('supplier.index')->with('success','Supplier berhasil dihapus');
    }
}
