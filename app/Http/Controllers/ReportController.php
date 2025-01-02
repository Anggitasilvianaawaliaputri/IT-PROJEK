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
}