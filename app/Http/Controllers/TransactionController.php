<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function destroy($id)
    {
    $transaction = Transaction::findOrFail($id);
    $transaction->delete();

    return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil dihapus!');
}



    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        // Simpan data transaksi ke database
        Transaction::create($validatedData);

        // Redirect ke halaman daftar transaksi dengan pesan sukses
        return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function create()
    {
        // Menampilkan form untuk menambah transaksi baru
        return view('transaction.create');
    }


    public function index()
    {
        // Mengambil semua data transaksi dari database
        $transactions = transaction::all();

        // Mengembalikan view transactions.index dengan data
        return view('transaction.index', compact('transactions'));
    }

    public function edit($id)
    {
        $transaction = transaction::findOrFail($id);
        return view('transaction.edit', compact('transaction'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric|min:0',
        ]);
    
        $transaction = Transaction::findOrFail($id);
        $transaction->update($request->all());
    
        return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil diperbarui.');
}
}