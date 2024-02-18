<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function index()
    {
        $buku = Buku::latest()->get();
        return view('pengguna.beranda', compact('buku'));
    }
}
