<?php

namespace App\Http\Controllers;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
    $laporan = Report::all(); // Mengambil semua data laporan penjualan
    return view('report.index', compact('laporan')); // Mengirim variabel $laporan ke view
    }


    public function create()
    {
        return view('report.create'); // Mengganti view 'sale.create' menjadi 'report.create'
    }

    public function createPost(Request $request)
    {
        $validatedData = $request->validate([
            'nama_karyawan' => 'required|string|max:255', // Validasi nama_karyawan
            'tanggal' => 'required|date', // Validasi tanggal
            'pendapatan' => 'required|numeric|min:0', // Validasi pendapatan
        ]);

        Report::create($validatedData); // Menyimpan data laporan

        return redirect()->route('report.index')->with('success', 'Laporan berhasil ditambahkan.'); // Mengganti route 'sale.index' menjadi 'report.index'
    }

    public function edit($id)
    {
        $laporan = Report::findOrFail($id); // Mengganti $transaction menjadi $laporan
        return view('report.edit', compact('laporan')); // Mengganti view 'sale.edit' menjadi 'report.edit'
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_karyawan' => 'required|string|max:255', // Validasi nama_karyawan
            'tanggal' => 'required|date', // Validasi tanggal
            'pendapatan' => 'required|numeric|min:0', // Validasi pendapatan
        ]);

        $laporan = Report::findOrFail($id); // Mengganti $transaction menjadi $laporan
        $laporan->update($validatedData); // Mengupdate laporan

        return redirect()->route('report.index')->with('success', 'Laporan berhasil diperbarui.'); // Mengganti route 'sale.index' menjadi 'report.index'
    }

    public function destroy($id)
    {
        $laporan = Report::findOrFail($id); // Mengganti $transaction menjadi $laporan
        $laporan->delete(); // Menghapus laporan

        return redirect()->route('report.index')->with('success', 'Laporan berhasil dihapus.'); // Mengganti route 'sale.index' menjadi 'report.index'
    }
}