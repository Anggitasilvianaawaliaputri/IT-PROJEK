<?php

use App\Models\Post;
use App\Models\Laporan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Schema; // Pastikan ini ada


//Rute Laporan
Route::get('/Laporan', function() {
    $posts = Laporan::all(); // Ambil semua data transaksi
    return view('Laporan', ['posts' => $posts]); // Kirim data ke view
})->name('Laporan'); // Memberikan nama 'laporan' pada rute
Route::get('/editLaporan/{post}',[LaporanController::class, 'showEditScreen']);
Route::put('/editLaporan/{post}', [LaporanController::class, 'actuallyUpdatePost']);
// Route untuk menyimpan data laporan
Route::post('/create-post-laporan', [LaporanController::class, 'createPost'])->name('post.create'); // Memberikan nama 'post.create'
// Route untuk menampilkan form edit laporan
Route::get('/editLaporan/{post}', [LaporanController::class, 'showEditScreen'])->name('post.edit');
// Route untuk menghapus laporan
Route::delete('/deleteLaporan/{post}', [LaporanController::class, 'destroy'])->name('post.destroy');
Route::put('/editLaporan/{post}', [LaporanController::class, 'actuallyUpdatePost'])->name('post.update');

// Rute untuk memeriksa kolom di tabel accounts
Route::get('/check-accounts', function () {
    return response()->json(Schema::getColumnListing('accounts')); // Mengembalikan kolom dalam format JSON
});
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::resource('accounts', AccountController::class);
Route::resource('items', ItemController::class);
Route::resource('categories', CategoryController::class);
Route::resource('agents', AgentController::class);
Route::resource('transactions', TransactionController::class);
