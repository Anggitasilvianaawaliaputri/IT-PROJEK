<?php

namespace App\Http\Controllers;

use index;
use App\Models\Laporan; // Mengimpor model Laporan
use Illuminate\Http\Request; // Mengimpor kelas Request untuk menangani permintaan HTTP

class LaporanController extends Controller
{
    
    public function show($id)
{
    $laporan = Laporan::findOrFail($id); // Cari data berdasarkan ID
    return view('laporan.show', compact('laporan')); // Kirim data ke view
}
public function index()
{
    $posts = Laporan::all();
    return view('laporan', compact('posts'));
}

    public function store(Request $request)
{
    // Validasi data input
    $validatedData = $request->validate([
        'nama_karyawan' => 'required|string|max:255', // Nama karyawan harus diisi dan berupa string
        'tanggal' => 'required|date', // Tanggal harus diisi dan berupa format tanggal
        'pendapatan' => 'required|numeric|min:0', // Pendapatan harus diisi dan berupa angka positif
    ]);

    // Mengamankan input dengan menghilangkan tag HTML
    $validatedData['nama_karyawan'] = strip_tags($validatedData['nama_karyawan']);
    $validatedData['tanggal'] = strip_tags($validatedData['tanggal']);
    $validatedData['pendapatan'] = strip_tags($validatedData['pendapatan']);

    // Menyimpan data ke database
    Laporan::create($validatedData);

    // Redirect ke halaman daftar laporan dengan pesan sukses
    return redirect()->route('laporan.index')->with('success', 'Laporan berhasil disimpan.');
}

    public function create(Request $request)
{
    dd($request->method());
}

    public function showEditScreen(Laporan $laporan)
{
    return view('laporan.edit', compact('laporan')); // Pastikan nama view sesuai dengan lokasi file
}
    // Metode untuk menghapus laporan
    public function destroy(Laporan $laporan) {
        // Menghapus entri laporan dari database
        $laporan->delete();
    
        // Mengarahkan kembali ke halaman laporan setelah penghapusan
        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus');
    }

    // Menampilkan halaman edit laporan
    public function edit($id)
    {
        $laporan = Laporan::findOrFail($id); // Ambil data laporan berdasarkan ID
        dd($laporan);
        
        return view('laporan.edit', compact('laporan')); // Kirim data laporan ke view Laporan.edit
    }

    // Metode untuk membuat entri data laporan baru
    public function createPost(Request $request) {
        // Validasi data yang diterima dari permintaan
        $validatedData = $request->validate([
            'nama_karyawan' => 'required', // Kolom nama_karyawan harus diisi
            'tanggal' => 'required|date', // Kolom tanggal harus diisi dengan format tanggal
            'pendapatan' => 'required|numeric', // Kolom pendapatan harus diisi dan berupa angka
        ]);

        // Menghilangkan tag HTML dari input untuk keamanan
        $validatedData['nama_karyawan'] = strip_tags($validatedData['nama_karyawan']);
        $validatedData['tanggal'] = strip_tags($validatedData['tanggal']);
        $validatedData['pendapatan'] = strip_tags($validatedData['pendapatan']);
        
        // Menyimpan data baru ke database
        Laporan::create($validatedData);
        
        // Mengarahkan kembali ke halaman laporan setelah penyimpanan
        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil ditambahkan');
    }

    // Metode untuk meng-update entri data laporan
    public function actuallyUpdatePost(Request $request, Laporan $laporan) {
        // Validasi data yang diterima dari permintaan
        $validatedData = $request->validate([
            'nama_karyawan' => 'required', // Kolom nama_karyawan harus diisi
            'tanggal' => 'required|date', // Kolom tanggal harus diisi dengan format tanggal
            'pendapatan' => 'required|numeric', // Kolom pendapatan harus diisi dan berupa angka
        ]);

        // Menghilangkan tag HTML dari input untuk keamanan
        $validatedData['nama_karyawan'] = strip_tags($validatedData['nama_karyawan']);
        $validatedData['tanggal'] = strip_tags($validatedData['tanggal']);
        $validatedData['pendapatan'] = strip_tags($validatedData['pendapatan']);

        // Update data laporan di database
        $laporan->update($validatedData);
        return redirect()->route('laporan.update')->with('success', 'Laporan berhasil diupdate');

        // Mengarahkan kembali ke halaman laporan setelah update
        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diperbarui');
    }
}
