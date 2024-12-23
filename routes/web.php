<?php

use App\Models\Post;
use App\Models\Account;
use App\Models\Laporan;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransactionController;

// Rute untuk tampilan laporan (index)
Route::get('report', [ReportController::class, 'index'])->name('report.index');
// Rute untuk halaman tambah laporan (create)
Route::get('report/create', [ReportController::class, 'create'])->name('report.create');
// Rute untuk menyimpan laporan baru (store)
Route::post('report', [ReportController::class, 'createPost'])->name('report.createPost'); // Bisa juga diganti dengan 'store' jika Anda ubah metode di controller
// Rute untuk halaman edit laporan
Route::get('report/{id}/edit', [ReportController::class, 'edit'])->name('report.edit');
// Rute untuk memperbarui laporan yang sudah ada (update)
Route::put('report/{id}', [ReportController::class, 'update'])->name('report.update');
// Rute untuk menghapus laporan
Route::delete('report/{id}', [ReportController::class, 'destroy'])->name('report.destroy');


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



// Route untuk menampilkan laporan
Route::get('/laporan', function () {
    $posts = Laporan::all();
    return view('laporan', ['posts' => $posts]);
})->name('laporan.index');

// Route untuk menampilkan daftar laporan
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

// Route untuk menampilkan halaman edit laporan
Route::get('/laporan/{post}/edit', [LaporanController::class, 'showEditScreen'])->name('post.edit');

// Route untuk update laporan
Route::put('/laporan/{post}', [LaporanController::class, 'actuallyUpdatePost'])->name('post.update');

// Route untuk menyimpan laporan baru
Route::post('/laporan', [LaporanController::class, 'createPost'])->name('post.create');

// Route untuk menghapus laporan
Route::delete('/laporan/{post}', [LaporanController::class, 'destroy'])->name('post.destroy');


// Rute untuk menampilkan semua postingan di view "kelola_akun"
Route::get('kelola-akun', function () {
    $posts = Account::all(); // Menampilkan semua artikel yang telah diinput
    return view('kelola_akun', ['posts' => $posts]); // Pastikan nama view konsisten
});
Route::resource('accounts', AccountController::class);
Route::get('/accounts', [AccountController::class, 'index'])->name('accounts.index');
Route::get('/accounts/{id}/edit', [AccountController::class, 'edit'])->name('accounts.edit');
Route::put('/accounts/{id}', [AccountController::class, 'update'])->name('accounts.update');
Route::resource('items', ItemController::class);
Route::get('items/create', [ItemController::class, 'create'])->name('items.create');
Route::post('items', [ItemController::class, 'store'])->name('items.store');
Route::resource('categories', CategoryController::class);
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::resource('agents', AgentController::class);


Route::get('/Transaction', [TransactionController::class, 'index'])->name('transaction.index');
Route::get('/Transaction/create', [TransactionController::class, 'create'])->name('transaction.create');
Route::post('/Transaction', [TransactionController::class, 'store'])->name('transaction.store');
Route::get('/Transaction/{id}/edit', [TransactionController::class, 'edit'])->name('transaction.edit');
Route::put('/Transaction/{id}', [TransactionController::class, 'update'])->name('transaction.update');
Route::delete('/Transaction/{id}', [TransactionController::class, 'destroy'])->name('transaction.destroy');
Route::resource('transactions', TransactionController::class);

// Menampilkan daftar transaksi
Route::get('/sale', [SaleController::class, 'index'])->name('sale.index');
// Menambah transaksi
Route::get('/sale/create', [SaleController::class, 'create'])->name('sale.create');
Route::post('/sale', [SaleController::class, 'createPost'])->name('sale.store');
// Mengedit transaksi
Route::get('/sale/{id}/edit', [SaleController::class, 'edit'])->name('sale.edit');
Route::put('/sale/{id}', [SaleController::class, 'update'])->name('sale.update');
// Menghapus transaksi
Route::delete('/sale/{id}', [SaleController::class, 'destroy'])->name('sale.destroy');
// Melihat pendapatan
Route::get('/sale/pendapatan', [SaleController::class, 'pendapatan'])->name('sale.pendapatan');


Route::get('/products/calculate', [ProductController::class, 'calculate'])->name('products.calculate');
Route::get('/products/calculate', [ProductController::class, 'calculate']);
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit'); // Menampilkan form edit
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update'); // Menyimpan perubahan
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/products/statistics', [ProductController::class, 'statistics'])->name('products.statistics');
Route::get('products/result', [ProductController::class, 'result'])->name('products.result');
Route::get('/hitung-skor', [ProductController::class, 'hitungSkor']);

