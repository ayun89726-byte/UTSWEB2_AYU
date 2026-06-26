<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|string|max:50|unique:products,kode_barang',
            'nama_barang' => 'required|string|max:150',
            'satuan'      => 'required|string|max:30',
            'harga'       => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ], [
            'kode_barang.unique' => 'Kode barang sudah digunakan.',
            'harga.numeric'      => 'Harga harus berupa angka.',
        ]);

        Product::create($request->only('kode_barang', 'nama_barang', 'satuan', 'harga', 'category_id'));

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'kode_barang' => 'required|string|max:50|unique:products,kode_barang,' . $product->id,
            'nama_barang' => 'required|string|max:150',
            'satuan'      => 'required|string|max:30',
            'harga'       => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ], [
            'kode_barang.unique' => 'Kode barang sudah digunakan.',
        ]);

        $product->update($request->only('kode_barang', 'nama_barang', 'satuan', 'harga', 'category_id'));

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}