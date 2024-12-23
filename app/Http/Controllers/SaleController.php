<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{

    public function pendapatan(Request $request)
    {
    $request->validate([
        'tanggal_awal' => 'required|date',
        'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
    ]);

    $tanggal_awal = $request->tanggal_awal;
    $tanggal_akhir = $request->tanggal_akhir;

    $pendapatan = Sale::whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])
        ->sum('subtotal');

    return back()->with('success', 'Pendapatan dari ' . $tanggal_awal . ' hingga ' . $tanggal_akhir . ' adalah Rp ' . number_format($pendapatan, 0, ',', '.'));
    }


    public function index()
    {
        $penjualan = Sale::all();
        return view('sale.index', compact('penjualan'));
    }

    public function create()
    {
        return view('sale.create');
    }

    public function createPost(Request $request)
    {
        $validatedData = $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'harga' => 'required|numeric|min:0',
            'jumlah' => 'required|numeric|min:1',
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
            'nama_karyawan' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'harga' => 'required|numeric|min:0',
            'jumlah' => 'required|numeric|min:1',
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