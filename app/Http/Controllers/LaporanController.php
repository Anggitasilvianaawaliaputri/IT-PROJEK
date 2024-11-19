<?php

namespace App\Http\Controllers;

use App\Models\Laporan; // Mengimpor model Post
use Illuminate\Http\Request; // Mengimpor kelas Request untuk menangani permintaan HTTP

class LaporanController extends Controller
{

    public function destroy(Laporan $post) {
        // Menghapus entri laporan dari database
        $post->delete();
    
        // Mengarahkan kembali ke halaman laporan setelah penghapusan
        return redirect()->route('Laporan')->with('success', 'Laporan berhasil dihapus');
    }
    
    public function showEditScreen(Laporan $post) {
        return view('editLaporan', ['post' => $post]); // Mengirim data laporan ke view 'editLaporan'
    }
    
    // Metode untuk membuat entri data baru
    public function createPost(Request $request) {
        // Validasi data yang diterima dari permintaan
        $incomingField = $request->validate([
            'nama_karyawan' => 'required', // Kolom nama_karyawan harus diisi
            'tanggal' => 'required', // Kolom tanggal harus diisi
            'pendapatan' => 'required|numeric' // Kolom pendapatan harus diisi
        ]);

        // Menghilangkan tag HTML dari input untuk keamanan
        $incomingField['nama_karyawan'] = strip_tags($incomingField['nama_karyawan']);
        $incomingField['tanggal'] = strip_tags($incomingField['tanggal']);
        $incomingField['pendapatan'] = strip_tags($incomingField['pendapatan']);
        
        // Menyimpan data baru ke database
        Laporan::create($incomingField);
        
        // Mengarahkan kembali ke halaman laporan setelah penyimpanan
        return redirect()->route('Laporan');
    }

    // Metode untuk meng-update entri data laporan
    public function actuallyUpdatePost(Request $request, Laporan $post) {
        // Validasi data yang diterima dari permintaan
        $incomingField = $request->validate([
            'nama_karyawan' => 'required', // Kolom nama_karyawan harus diisi
            'tanggal' => 'required', // Kolom tanggal harus diisi
            'pendapatan' => 'required|numeric' // Kolom pendapatan harus diisi
        ]);

        // Menghilangkan tag HTML dari input untuk keamanan
        $incomingField['nama_karyawan'] = strip_tags($incomingField['nama_karyawan']);
        $incomingField['tanggal'] = strip_tags($incomingField['tanggal']);
        $incomingField['pendapatan'] = strip_tags($incomingField['pendapatan']);

        // Update data laporan di database
        $post->update($incomingField);
        
        // Mengarahkan kembali ke halaman laporan setelah update
        return redirect()->route('Laporan');
    }
}