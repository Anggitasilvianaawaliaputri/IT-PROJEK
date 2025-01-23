<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Item;
use App\Models\Report;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function pendapatanForm()
    {
    return view('sale.pendapatan');
    }
    

    public function pendapatan(Request $request)
{
    // Validasi input tanggal
    $request->validate([
        'tanggal_awal' => 'required|date',
        'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
    ]);

    // Ambil tanggal awal dan akhir dari request
    $tanggal_awal = $request->tanggal_awal;
    $tanggal_akhir = $request->tanggal_akhir;

    // Hitung pendapatan berdasarkan range tanggal
    $pendapatan = Sale::whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])
        ->sum('subtotal');

    // Simpan data pendapatan dan tanggal ke session
    session([
        'pendapatan' => $pendapatan,
        'tanggal_awal' => $tanggal_awal,
        'tanggal_akhir' => $tanggal_akhir
    ]);

    // Redirect ke halaman report.index dengan membawa pesan sukses
    return redirect()->route('report.index')->with('success', 'Pendapatan berhasil dihitung.');
}

    public function index()
    {
        $penjualan = Sale::all();
        return view('sale.index', compact('penjualan'));
    }

    public function create()
    {
    $items = Item::select('nama_barang')->distinct()->get(); // Mengambil nama barang unik
    return view('sale.create', compact('items'));
    }

    public function createPost(Request $request)
    {
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'harga' => 'required|numeric|min:0',
            'jumlah' => 'required|numeric|min:1',
            'netto' => 'required|numeric|max:255', 
            'satuan' => 'required|string|max:255', 
            'metode_pembayaran' => 'required|string|max:255',
        ]);

        $validatedData['subtotal'] = $validatedData['harga'] * $validatedData['jumlah'];

        Sale::create($validatedData);

        return redirect()->route('sale.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $transaction = Sale::findOrFail($id);
        return view('sale.edit', compact('transaction'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
           
            'nama_barang' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'harga' => 'required|numeric|min:0',
            'jumlah' => 'required|numeric|min:1',
            'netto' => 'required|numeric|max:255', 
            'satuan' => 'required|string|max:255', 
            'metode_pembayaran' => 'required|string|max:255',
        ]);

        $transaction = Sale::findOrFail($id);
        $validatedData['subtotal'] = $validatedData['harga'] * $validatedData['jumlah'];

        $transaction->update($validatedData);

        return redirect()->route('sale.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $transaction = Sale::findOrFail($id);
        $transaction->delete();

        return redirect()->route('sale.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    public function show(Sale $penjualan)
    {
        return view('sale.show', compact('penjualan'));
    }
}