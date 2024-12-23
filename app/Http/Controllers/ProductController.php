<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Models\Kriteria;
use App\Models\Product;
use App\Models\Produk;
use App\Models\Value;

class ProductController extends Controller
{
    public function result()
    {
        // Ambil data produk
        $products = Produk::with('values')->get();
    
        // Hitung skor atau ranking sederhana sebagai contoh
        $ranking = $products->map(function ($product) {
            $product->score = $product->values->sum('value'); // Contoh hitung skor
            return $product;
        })->sortByDesc('score'); // Urutkan berdasarkan skor tertinggi
    
        // Kirim variabel ranking ke view
        return view('products.result', compact('ranking'));
    }
    
    
    public function statistic()
    {
        // Mengambil semua data produk
        $products = Produk::with('values')->get();
    
        // Jumlah produk
        $totalProducts = $products->count();
    
        // Ranking produk berdasarkan skor (contoh data statis jika skor sudah dihitung sebelumnya)
        $ranking = $products->sortByDesc('score')->take(5);
    
        // Rata-rata skor produk
        $averageScore = $products->pluck('score')->avg();
    
        // Distribusi bobot kriteria
        $criteria = Kriteria::all();
        $weights = $this->calculateWeights(); // Asumsikan ada metode untuk menghitung bobot kriteria
    
        return view('products.statistic', compact('totalProducts', 'ranking', 'averageScore', 'weights', 'criteria'));
    }
    

    // Fungsi untuk menghitung bobot AHP
    private function ahp($matrix)
    {
        // Normalisasi matriks pairwise
        $normalized = array_map(function ($row) use ($matrix) {
            return array_map(function ($val, $col) use ($matrix) {
                return $val / array_sum(array_column($matrix, $col));
            }, $row, array_keys($row));
        }, $matrix);

        // Hitung bobot dengan rata-rata tiap baris
        return array_map(function ($row) {
            return array_sum($row) / count($row);
        }, $normalized);
    }

    // Fungsi untuk normalisasi nilai produk berdasarkan kriteria
    private function normalize($products, $criteria)
    {
        $data = [];

        foreach ($criteria as $criterion) {
            // Ambil nilai produk berdasarkan kriteria
            $values = $products->pluck('values')
                ->flatten()
                ->where('criteria_id', $criterion->id)
                ->pluck('value');

            if ($criterion->type === 'benefit') {
                // Normalisasi untuk kriteria tipe benefit
                $data[] = $values->map(fn($v) => $v / $values->max())->toArray();
            } else {
                // Normalisasi untuk kriteria tipe cost
                $data[] = $values->map(fn($v) => $values->min() / $v)->toArray();
            }
        }

        // Transposisi data untuk membentuk matriks normalisasi
        return array_map(null, ...$data);
    }

    // Fungsi untuk menghitung skor SAW
    private function saw($normalizedMatrix, $weights)
    {
        // Hitung skor SAW berdasarkan matriks normalisasi dan bobot
        return array_map(function ($row) use ($weights) {
            return array_sum(array_map(fn($val, $w) => $val * $w, $row, $weights));
        }, $normalizedMatrix);
    }

    // Fungsi untuk menampilkan hasil perhitungan AHP dan SAW
    public function calculate()
    {
        // Ambil data produk dan kriteria
        $products = Produk::with('values')->get();
        $criteria = Kriteria::all();

        // Validasi: Pastikan data produk dan kriteria tidak kosong
        if ($products->isEmpty() || $criteria->isEmpty()) {
            return redirect()->route('products.index')->with('error', 'Data produk atau kriteria tidak ditemukan.');
        }

        // Langkah 1: Hitung bobot AHP (Pairwise Comparison Matrix)
        $pairwiseMatrix = [
            [1, 3, 0.5], // Contoh bobot kriteria
            [0.333, 1, 0.25],
            [2, 4, 1],
        ];
        $weights = $this->ahp($pairwiseMatrix);

        // Langkah 2: Normalisasi data
        $normalizedMatrix = $this->normalize($products, $criteria);

        // Langkah 3: Hitung skor SAW
        $scores = $this->saw($normalizedMatrix, $weights);

        // Langkah 4: Urutkan produk berdasarkan skor
        $ranking = $products->map(function ($product, $index) use ($scores) {
            $product->score = $scores[$index]; // Assign skor ke masing-masing produk
            return $product;
        })->sortByDesc('score');

        // Return ke view untuk menampilkan hasil
        return view('products.result', compact('ranking', 'weights'));
    }

