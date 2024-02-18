<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TampilanController extends Controller
{
    public function show($id)
    {
        $buku = Buku::findOrFail($id);
        $ulasan = Ulasan::where('buku_id', $buku->id)->latest()->paginate(5);
        $avg = Ulasan::where('buku_id', $buku->id)->avg('rating');
        return view('pengguna.buku', compact('buku','ulasan','avg'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'ulasan' => 'string',
            'rating' => 'required|numeric',
        ]);

        Ulasan::create([
            'buku_id' => $request->buku_id,
            'users_id' => Auth::user()->id,
            'ulasan' => $request->ulasan,
            'rating' => $request->rating,
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $ulasan = Ulasan::findOrFail($id);
        $ulasan->delete();

        return redirect()->back();
    }
}