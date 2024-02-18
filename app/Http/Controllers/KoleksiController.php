<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBuku;
use App\Models\Koleksi;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KoleksiController extends Controller
{
    public function index()
    {
        $koleksi = Koleksi::where('users_id', Auth::user()->id)->get();
        $buku = Buku::whereHas('peminjaman', function($query) {
            $query->where('users_id', Auth::user()->id);
        })->get();
        return view('pengguna.koleksi', compact('koleksi', 'buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required'
        ]);

        Koleksi::create([
            'users_id' => Auth::user()->id,
            'buku_id' => $request->buku_id
        ]);

        return redirect()->route('koleksi.index');
    }

    public function destroy($id)
    {
        $koleksi = Koleksi::findOrFail($id);
        $koleksi->delete();

        return redirect()->route('koleksi.index');
    }
}