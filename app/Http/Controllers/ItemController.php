<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Menampilkan daftar barang.
     */
    public function index()
    {
        $items = Item::with('category')->paginate(10);
        return view('items.index', compact('items'));
    }

    /**
     * Menampilkan form untuk menambah barang.
     */
    public function create()
    {
        $categories = Category::all(); // Ambil semua kategori
        return view('items.create', compact('categories'));
    }

    /**
     * Menyimpan barang baru.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'harga' => 'required|numeric',
            'netto' => 'required|numeric',  // Validasi Netto dalam gram
            'jumlah' => 'required|integer',
            'gambar' => 'nullable|image',
        ]);

        // Menyimpan data barang baru
        $item = new Item;
        $item->nama_barang = $request->nama_barang;
        $item->category_id = $request->category_id;
        $item->harga = $request->harga;
        $item->netto = $request->netto;  // Menyimpan Netto dalam gram
        $item->jumlah = $request->jumlah;

        // Menyimpan gambar jika ada
        if ($request->hasFile('gambar')) {
            $item->gambar = $request->gambar->store('public/images');
        }

        $item->save();  // Simpan item ke database

        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan');
    }

    /**
     * Menampilkan form untuk mengedit barang.
     */
    public function edit(Item $item)
    {
        $categories = Category::all();  // Ambil semua kategori
        return view('items.edit', compact('item', 'categories'));
    }

    /**
     * Mengupdate data barang.
     */
    public function update(Request $request, Item $item)
    {
        // Validasi data
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'harga' => 'required|numeric',
            'netto' => 'required|numeric',  // Validasi Netto dalam gram
            'jumlah' => 'required|integer',
            'gambar' => 'nullable|image',
        ]);

        // Mengupdate data barang
        $item->update([
            'nama_barang' => $request->nama_barang,
            'category_id' => $request->category_id,
            'harga' => $request->harga,
            'netto' => $request->netto,  // Menyimpan Netto dalam gram
            'jumlah' => $request->jumlah,
        ]);

        // Mengupdate gambar jika ada
        if ($request->hasFile('gambar')) {
            $item->gambar = $request->gambar->store('public/images');
        }

        $item->save();  // Simpan perubahan ke database

        return redirect()->route('items.index')->with('success', 'Barang berhasil diperbarui');
    }

    /**
     * Menghapus barang.
     */
    public function destroy(Item $item)
    {
        // Menghapus gambar jika ada
        if ($item->gambar) {
            unlink(storage_path('app/' . $item->gambar));
        }

        $item->delete();  // Menghapus item dari database

        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus');
    }
}
