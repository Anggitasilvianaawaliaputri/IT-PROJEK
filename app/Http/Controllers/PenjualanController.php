<?php

namespace App\Http\Controllers;

use App\Models\Penjualan; // Mengganti model ke Penjualan
use App\Models\Item;
use App\Models\Report;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function pendapatanForm()
    {
        return view('penjualan.pendapatan'); // Mengubah view ke folder penjualan
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
        $pendapatan = Penjualan::whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])
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
        $penjualan = Penjualan::all(); // Menggunakan model Penjualan
        return view('penjualan.index', compact('penjualan')); // Mengubah view ke folder penjualan
    }

    public function create()
    {
        $items = Item::select('nama_barang')->distinct()->get(); // Mengambil nama barang unik
        return view('penjualan.create', compact('items')); // Mengubah view ke folder penjualan
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

        Penjualan::create($validatedData); // Menggunakan model Penjualan

        return redirect()->route('penjualan.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $transaction = Penjualan::findOrFail($id); // Menggunakan model Penjualan
        return view('penjualan.edit', compact('transaction')); // Mengubah view ke folder penjualan
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

        $transaction = Penjualan::findOrFail($id); // Menggunakan model Penjualan
        $validatedData['subtotal'] = $validatedData['harga'] * $validatedData['jumlah'];

        $transaction->update($validatedData);

        return redirect()->route('penjualan.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $transaction = Penjualan::findOrFail($id); // Menggunakan model Penjualan
        $transaction->delete();

        return redirect()->route('penjualan.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    public function show(Penjualan $penjualan)
    {
        return view('penjualan.show', compact('penjualan')); // Mengubah view ke folder penjualan
    }


    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'harga' => 'required|numeric|min:0',
            'jumlah' => 'required|integer|min:1',
            'netto' => 'required|numeric|min:0',
            'satuan' => 'required|string|max:50',
            'metode_pembayaran' => 'required|string|in:Cash,Transfer',
        ]);

        // Simpan data ke database
        $penjualan = new Penjualan();
        $penjualan->nama_barang = $validated['nama_barang'];
        $penjualan->tanggal = $validated['tanggal'];
        $penjualan->harga = $validated['harga'];
        $penjualan->jumlah = $validated['jumlah'];
        $penjualan->netto = $validated['netto'];
        $penjualan->satuan = $validated['satuan'];
        $penjualan->metode_pembayaran = $validated['metode_pembayaran'];
        $penjualan->subtotal = $validated['harga'] * $validated['jumlah']; // Contoh perhitungan subtotal
        $penjualan->save();

        // Redirect dengan pesan sukses
        return redirect()->route('penjualan.index')->with('success', 'Data penjualan berhasil ditambahkan.');
    }
}
