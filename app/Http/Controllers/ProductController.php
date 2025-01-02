<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Tampilkan daftar produk.
     */
    public function index()
    {
        // Ambil semua data produk
        $products = Product::all();

        // Tampilkan halaman produk
        return view('product.index', compact('products'));
    }

    /**
     * Proses penentuan keputusan dan ranking produk.
     */
    public function processDecision(Request $request)
    {
        // Ambil semua produk dari database
        $products = Product::all();

        // Proses ranking menggunakan SAW/AHP
        $results = $this->calculateRanking($products);

        // Simpan hasil ranking ke session (atau bisa langsung ke database)
        session(['results' => $results]);

        // Redirect ke halaman hasil
        return redirect()->route('result.index');
    }

    /**
     * Hitung ranking produk menggunakan metode SAW/AHP.
     */
    private function calculateRanking($products)
    {
        // Matriks perbandingan berpasangan untuk AHP
        $pairwiseComparison = [
            'harga' => [1, 1/3, 1/5],  // Harga dibandingkan dengan Jumlah dan Netto
            'jumlah' => [3, 1, 1/3],    // Jumlah dibandingkan dengan Harga dan Netto
            'netto' => [5, 3, 1],       // Netto dibandingkan dengan Harga dan Jumlah
        ];
        
        // Hitung bobot AHP
        $criteria = ['harga', 'jumlah', 'netto'];
        $sums = [];
        foreach ($criteria as $i => $crit) {
            $sums[$crit] = array_sum(array_column($pairwiseComparison, $i));
        }
        
        $weights = [];
        foreach ($pairwiseComparison as $crit => $row) {
            $weights[$crit] = array_sum(array_map(fn($value, $sum) => $value / $sum, $row, $sums)) / count($criteria);
        }

        // SAW: Normalisasi data
        $maxValues = [
            'harga' => $products->max('harga'),
            'jumlah' => $products->max('jumlah'),
            'netto' => $products->max('netto'),
        ];
        $minValues = [
            'harga' => $products->min('harga'),
            'netto' => $products->min('netto'),
        ];

        $normalizedProducts = [];
        foreach ($products as $product) {
            // Cek pembagian dengan nol pada normalisasi
            $hargaNormalized = $product->harga > 0 ? $minValues['harga'] / $product->harga : 0; // Hindari pembagian dengan nol
            $jumlahNormalized = $product->jumlah > 0 ? $product->jumlah / $maxValues['jumlah'] : 0; // Hindari pembagian dengan nol
            $nettoNormalized = $product->netto > 0 ? $product->netto / $maxValues['netto'] : 0; // Hindari pembagian dengan nol

            $normalizedProducts[] = (object) [
                'nama' => $product->nama,
                'harga' => $hargaNormalized, // Normalisasi untuk kriteria cost
                'jumlah' => $jumlahNormalized, // Normalisasi untuk kriteria benefit
                'netto' => $nettoNormalized,  // Normalisasi untuk kriteria benefit
                'original_harga' => $product->harga,
                'original_jumlah' => $product->jumlah,
                'original_netto' => $product->netto,
            ];
        }

        // Hitung skor akhir
        foreach ($normalizedProducts as &$product) {
            $product->score = $product->harga * $weights['harga'] + 
                              $product->jumlah * $weights['jumlah'] + 
                              $product->netto * $weights['netto'];
        }

        // Urutkan produk berdasarkan skor
        usort($normalizedProducts, fn($a, $b) => $b->score <=> $a->score);

        // Tambahkan ranking
        $ranking = 1;
        foreach ($normalizedProducts as &$product) {
            $product->ranking = $ranking++;
        }

        return $normalizedProducts;
    }

    /**
     * Tampilkan halaman hasil ranking produk.
     */
    public function showResult()
    {
        // Ambil hasil ranking dari session
        $results = session('results');

        // Tampilkan halaman hasil
        return view('result.index', compact('results'));
    }

    /**
     * Simpan produk baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi data produk
        $validatedData = $request->validate([
            'nama' => 'required|string|unique:products,nama',
            'harga' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'netto' => 'required|numeric', // Ubah jadi numerik, karena akan digunakan dalam perhitungan
        ]);

        // Simpan data produk ke database
        Product::create($validatedData);

        // Redirect ke halaman produk
        return redirect('/product')->with('success', 'Produk berhasil ditambahkan!');
    }
}