    // Fungsi untuk menampilkan statistik produk
    public function statistics()
    {
        // Mengambil semua data produk
        $products = Produk::with('values')->get();

        // Jumlah produk
        $totalProducts = $products->count();

        // Ranking produk berdasarkan skor (contoh data statis jika skor sudah dihitung sebelumnya)
        $ranking = $products->sortByDesc('score')->take(5);

        // Rata-rata skor produk
        $averageScore = $products->pluck('score')->avg();

        // Distribusi bobot kriteria
        $criteria = Kriteria::all();
        $weights = $this->calculateWeights(); // Asumsikan ada metode untuk menghitung bobot kriteria

        return view('products.statistics', compact('totalProducts', 'ranking', 'averageScore', 'weights'));
    }

    // Fungsi untuk menghapus produk
    public function destroy($id)
    {
        // Cari produk berdasarkan ID
        $product = Produk::findOrFail($id);

        // Hapus produk
        $product->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }

    // Fungsi untuk memperbarui produk
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'jumlah' => 'nullable|numeric|min:1',
        ]);

        $product = Produk::findOrFail($id);
        $product->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    // Fungsi untuk menampilkan form edit produk
    public function edit($id)
    {
        $product = Produk::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // Fungsi untuk menampilkan daftar produk
    public function index()
    {
        $products = Produk::all(); // Periksa apakah model 'Produk' sudah benar.
        return view('products.index', compact('products'));
    }

    // Fungsi untuk menampilkan form tambah produk
    public function create()
    {
        return view('products.create');
    }

    // Fungsi untuk menyimpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'jumlah' => 'nullable|numeric|min:1',
        ]);

        Produk::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Fungsi untuk menghitung bobot kriteria
    private function calculateWeights()
    {
        $matrix = [
            [1, 3, 2],      // Harga vs Kriteria lainnya
            [1/3, 1, 1/2],  // Kualitas Rasa vs Kriteria lainnya
            [1/2, 2, 1],    // Netto vs Kriteria lainnya
        ];

        $n = count($matrix);

        $colSum = array_fill(0, $n, 0);
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                $colSum[$j] += $matrix[$i][$j];
            }
        }

        $normalizedMatrix = [];
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                $normalizedMatrix[$i][$j] = $matrix[$i][$j] / $colSum[$j];
            }
        }

        $weights = [];
        for ($i = 0; $i < $n; $i++) {
            $weights[$i] = array_sum($normalizedMatrix[$i]) / $n;
        }

        return $weights;
    }

    public function showWeights()
    {
        $weights = $this->calculateWeights();
        return response()->json($weights); // Tampilkan hasil bobot sebagai JSON
    }

    public function showRanking()
    {
        $produkSkor = Produk::with('values.kriteria')->get()->map(function ($produk) {
            // Hitung total skor dari semua nilai (value) kriteria
            $totalSkor = $produk->values->sum('nilai');

            return [
                'nama_produk' => $produk->nama,
                'total_skor' => $totalSkor,
            ];
        });

        // Urutkan berdasarkan skor (dari besar ke kecil)
        $produkSkor = $produkSkor->sortByDesc('total_skor')->values();

        return view('ranking', ['produkSkor' => $produkSkor]);
    }


    
}
