<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Revenue;

class RevenueController extends Controller
{
    // Menampilkan Formulir untuk menghitung pendapatan
    public function indexForm()
    {
        return view('revenue.index'); // Halaman form input tanggal
    }

    // Menghitung Pendapatan dan menyimpannya
    public function index(Request $request)
    {
        // Validasi Input
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        // Ambil data transaksi berdasarkan rentang tanggal
        $pendapatan = Penjualan::whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])
            ->sum('subtotal'); // Hitung total pendapatan

        // Simpan data pendapatan ke tabel revenue
        Revenue::create([
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'pendapatan' => $pendapatan,
        ]);

        // Kirim hasil pendapatan ke halaman laporan
        return redirect()->route('report.index')->with('success', 'Pendapatan berhasil dihitung dan disimpan!');
    }
}