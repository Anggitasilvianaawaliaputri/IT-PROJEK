<?php

namespace App\Http\Controllers;

use App\Models\Revenue;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Mengambil semua data pendapatan
        $pendapatan = Revenue::all();
        return view('report.index', compact('pendapatan'));
    }

    public function print($id)
    {
        $pendapatan = Revenue::findOrFail($id);
    
        // Pastikan nilai pendapatan selalu numerik
        $pendapatan->pendapatan = is_numeric($pendapatan->pendapatan) ? (float) $pendapatan->pendapatan : 0;
    
        return view('report.print', compact('pendapatan'));
    }
    
}