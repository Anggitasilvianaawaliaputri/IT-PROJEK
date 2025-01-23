<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;

class TPKController extends Controller
{
    public function index()
    {
        // Ambil data dari tabel penjualan
        $data_tpk = Penjualan::select('nama_barang', 'harga', Penjualan::raw('SUM(jumlah) as total_jumlah'), 'netto')
            ->groupBy('nama_barang', 'harga', 'netto')
            ->get();

        // Menghitung bobot dengan metode AHP
        $bobot = $this->calculateAHPWeights();

        // Hitung nilai untuk setiap produk menggunakan SAW
        $data_tpk = $data_tpk->map(function($item) use ($bobot) {
            // Normalisasi nilai kriteria
            $max_harga = Penjualan::max('harga');
            $max_jumlah = Penjualan::max('jumlah');
            $max_netto = Penjualan::max('netto');

            $normalized_harga = $item->harga / $max_harga;
            $normalized_jumlah = $item->total_jumlah / $max_jumlah;
            $normalized_netto = $item->netto / $max_netto;

            // Hitung nilai SAW dengan bobot yang dihitung dari AHP
            $saw_value = ($normalized_harga * $bobot['harga']) +
                         ($normalized_jumlah * $bobot['total_jumlah']) +
                         ($normalized_netto * $bobot['netto']);

            // Tambahkan nilai SAW ke data
            $item->saw_value = $saw_value;

            return $item;
        });

        // Urutkan data berdasarkan nilai SAW tertinggi
        $data_tpk = $data_tpk->sortByDesc('saw_value');

        // Kirim data ke view
        return view('result.index', compact('data_tpk'));
    }

    // Fungsi untuk menghitung bobot menggunakan metode AHP
    public function calculateAHPWeights()
    {
        // Matriks perbandingan berpasangan untuk kriteria harga, jumlah, dan netto
        $matrix = [
            [1, 3, 5],  // Harga dibandingkan dengan Harga, Jumlah, Netto
            [1/3, 1, 3], // Jumlah dibandingkan dengan Harga, Jumlah, Netto
            [1/5, 1/3, 1] // Netto dibandingkan dengan Harga, Jumlah, Netto
        ];

        // Menjumlahkan setiap kolom
        $columnSums = [
            array_sum(array_column($matrix, 0)),
            array_sum(array_column($matrix, 1)),
            array_sum(array_column($matrix, 2)),
        ];

        // Matriks normalisasi
        $normalizedMatrix = [];
        foreach ($matrix as $row) {
            $normalizedRow = [
                $row[0] / $columnSums[0],
                $row[1] / $columnSums[1],
                $row[2] / $columnSums[2]
            ];
            $normalizedMatrix[] = $normalizedRow;
        }

        // Menghitung rata-rata setiap baris untuk mendapatkan bobot
        $weights = [];
        foreach ($normalizedMatrix as $normalizedRow) {
            $weights[] = array_sum($normalizedRow) / count($normalizedRow);
        }

        // Bobot untuk harga, jumlah, dan netto
        return [
            'harga' => $weights[0], // Bobot untuk harga
            'total_jumlah' => $weights[1], // Bobot untuk total jumlah
            'netto' => $weights[2] // Bobot untuk netto
        ];
    }
}
